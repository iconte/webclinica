<?php

namespace App\Http\Controllers;

use App\Agendamento;
use App\Medico;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AgendamentoController extends Controller
{
    public function listarComFiltro(Request $request)
    {
        $parametros = $request;
        $nome = $parametros['nome'];
        $medico_id = $parametros['medico_id'];
        $data = $parametros['data_agendamento'];
        if($data){
            $dataConv = DateTime::createFromFormat('d/m/Y', $data);
            $data = $dataConv->format('Y-m-d');
        }
        $retorno  = Agendamento::with('medico.pessoa')
            ->when($nome, function ($query) use ($nome) {
                return $query->where('nome','like' ,'%'.$nome.'%');
            })
            ->when($medico_id, function ($query) use ($medico_id) {
                return $query->whereRaw('medico_id = '.$medico_id);
            })
            ->when($data, function ($query) use ($data) {
                return $query->whereRaw(DB::raw("date(data_agendamento) = '".$data."'"));
            })->get();

        return response()->json(['data' => $retorno],200);

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nome' => 'required',
            'cpf' => 'required|max:11',
            'medico_id' => 'required',
            'data_agendamento' => 'required',

        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $cpf= $request->input('cpf');
        $medicoId= $request->input('medico_id');
        $medico = Medico::with('pessoa')->find($medicoId);
        if(isset($medico)){
            if($medico->pessoa->cpf == $cpf){
                return response()->json(['errors'=>array('Médico e paciente não podem ter o mesmo cpf')]);
            }
        }
        $agendamento = new Agendamento();
        $agendamento->nome =$request->input('nome');
        $agendamento->cpf =($request->input('cpf'));
        $agendamento->medico_id =($request->input('medico_id'));
        $dataConv = DateTime::createFromFormat('d/m/Y H:i', $request->input('data_agendamento'));
        $dataFormatada= $dataConv->format('Y-m-d H:i');
        $agendamento->data_agendamento =$dataFormatada;
        $agendamento->save();
        return response()->json(['data' => ['message'=>'Registro salvo com sucesso.']],200);

    }


    public function destroy($id)
    {
        try {
            $agEncontrado = Agendamento::find($id);
            if ($agEncontrado) {
                $agEncontrado->delete();
            } else {
                return response()->json(['message' => 'Id não encontrado.'], 204);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return response()->json(['message' => 'Registro não pode ser apagado. Está em uso por outra tabela.']);
            }

        }
    }





    public function viewBuscarAgendamentos()
    {

        return view('/agendamento/busca-agendamento');

    }

    public function viewNovoAgendamento()
    {

        return view('/agendamento/novo-agendamento');

    }
}
