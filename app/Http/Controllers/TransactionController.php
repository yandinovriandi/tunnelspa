<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\TripayRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ProtoneMedia\Splade\Facades\Toast;

class TransactionController extends Controller
{
    private TripayRepository $tripayRepository;

    public function __construct(TripayRepository $tripayRepository)
    {
        $this->tripayRepository = $tripayRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paymentChannels = $this->tripayRepository->getPaymentChannels();

        return view('balance.create', [
            'paymentChannels' => $paymentChannels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userBalance = (int) $request->amount;
        $method = $request->payment_method;
        $reqtransaction = $this->tripayRepository->requestTransaction($userBalance, $method);

        if (empty($request->payment_method)) {
            throw ValidationException::withMessages([
                'payment_method' => 'Pilih metode pembayaran terlebih dahulu',
                'amount' => 'Jumlah topup tidak boleh kosong',
            ]);
        }
        Transaction::create([
            'user_id' => auth()->user()->id,
            'reference' => $reqtransaction->reference,
            'type' => 'Topup Balance',
            'merchant_ref' => $reqtransaction->merchant_ref,
            'amount' => $userBalance,
        ]);
        Toast::title('Invoice Topup Balance berhasil di buat.');

        return to_route('transaction.show', [
            'reference' => $reqtransaction->reference,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($reference)
    {
        return view('balance.show', [
            'detail' => $this->tripayRepository->detailTransaction($reference),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
