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

Route::get('/exame', 'ExameController@listar');
Route::get('/exame/{id}', 'ExameController@obterPorId')->where('id', '[0-9]+');
Route::get('/exame-por-codsus/{codsus}', 'ExameController@obterPorCodSus')->where('codsus', '[0-9]+');
Route::get('/exame/categoria', 'ExameController@listarCategorias');
Route::get('/exame/categoria/{id}', 'ExameController@obterCategoriaPorId')->where('id', '[0-9]+');

Route::get('/medicamento/', 'MedicamentoController@listar');
Route::get('/medicamento/{id}', 'MedicamentoController@obterPorId')->where('id', '[0-9]+');
Route::get('/medicamento/classe-terapeutica', 'MedicamentoController@listarClassesTerapeuticas');
Route::get('/medicamento/classe-terapeutica/{codigo}', 'MedicamentoController@listarClassesTerapeuticasPorCodigo');

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