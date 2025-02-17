<?php

use App\Http\Controllers\TenantsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('tenants', [TenantsController::class, 'getAll'])->name('tenants.getAll');
    Route::get('tenants/id/{id}', [TenantsController::class, 'getOne'])->name('tenants.getOne');
    Route::post('tenants/create', [TenantsController::class, 'create'])->name('tenants.create');
    Route::put('tenants/update/id/{id}', [TenantsController::class, 'update'])->name('tenants.update');
    Route::delete('tenants/delete/id/{id}', [TenantsController::class, 'delete'])->name('tenants.delete');
});

require __DIR__.'/auth.php';
