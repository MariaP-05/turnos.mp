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
//se agrega una ruta cuando hay un boton que tiene una funcion en la controladora. sirve para conectar la controladora(dando funcion) con la vista.
Route::get('admin/turnos/cronograma', [App\Http\Controllers\Admin\TurnoController::class, 'cronograma'] )->name('admin.turnos.cronograma')->middleware('auth');

Route::get('admin/turnos/createTurnoPaciente/{id}', [App\Http\Controllers\Admin\TurnoController::class, 'createTurnoPaciente'] )->name('admin.turnos.createTurnoPaciente')->middleware('auth');
//Route::get('admin/pacientes/createPDF', [PacienteController::class, 'createPDF'] )->name('admin.pacientes.createPDF')->middleware('auth');
Route::resource('admin/users', App\Http\Controllers\Admin\UserController::class)->names('admin.users')->middleware('auth');
 
Route::post('admin/pacientes/store_files_contenedor_files/{id}/{i}', [App\Http\Controllers\Admin\PacienteController::class],'store_files_contenedor_files')->name('admin.pacientes.store_files_contenedor_files');
 Route::get('admin/pacientes/delete_file/{id}/{file_name}', [App\Http\Controllers\Admin\PacienteController::class, 'delete_file'] )->name('admin.pacientes.delete_file')->middleware('auth');

Route::get('admin/pacientes/archivos/{id}', [App\Http\Controllers\Admin\PacienteController::class, 'archivos'] )->name('admin.pacientes.archivos')->middleware('auth');
Route::resource('admin/pacientes', App\Http\Controllers\Admin\PacienteController::class)->names('admin.pacientes')->middleware('auth');

Route::resource('admin/turnos', App\Http\Controllers\Admin\TurnoController::class)->names('admin.turnos')->middleware('auth');
Route::resource('admin/profesionales', App\Http\Controllers\Admin\ProfesionalController::class)->names('admin.profesionales')->middleware('auth');
Route::resource('admin/profesiones', App\Http\Controllers\Admin\ProfesionController::class)->names('admin.profesiones')->middleware('auth');
Route::resource('admin/instituciones', App\Http\Controllers\Admin\InstitucionController::class)->names('admin.instituciones')->middleware('auth');
Route::resource('admin/obras_sociales', App\Http\Controllers\Admin\Obra_socialController::class)->names('admin.obras_sociales')->middleware('auth');
Route::resource('admin/tipos_turno', App\Http\Controllers\Admin\TipoTurnoController::class)->names('admin.tipos_turno')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
