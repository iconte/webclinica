<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/paciente', 'PacienteController@store');
Route::put('/paciente', 'PacienteController@update');
Route::delete('/paciente/{id}', 'PacienteController@destroy')->where('id', '[0-9]+');
Route::get('/paciente', 'PacienteController@listar');
Route::get('/paciente/{id}', 'PacienteController@obterPorId')->where('id', '[0-9]+');
Route::get('/paciente/filtro', 'PacienteController@listarComFiltro');
Route::get('/paciente/por-cpf/{cpf}', 'PacienteController@listarPorCpf');

Route::get('/especialidade', 'EspecialidadeController@listar');


Route::post('/medico', 'MedicoController@store');
Route::get('/medico', 'MedicoController@listar');
Route::get('/medico/filtro', 'MedicoController@listarComFiltro');
Route::get('/medico/{id}', 'MedicoController@obterPorId')->where('id', '[0-9]+');
Route::put('/medico', 'MedicoController@update');
Route::delete('/medico/{id}', 'MedicoController@destroy')->where('id', '[0-9]+');


Route::post('/agendamento', 'AgendamentoController@store');
Route::put('/agendamento', 'AgendamentoController@update');
Route::get('/agendamento/filtro', 'AgendamentoController@listarComFiltro');
Route::get('/agendamento/horario', 'AgendamentoController@listarHorariosDisponiveisPorMedicoData');
Route::delete('/agendamento/{id}', 'AgendamentoController@destroy')->where('id', '[0-9]+');


Route::get('/exame', 'ExameController@listar');
Route::get('/exame/nome-codsus/{filtro}', 'ExameController@listarPorNomeCodSus');
Route::get('/exame/{id}', 'ExameController@obterPorId')->where('id', '[0-9]+');
Route::get('/exame-por-codsus/{codsus}', 'ExameController@obterPorCodSus')->where('codsus', '[0-9]+');
Route::get('/exame/categoria', 'ExameController@listarCategorias');
Route::get('/exame/categoria/{id}', 'ExameController@obterCategoriaPorId')->where('id', '[0-9]+');


Route::get('/medicamento', 'MedicamentoController@listar');
Route::get('/medicamento/nome/{nome}', 'MedicamentoController@listarPorNome');
Route::get('/medicamento/{id}', 'MedicamentoController@obterPorId')->where('id', '[0-9]+');
Route::get('/medicamento/classe-terapeutica', 'MedicamentoController@listarClassesTerapeuticas');
Route::get('/medicamento/classe-terapeutica/{codigo}', 'MedicamentoController@listarClassesTerapeuticasPorCodigo');


Route::post('/consulta', 'ConsultaController@store');

Route::get('/viacep/{cep}', function($cep){
    $retorno = zipcode($cep);
    if($retorno){
      $retorno = $retorno->getJson();
    }
    return $retorno;
});

Route::fallback(function(){
    return response()->json(['message' => 'Nenhum resultado encontrado.'], 404);
})->name('fallback');