<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\UserBalace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TripayCallbackController extends Controller
{
    protected string $privateKey;

    public function __construct()
    {
        $payment = \App\Models\Payment::first();
        $this->privateKey = $payment->private_key;
    }
    // Isi dengan private key anda

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $uniqueRef = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $transaction = Transaction::where('reference', $uniqueRef)
                ->where('status', '=', 'UNPAID')
                ->first();
            UserBalace::create([
                'user_id' => $transaction->user_id,
                'balance' => $transaction->amount,
            ]);
            if (! $transaction) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: '.$uniqueRef,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $transaction->update(['status' => 'PAID']);
                    break;

                case 'EXPIRED':
                    $transaction->update(['status' => 'EXPIRED']);
                    break;

                case 'FAILED':
                    $transaction->update(['status' => 'FAILED']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return Response::json(['success' => true]);
        }
    }
}
