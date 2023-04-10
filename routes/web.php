<?php

use App\Http\Controllers\BottelegramController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TripayCallbackController;
use App\Http\Controllers\TunnelController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;


Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', HomeController::class)->name('home');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::middleware('permission:create server')->group(function () {
            Route::resource('server', ServerController::class);
            Route::post('tunnels/{tunnel}/deactive', [TunnelController::class, 'removeActive'])->name('tunnels.deactive');
            Route::get('tunnels/async', [TunnelController::class, 'async'])->name('tunnels.async');
            Route::get('tunnels/{tunnel}/sync', [TunnelController::class, 'sync'])->name('tunnels.sync');
            Route::put('tunnels/{tunnel}/reasync', [TunnelController::class, 'reasync'])->name('tunnels.reasync');
            Route::resource('payment', PaymentController::class);

            Route::resource('whatsapp', WhatsappController::class);
            Route::resource('bottelegram', BottelegramController::class);
        });

        Route::resource('tunnels', TunnelController::class);
        Route::put('tunnels/{tunnel}/renew', [TunnelController::class, 'renew'])->name('tunnels.renew');
        Route::resource('transaction', TransactionController::class);
        Route::get('transaction/{reference}', [TransactionController::class, 'show'])->name('transaction.show');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});
Route::post('confirm-payment', [TripayCallbackController::class, 'handle'])->name('payment.callback');
Route::get('log-viewers', [LogViewerController::class, 'index']);
