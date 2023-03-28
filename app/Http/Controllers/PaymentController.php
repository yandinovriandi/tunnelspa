<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ProtoneMedia\Splade\Facades\Toast;

class PaymentController extends Controller
{
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
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payment = new Payment();
        if (empty($request->vendor)) {
            throw ValidationException::withMessages([
                'vendor' => 'Vendor harus di isi',
                'mode' => 'Silahkan pilih mode web',
                'api_key' => 'Api Key harus di isi',
                'private_key' => 'Private Key harus di isi',
                'merchant_code' => 'Merchant Code tidak boleh kosong',
                'url' => 'Isi URL website anda.',
                'callback' => 'Callback URL harus di isi'
            ]);
        }
        Payment::create([
            'vendor'=> $request->vendor,
            'mode'=> $request->mode,
            'api_key'=> $request->api_key,
            'private_key'=> $request->private_key,
            'merchant_code'=> $request->merchant_code,
            'url'=> $request->url,
            'callback'=> $request->callback
        ]);
        Toast::title('Success!.')
            ->message('Data Pembayran otomatis telah di simpan.')
            ->backdrop()
            ->autoDismiss(5);
        return to_route('payment.edit',$payment);
    }


    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('payment.edit',[
            'payment' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        if (empty($request->vendor)) {
            throw ValidationException::withMessages([
                'vendor' => 'Vendor harus di isi',
                'mode' => 'Silahkan pilih mode web',
                'api_key' => 'Api Key harus di isi',
                'private_key' => 'Private Key harus di isi',
                'merchant_code' => 'Merchant Code tidak boleh kosong',
                'url' => 'Isi URL website anda.',
                'callback' => 'Callback URL harus di isi'
            ]);
        }
        $payment->update([
            'vendor'=> $request->vendor,
            'mode'=> $request->mode,
            'api_key'=> $request->api_key,
            'private_key'=> $request->private_key,
            'merchant_code'=> $request->merchant_code,
            'url'=> $request->url,
            'callback'=> $request->callback
        ]);
        Toast::title('Success!.')
            ->message('Data Pembayran otomatis telah di simpan.')
            ->backdrop()
            ->autoDismiss(3);
        return to_route('payment.edit',$payment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
