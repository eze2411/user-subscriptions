<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SubscriptionController::class, 'index']);

Route::get('/usuario', [UserController::class, 'search']);

Route::post('/usuario/busqueda', [UserController::class, 'searchList'])
    ->name('usuario.busqueda');

Route::get('/usuario/login/{email}', [UserController::class, 'searchLogin'])
    ->name('usuario.login');
