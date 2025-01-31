<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('user-management')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('user-management-index');
        Route::get('/list', [UserManagementController::class, 'list'])->name('user-management-list');
        Route::get('/tambah', [UserManagementController::class, 'create'])->name('user-management-tambah');
        Route::post('/simpan', [UserManagementController::class, 'store'])->name('user-management-simpan');
        Route::get('/detail/{id}', [UserManagementController::class, 'show'])->name('user-management-detail');
        Route::get('/edit/{id}', [UserManagementController::class, 'edit'])->name('user-management-edit');
        Route::post('/update', [UserManagementController::class, 'update'])->name('user-management-update');
        Route::get('/hapus/{id}', [UserManagementController::class, 'delete'])->name('user-management-hapus');
    });
});
