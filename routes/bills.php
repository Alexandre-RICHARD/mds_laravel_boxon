<?php

use App\Http\Controllers\BillsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('bills', [BillsController::class, 'getAll'])->name('bills.getAll');
});

require __DIR__.'/auth.php';
