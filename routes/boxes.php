<?php

use App\Http\Controllers\BoxesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('boxes', [BoxesController::class, 'getAll'])->name('boxes.getAll');
    Route::get('boxes/id/{id}', [BoxesController::class, 'getOne'])->name('boxes.getOne');
    Route::post('boxes/create', [BoxesController::class, 'create'])->name('boxes.create');
    Route::put('boxes/update/id/{id}', [BoxesController::class, 'update'])->name('boxes.update');
    Route::delete('boxes/delete/id/{id}', [BoxesController::class, 'delete'])->name('boxes.delete');
});

require __DIR__.'/auth.php';
