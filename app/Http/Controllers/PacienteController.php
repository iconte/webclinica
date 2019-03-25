<?php


namespace App\Http\Controllers;


use App\Http\Resources\ExameCollection;
use App\Http\Resources\ExameResource;
use App\Pessoa;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PacienteController extends Controller

{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()

    {


    }

    private function preencherDadosPessoa(Request $request, $pessoa){
        $pessoa->nome = $request->input('nome');
        $pessoa->cpf = $request->input('cpf');
        $dataConv = DateTime::createFromFormat('d/m/Y', $request->input('dataNasc'));
        $dataFormatada= $dataConv->format('Y-m-d');
        $pessoa->data_nasc = $dataFormatada;
        $pessoa->sexo = $request->input('sexo');
        $pessoa->tel_res = $request->input('tel_res');
        $pessoa->tel_cel = $request->input('tel_cel');
        $pessoa->email = $request->input('email');
        $pessoa->cep = $request->input('cep');
        $pessoa->sexo = $request->input('sexo');
        $pessoa->endereco = $request->input('endereco');
        $pessoa->numero = $request->input('numero');
        $pessoa->complemento = $request->input('complemento');
        $pessoa->bairro = $request->input('bairro');
        $pessoa->cidade = $request->input('cidade');
        $pessoa->uf = $request->input('uf');
        return $pessoa;
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nome' => 'required',
            'cpf' => 'required|unique:pessoas',
            'dataNasc' => 'required|date_format:d/m/Y|before:today',
            'tel_cel' => 'required',
            'email' => 'required|email',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required'
       ]);
       if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $pessoa = new Pessoa();
        $pessoa = $this->preencherDadosPessoa($request,$pessoa);
        $pessoa->save();
        return response()->json(['data' => ['message'=>'Registro salvo com sucesso.']],200);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'nome' => 'required',
            'cpf' => 'required',
            'dataNasc' => 'required|date_format:d/m/Y|before:today',
            'tel_cel' => 'required',
            'email' => 'required|email',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'id' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $pessoa = Pessoa::find($request->input('id'));
        if($pessoa){
            $pessoa = $this->preencherDadosPessoa($request,$pessoa);
            $pessoa->save();
        }else{
            return response()->json(['message'=>'Registro não encontrado.'],204);
        }


        return response()->json(['data' => ['message'=>'Registro atualizado com sucesso.']],200);
    }

    public function destroy($id)
    {
        try{
            $pessoaEncontrada = Pessoa::find($id);
            if($pessoaEncontrada){
                $pessoaEncontrada->delete();
            }else{
                return response()->json(['message'=>'Id não encontrado.'],204);
            }
        }catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1451){
                return response()->json(['message'=>'Registro não pode ser apagado. Está em uso por outra tabela.']);
            }

        }


    }

    public function obterPorId($id)
    {
        $retorno = Pessoa::find($id);
        if($retorno){
            return new ExameResource($retorno);
        }else{
            return response()->json(['error' => 'Nenhum resultado encontrado'], 204);
        }

    }


    public function listar()
    {
        return ExameCollection::collection(Pessoa::all());
    }

    public function listarPorCpf($cpf)
    {
        $retorno = $users = Pessoa::all(['id', 'cpf'])
            ->where('cpf', $cpf)->first();
        return response()->json(['data' => $retorno]);
    }


    public function listarComFiltro(Request $request)
    {
        $parametros = $request;
        $nome = $parametros['nome'];
        $cpf = $parametros['cpf'];
        $dataNasc = $parametros['dataNascimento'];

        $query = DB::table('pessoas');
        if ($nome) {
            $query->whereRaw('upper(nome) like ?', ['%' . strtoupper($nome) . '%']);
        }

        if ($cpf) {
            $query->where('cpf', '=', $cpf);
        }
        if ($dataNasc) {
            $query->where('data_nasc', '=', $dataNasc);
        }

        $retorno = $query->paginate();
        return response()->json($retorno);
    }

    //==========================================================================
    //==========================================================================
    /**
     *  VIEWS
     */
    public function viewBuscarPacientes()

    {

        return view('/paciente/busca-paciente');

    }

    public function viewNovoPaciente()

    {

        return view('/paciente/novo-paciente');

    }


}
