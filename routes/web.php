<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExcelController;
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
Route::get('/home', function () {
    return view('home');
})->name('home')
    ->middleware('auth');

//users
Route::resource('users', UserController::class)
    ->middleware('auth');

//excel
Route::get('/upload', [ExcelController::class, 'showForm'])
    ->name('upload.form')
    ->middleware('auth');
Route::post('/upload', [ExcelController::class, 'upload'])->name('upload');
