<?php

//namespace App\Http\Middleware;
//
//use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
//
//class VerifyCsrfToken extends Middleware
//{
//    /**
//     * The URIs that should be excluded from CSRF verification.
//     *
//     * @var array<int, string>
//     */
//    protected $except = [
//        'http://5a9e-125-164-21-200.ngrok.io/callback'
//    ];
//}

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [];

    /**
     * Add URIs that should be excluded from CSRF verification.
     *
     * @return void
     */
    protected function addExceptUris()
    {
        $payment = \App\Models\Payment::first();
        if ($payment) {
            $this->except[] = route('payment.callback', ['payment_code' => $payment->payment_code]);
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $this->addExceptUris();

        return parent::handle($request, $next);
    }
}
