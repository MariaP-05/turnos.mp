<?php

use App\Http\Controllers\Admin\ClienteController;
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

Route::get('admin/clientes/createTXT', [ClienteController::class, 'createTXT'] )->name('admin.clientes.createTXT');
Route::get('admin/clientes/createPDF', [ClienteController::class, 'createPDF'] )->name('admin.clientes.createPDF');
Route::resource('admin/users', App\Http\Controllers\Admin\UserController::class)->names('admin.users');
Route::resource('admin/bancos', App\Http\Controllers\Admin\BancoController::class)->names('admin.bancos');
Route::resource('admin/clientes', App\Http\Controllers\Admin\ClienteController::class)->names('admin.clientes');
Route::resource('admin/servicios', App\Http\Controllers\Admin\ServicioController::class)->names('admin.servicios');
Route::resource('admin/servicios_valores', App\Http\Controllers\Admin\ServicioValorController::class)->names('admin.servicios_valores');
Route::resource('admin/cliente_servicios', App\Http\Controllers\Admin\ClienteServiciosController::class)->names('admin.cliente_servicios');
