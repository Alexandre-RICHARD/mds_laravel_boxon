<?php

use App\Http\Controllers\BillsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // OK
    Route::get('bills', [BillsController::class, 'getAll'])->name('bills.getAll');
    // A fonctionner mais bug maintenant très souvent, pas eu le temps d'investiguer
    Route::put('bills/pay/id/{id}', [BillsController::class, 'payBill'])->name('bills.pay');
    // OK
    Route::get('bills/download/id/{id}', [BillsController::class, 'downloadBillInPdf'])->name('bills.download');
});

require __DIR__.'/auth.php';
