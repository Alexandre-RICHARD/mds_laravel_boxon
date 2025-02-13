<?php

use App\Http\Controllers\BoxesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('boxes', [BoxesController::class, 'getAll'])->name('boxes.getAll');
    Route::get('boxes/id/{id}', [BoxesController::class, 'getOne'])->name('boxes.getOne');
    Route::post('boxes/create', [BoxesController::class, 'create'])->name('boxes.create');

    Route::post('boxes', [BoxesController::class, 'store'])->name('boxes.store');
    Route::get('boxes/{box}', [BoxesController::class, 'show'])->name('boxes.show');
    Route::get('boxes/{box}/edit', [BoxesController::class, 'edit'])->name('boxes.edit');
    Route::put('boxes/{box}', [BoxesController::class, 'update'])->name('boxes.update');
    Route::delete('boxes/{box}', [BoxesController::class, 'destroy'])->name('boxes.destroy');
});

require __DIR__.'/auth.php';
