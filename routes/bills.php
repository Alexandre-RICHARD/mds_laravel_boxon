<?php

use App\Http\Controllers\BillsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('bills', [BillsController::class, 'getAll'])->name('bills.getAll');
    Route::put('bills/pay/id/{id}', [BillsController::class, 'payBill'])->name('bills.pay');
    Route::get('bills/download/id/{id}', [BillsController::class, 'downloadBillInPdf'])->name('bills.download');
});

require __DIR__.'/auth.php';
