<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'mahasiswa'], function () {
    Route::get('/', [App\Http\Controllers\MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/create', [App\Http\Controllers\MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/store', [App\Http\Controllers\MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/show/{id}', [App\Http\Controllers\MahasiswaController::class, 'show'])->name('mahasiswa.show');
    Route::put('/update/{id}', [App\Http\Controllers\MahasiswaController::class, 'edit'])->name('mahasiswa.update');
    Route::get('/{id}/delete', [App\Http\Controllers\MahasiswaController::class, 'delete'])->name('mahasiswa.delete');
});

Route::group(['prefix' => 'matkul'], function () {
    Route::get('/', [App\Http\Controllers\MatkulController::class, 'index'])->name('matkul.index');
    Route::get('/create', [App\Http\Controllers\MatkulController::class, 'create'])->name('matkul.create');
    Route::post('/store', [App\Http\Controllers\MatkulController::class, 'store'])->name('matkul.store');
    Route::get('/show/{id}', [App\Http\Controllers\MatkulController::class, 'show'])->name('matkul.show');
    Route::put('/update/{id}', [App\Http\Controllers\MatkulController::class, 'edit'])->name('matkul.update');
    Route::get('/{id}/delete', [App\Http\Controllers\MatkulController::class, 'delete'])->name('matkul.delete');
});

Route::group(['prefix' => 'absensi'], function () {
    Route::get('/{matkul_id?}', [App\Http\Controllers\AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/create', [App\Http\Controllers\AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/store', [App\Http\Controllers\AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/show/{id}', [App\Http\Controllers\AbsensiController::class, 'show'])->name('absensi.show');
    Route::put('/update/{id}', [App\Http\Controllers\AbsensiController::class, 'edit'])->name('absensi.update');
    Route::get('/{id}/delete', [App\Http\Controllers\AbsensiController::class, 'delete'])->name('absensi.delete');
});
