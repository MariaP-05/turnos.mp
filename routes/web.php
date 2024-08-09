<?php

//use App\Http\Controllers\Admin\PacienteController;
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

//Route::get('admin/pacientes/createTXT', [PacienteController::class, 'createTXT'] )->name('admin.pacientes.createTXT')->middleware('auth');
//Route::get('admin/pacientes/createPDF', [PacienteController::class, 'createPDF'] )->name('admin.pacientes.createPDF')->middleware('auth');
Route::resource('admin/users', App\Http\Controllers\Admin\UserController::class)->names('admin.users')->middleware('auth');
Route::resource('admin/pacientes', App\Http\Controllers\Admin\PacienteController::class)->names('admin.pacientes')->middleware('auth');

Route::resource('admin/turnos', App\Http\Controllers\Admin\TurnoController::class)->names('admin.turnos')->middleware('auth');
Route::resource('admin/profesionales', App\Http\Controllers\Admin\ProfesionalController::class)->names('admin.profesionales')->middleware('auth');
Route::resource('admin/profesiones', App\Http\Controllers\Admin\ProfesionController::class)->names('admin.profesiones')->middleware('auth');
Route::resource('admin/instituciones', App\Http\Controllers\Admin\InstitucionController::class)->names('admin.instituciones')->middleware('auth');
Route::resource('admin/obras_sociales', App\Http\Controllers\Admin\Obra_socialController::class)->names('admin.obras_sociales')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
