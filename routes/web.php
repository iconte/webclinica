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
});


Route::get('my-home', 'HomeController@myHome')->name('home');

Route::get('novo-usuario', 'UsuarioController@novoUsuario')->name('novo-usuario');

Route::get('buscar-usuarios', 'UsuarioController@buscarUsuarios')->name('buscar-usuarios');


Route::get('novo-paciente', 'PacienteController@novoPaciente')->name('novo-paciente');

Route::get('buscar-pacientes', 'PacienteController@buscarPacientes')->name('buscar-pacientes');


Route::get('novo-medico', 'MedicoController@novoMedico')->name('novo-medico');

Route::get('buscar-medicos', 'MedicoController@buscarMedicos')->name('buscar-medicos');
