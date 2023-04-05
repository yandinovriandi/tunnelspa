<?php

namespace App\Repositories;

class TripayRepository
{
    public function getPaymentChannels(): array|string
    {
        $payment = \App\Models\Payment::get()->first();

        $apiKey = $payment->api_key;

        $curl = curl_init();
        $mode = $payment->mode; // get mode from application config
        if ($mode === 'local') {
            $url = 'https://tripay.co.id/api-sandbox/merchant/payment-channel?';
        } else {
            $url = 'https://tripay.co.id/api/merchant/payment-channel?';
        }
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;

        return $response ?: $error;
    }

    public function requestTransaction($userBalance, $method)
    {
        $payment = \App\Models\Payment::get()->first();
        $redirect_url = $payment->url;
        $apiKey = $payment->api_key;
        $privateKey = $payment->private_key;
        $merchantCode = $payment->merchant_code;
        $word = '';
        for ($i = 0; $i < 4; $i++) {
            $rand = rand(65, 90); // menghasilkan nilai acak antara 65 dan 90, yang merepresentasikan karakter huruf kapital ASCII
            $char = chr($rand); // mengonversi nilai acak menjadi karakter ASCII
            $word .= strtoupper($char); // mengubah karakter menjadi huruf kapital dan menggabungkannya ke dalam string
        }
        $merchantRef = 'INVM-'.time().$word;
        $user = auth()->user();
        $data = [
            'method' => $method,
            'merchant_ref' => $merchantRef,
            'amount' => $userBalance,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            //            'customer_phone' => '081234567890',
            'order_items' => [
                [
                    'name' => 'Topup Balance',
                    'price' => $userBalance,
                    'quantity' => 1,
                    //                    'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                    //                    'image_url'   => 'https://tokokamu.com/product/nama-produk-1.jpg',
                ],
            ],
            'return_url' => $redirect_url,
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature' => hash_hmac('sha256', $merchantCode.$merchantRef.$userBalance, $privateKey),
        ];

        $curl = curl_init();
        $mode = $payment->mode; // get mode from application config
        if ($mode === 'local') {
            $url = 'https://tripay.co.id/api-sandbox/transaction/create';
        } else {
            $url = 'https://tripay.co.id/api/transaction/create';
        }
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        $response = json_decode($response)->data;

        return $response ?: $error;
    }

    public function detailTransaction($reference)
    {
        $payment = \App\Models\Payment::get()->first();
        $apiKey = $payment->api_key;

        $payload = ['reference' => $reference];

        $curl = curl_init();
        $mode = $payment->mode; // get mode from application config
        if ($mode === 'local') {
            $url = 'https://tripay.co.id/api-sandbox/transaction/detail?'.http_build_query($payload);
        } else {
            $url = 'https://tripay.co.id/api/transaction/detail?'.http_build_query($payload);
        }
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;

        return $response ?: $error;
    }
}
