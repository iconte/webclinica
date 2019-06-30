<?php

namespace App\Http\Controllers;

use App\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsultaController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'medico_id' => 'required',
            'exame' => 'required',
            'medicamento' => 'required',
            'anamnese' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
            $consulta= new Consulta();
            $consulta->nome = $request->input('nome');
            $consulta->medico_id = $request->input('medico_id');
            $consulta->exame = $request->input('exame');
            $consulta->medicamento = $request->input('medicamento');
            $consulta->anamnese = $request->input('anamnese');
            $consulta->save();

        return response()->json(['data' => ['message'=>'Registro salvo com sucesso.']],200);
    }



        public function viewNovaConsulta()
    {

        return view('/consulta/nova-consulta');

    }


}
