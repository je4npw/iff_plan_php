<?php

use App\Http\Controllers\AcolhidoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//login
Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [AuthController::class, 'login']);

//register
Route::get('register', function () {
    return view('auth.register');
})->name('register')
    ->middleware('auth');

Route::post('register', [AuthController::class, 'register']);

//logout
Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth');

//Home
Route::get('/home', [DashboardController::class, 'index'])->name('home')
    ->middleware('auth');

//users
Route::resource('users', UserController::class)
    ->middleware('auth');

//csv import
Route::get('/upload', [AcolhidoController::class, 'showForm'])
    ->name('upload.form')
    ->middleware('auth');
Route::post('/acolhidos/import', [AcolhidoController::class, 'import'])
    ->name('acolhidos.import');

//acolhidos
Route::resource('acolhidos', AcolhidoController::class);
