<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function(){
    return redirect()->route('login');
    
});

Route::resource('admin/users', App\Http\Controllers\Admin\UserController::class)->names('admin.users');
Route::resource('admin/bancos', App\Http\Controllers\Admin\BancoController::class)->names('admin.bancos');
Route::resource('admin/clientes', App\Http\Controllers\Admin\ClienteController::class)->names('admin.clientes');
