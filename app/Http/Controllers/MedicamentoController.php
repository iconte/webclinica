<?php

namespace App\Http\Controllers;

use App\ClasseTerapeutica;
use App\Http\Resources\ExameCollection;
use App\Http\Resources\ExameResource;
use App\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    //


    public function listar()
    {
        return ExameCollection::collection((Medicamento::paginate()));
    }

    public function listarClassesTerapeuticas()
    {
        return ExameCollection::collection((ClasseTerapeutica::all()));
    }

    public function listarClassesTerapeuticasPorCodigo($codigo)
    {
        $retorno = ClasseTerapeutica::where('cod_ct',$codigo)->get();
        if(!$retorno){
            return response()->json(['data'=>$retorno]);
        }else{
            return response()->json(['error' => 'Nenhum resultado encontrado'], 404);
        }

    }

}
