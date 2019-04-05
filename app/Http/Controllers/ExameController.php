<?php

namespace App\Http\Controllers;

use App\CategoriaExame;
use App\Exame;
use App\Http\Resources\ExameResource;
use Illuminate\Http\Request;
use App\Http\Resources\ExameCollection;
use Illuminate\Support\Facades\Input;

class ExameController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function listarPorNomeCodSus($nome)
    {
        $resultado = Exame::where('descricao', 'like', '%' . $nome . '%')
            ->orWhere('cod_sus', $nome)->orderBy('descricao')->get();
        return ExameCollection::collection($resultado);
    }

    public function listar()
    {
        return ExameCollection::collection((Exame::all()));
    }
    public function listarCategorias()
    {
        return ExameCollection::collection((CategoriaExame::all()));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function salvar()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function obterPorId($id)
    {
        $retorno = Exame::find($id);
        if($retorno){
            return new ExameResource($retorno);
        }else{
            return response()->json(['error' => 'Nenhum resultado encontrado'], 404);
        }

    }

    public function obterCategoriaPorId($id)
    {
        $retorno = CategoriaExame::find($id);
        if($retorno){
            return new ExameResource($retorno);
        }else{
            return response()->json(['error' => 'Nenhum resultado encontrado'], 404);
        }

    }


    public function obterPorCodSus($codSus){
        if(isset($codSus)){
            $retorno = Exame::where('cod_sus',$codSus)->get();
            return response()->json(['data' => $retorno], 200);
        }else{
            return response()->json(['error' => 'Nenhum resultado encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
