<?php

use App\Http\Controllers\TenantsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // OK
    Route::get('tenants', [TenantsController::class, 'getAll'])->name('tenants.getAll');
    // OK
    Route::get('tenants/id/{id}', [TenantsController::class, 'getOne'])->name('tenants.getOne');
    // OK
    Route::post('tenants/create', [TenantsController::class, 'create'])->name('tenants.create');
    // OK
    Route::put('tenants/update/id/{id}', [TenantsController::class, 'update'])->name('tenants.update');
    // OK
    Route::delete('tenants/delete/id/{id}', [TenantsController::class, 'delete'])->name('tenants.delete');
});

require __DIR__.'/auth.php';
