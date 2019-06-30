<?php

namespace App\Http\Controllers;

use App\Agendamento;
use App\Medico;
use App\Pessoa;
use DateTime;
use Exception;
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
        $retorno  = Agendamento::with(['pessoa' => function ($query) use ($nome) {
            $query->where('nome', 'like', '%'.$nome .'%');
        }])
            ->when($medico_id, function ($query) use ($medico_id) {
                return $query->whereRaw('medico_id = '.$medico_id);
            })
            ->when($data, function ($query) use ($data) {
                return $query->whereRaw(DB::raw("date(data_agendamento) = '".$data."'"));
            })
            ->get();

        return response()->json(['data' => $retorno],200);

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nome' => 'required',
            'cpf' => 'required|max:11',
            'medico_id' => 'required',
            'data_agendamento' => 'required',
            'hora_agendamento' => 'required',

        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $cpf= $request->input('cpf');
        $pessoaEncontrada =  Pessoa::all()
            ->where('cpf', $cpf)->first();
        $medicoId= $request->input('medico_id');
        $medico = Medico::with('pessoa')->find($medicoId);
        if(isset($medico)){
            if($medico->pessoa->cpf == $cpf){
                return response()->json(['errors'=>array('Médico e paciente não podem ter o mesmo cpf')]);
            }
        }
        $agendamento = new Agendamento();
        $agendamento->medico_id =($request->input('medico_id'));
        $agendamento->hora_agendamento =($request->input('hora_agendamento'));
        $dataConv = DateTime::createFromFormat('d/m/Y', $request->input('data_agendamento'));
        $dataFormatada= $dataConv->format('Y-m-d');
        $agendamento->data_agendamento =$dataFormatada;
        try{
            DB::beginTransaction(); //marcador para iniciar transações
            if(!$pessoaEncontrada){
                $pessoaEncontrada = new Pessoa();
                $pessoaEncontrada->nome =$request->input('nome');
                $pessoaEncontrada->cpf =$request->input('cpf');
                $pessoaEncontrada->save();
            }
            $agendamento->pessoa_id = $pessoaEncontrada->id;
            $agendamento->save();
            DB::commit(); //validar as transações
        }catch(Exception $e){
            DB::rollback(); //reverter tudo, caso tenha acontecido algum erro.
        }




        return response()->json(['data' => ['message'=>'Registro salvo com sucesso.']],200);

    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nome' => 'required',
            'cpf' => 'required|max:11',
            'medico_id' => 'required',
            'data_agendamento' => 'required',
            'hora_agendamento' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $id = $request->input('id');
        $agendamentoEncontrado = Agendamento::where('id',$id)->first();
        $agendamentoEncontrado->nome = $request->input('nome');
        $agendamentoEncontrado->cpf = $request->input('cpf');
        $agendamentoEncontrado->medico_id = $request->input('medico_id');
        $dataConv = DateTime::createFromFormat('d/m/Y', $request->input('data_agendamento'));
        $dataFormatada= $dataConv->format('Y-m-d');
        $agendamentoEncontrado->data_agendamento = $dataFormatada;
        $agendamentoEncontrado->hora_agendamento = $request->input('hora_agendamento');
        $agendamentoEncontrado->save();
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

    public function listarHorariosDisponiveisPorMedicoData(Request $request)
    {
        $parametros = $request;
        $horariosDisponiveis = array('08:00:00','09:00:00','10:00:00',
            '11:00:00','13:00:00','14:00:00','15:00:00','16:00:00','17:00:00','18:00:00');
        $dataFormatada = $parametros['data_agendamento'];
        $resultado = DB::table("agendamentos")
            ->where('data_agendamento',$dataFormatada)
            ->where('medico_id',$parametros['medicoId'])->pluck('hora_agendamento')->toArray();
        //remover horario encontrado da lista de disponiveis
        if($resultado){
            $horariosDisponiveis= array_values(array_diff($horariosDisponiveis, $resultado));

        }
        return $horariosDisponiveis;

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
