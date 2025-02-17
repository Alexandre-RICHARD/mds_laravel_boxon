<?php

use App\Http\Controllers\ContractModelsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('contractModels', [ContractModelsController::class, 'getAll'])->name('contractModels.getAll');
    Route::get('contractModels/id/{id}', [ContractModelsController::class, 'getOne'])->name('contractModels.getOne');
    Route::post('contractModels/create', [ContractModelsController::class, 'create'])->name('contractModels.create');
    Route::put('contractModels/update/id/{id}', [ContractModelsController::class, 'update'])->name('contractModels.update');
    Route::delete('contractModels/delete/id/{id}', [ContractModelsController::class, 'delete'])->name('contractModels.delete');
});

require __DIR__.'/auth.php';
