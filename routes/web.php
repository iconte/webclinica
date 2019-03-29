<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Auth::routes();

Route::get('my-home', 'HomeController@index')->name('myHome');

Route::get('novo-usuario', 'UsuarioController@viewNovoUsuario')->name('novo-usuario');

Route::get('buscar-usuarios', 'UsuarioController@viewBuscarUsuarios')->name('buscar-usuarios');


Route::get('novo-paciente', 'PacienteController@viewNovoPaciente')->name('novo-paciente');

Route::get('buscar-pacientes', 'PacienteController@viewBuscarPacientes')->name('buscar-pacientes');


Route::get('novo-medico', 'MedicoController@viewNovoMedico')->name('novo-medico');

Route::get('buscar-medicos', 'MedicoController@viewBuscarMedicos')->name('buscar-medicos');

Route::get('/home', 'HomeController@index')->name('home');
