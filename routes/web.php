<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcelController;

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
Route::resource('users', UserController::class);

//excel
Route::get('/upload', [ExcelController::class, 'showForm'])->name('upload.form');
Route::post('/upload', [ExcelController::class, 'upload'])->name('upload');
