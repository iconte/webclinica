<?php


namespace App\Http\Controllers;


use App\Http\Resources\ExameCollection;
use App\Http\Resources\ExameResource;
use App\Pessoa;
use Illuminate\Http\Request;

use App\Item;
use Illuminate\Support\Facades\DB;


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

    public function store(Request $request)
    {

        $pessoa = new Pessoa();
        $pessoa->nome = $request->input('nome');
        $pessoa->cpf = $request->input('cpf');
        $pessoa->data_nasc = $request->input('dataNasc');
        $pessoa->sexo = $request->input('sexo');
        $pessoa->sexo = $request->input('tel_res');
        $pessoa->tel_cel = $request->input('tel_cel');
        $pessoa->email = $request->input('email');
        $pessoa->cep = $request->input('cep');
        $pessoa->endereco = $request->input('endereco');
        $pessoa->numero = $request->input('numero');
        $pessoa->complemento = $request->input('complemento');
        $pessoa->bairro = $request->input('bairro');
        $pessoa->cidade = $request->input('cidade');
        $pessoa->uf = $request->input('uf');


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

        $retorno = $query->paginate(10);
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
