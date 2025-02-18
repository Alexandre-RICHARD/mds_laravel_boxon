<?php

use App\Http\Controllers\ContractsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('contracts', [ContractsController::class, 'getAll'])->name('contracts.getAll');
    Route::get('contracts/id/{id}', [ContractsController::class, 'getOne'])->name('contracts.getOne');
    Route::post('contracts/create', [ContractsController::class, 'create'])->name('contracts.create');
    Route::put('contracts/update/id/{id}', [ContractsController::class, 'update'])->name('contracts.update');
    Route::delete('contracts/delete/id/{id}', [ContractsController::class, 'delete'])->name('contracts.delete');
});

require __DIR__.'/auth.php';
