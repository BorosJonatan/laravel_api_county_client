<?php

use App\Http\Controllers\CountyController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CountyController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Counties
Route::get('/counties', [CountyController::class, 'index'])->name('counties.index');

Route::get('/counties/create', [CountyController::class, 'create'])->name('counties.create');

Route::get('/counties/{id}/edit', [CountyController::class, 'edit'])->name('counties.edit');

Route::post('/counties', [CountyController::class, 'store'])->name('counties.store');

Route::put('/counties/{id}', [CountyController::class, 'update'])->name('counties.update');

Route::delete('/counties/{id}', [CountyController::class, 'destroy'])->name('counties.destroy');

Route::get('/counties/{id}', [CountyController::class, 'show'])->name('counties.show');

// Cities
Route::get('/cities', [CityController::class, 'index'])->name('cities.index');

Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');

Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');

Route::post('/cities', [CityController::class, 'store'])->name('cities.store');

Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');

Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.destroy');

Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');