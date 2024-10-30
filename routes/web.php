<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\MoradorController;
use App\Http\Controllers\UnidadeController;
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
Route::get('/upload', [MoradorController::class, 'showForm'])
    ->name('upload.form')
    ->middleware('auth');
Route::post('/moradores/import', [MoradorController::class, 'import'])
    ->name('moradores.import');

//moradores
Route::resource('moradores', MoradorController::class)->parameters([
    'moradores' => 'morador'
]);

// imagem morador
Route::post('/moradores/upload-imagem', [MoradorController::class, 'uploadImagem'])
    ->name('moradores.uploadImagem');

//unidades
Route::resource('unidades', UnidadeController::class);

//medicamentos
Route::resource('medicamentos', MedicamentoController::class);
