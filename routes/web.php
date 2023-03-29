<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');

        Route::middleware('permission:create server')->group(function (){
            Route::resource('server', \App\Http\Controllers\ServerController::class);
            Route::get('tunnels/async',[\App\Http\Controllers\TunnelController::class,'async'])->name('tunnels.async');
            Route::get('tunnels/{tunnel}/sync',[\App\Http\Controllers\TunnelController::class,'sync'])->name('tunnels.sync');
            Route::put('tunnels/{tunnel}/reasync',[\App\Http\Controllers\TunnelController::class,'reasync'])->name('tunnels.reasync');
            Route::resource('payment', \App\Http\Controllers\PaymentController::class);
        });

        Route::resource('tunnels', \App\Http\Controllers\TunnelController::class);
//        Route::resource('balance', \App\Http\Controllers\UserBalaceController::class);
        Route::resource('transaction', \App\Http\Controllers\TransactionController::class);
        Route::get('transaction/{reference}',[\App\Http\Controllers\TransactionController::class, 'show'])->name('transaction.show');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});
Route::post('confirm-payment',[\App\Http\Controllers\TripayCallbackController::class,'handle'])->name('payment.callback');
