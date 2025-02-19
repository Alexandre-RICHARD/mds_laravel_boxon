<?php

use App\Http\Controllers\ContractsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // OK
    Route::get('contracts', [ContractsController::class, 'getAll'])->name('contracts.getAll');
    // OK
    Route::get('contracts/id/{id}', [ContractsController::class, 'getOne'])->name('contracts.getOne');
    // Foire très souvent à cause de la condition faisant qu'on ne peut créer un contrat avec un box déjà pris (pas eu le temps de filtrer)
    Route::post('contracts/create', [ContractsController::class, 'create'])->name('contracts.create');
    // OK
    Route::put('contracts/update/id/{id}', [ContractsController::class, 'update'])->name('contracts.update');
    // OK
    Route::delete('contracts/delete/id/{id}', [ContractsController::class, 'delete'])->name('contracts.delete');
    // OK
    Route::get('/contracts/download/id/{id}', [ContractsController::class, 'downloadContract'])->name('contracts.download');
});

require __DIR__.'/auth.php';
