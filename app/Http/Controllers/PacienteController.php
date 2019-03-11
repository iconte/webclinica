<?php



namespace App\Http\Controllers;



use App\Http\Resources\ExameCollection;
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

    public function store(){

        return 'Paciente@store';

    }


    public function listar(){
         return ExameCollection::collection(Pessoa::all());
    }


    public function listarComFiltro(Request $request){
        $parametros = $request;
//        if(isset($parametros)){
            $nome = $parametros['nome'];
            $cpf= $parametros['cpf'];
            $dataNasc = $parametros['dataNascimento'];
            $semParametro = !$nome && !$cpf && !$dataNasc;
            if($semParametro){
                $retorno  = Pessoa::all();
            }else{
                $retorno = DB::table('pessoas')
                    ->when($nome, function ($query) use ($nome) {
                        return $query->where('nome','like', '%'.$nome.'%');
                    })
                    ->when($cpf, function ($query) use ($cpf) {
                        return $query->where('cpf', $cpf);
                    })
                    ->when($dataNasc, function ($query) use ($dataNasc) {
                        return $query->where('data_nasc ', $dataNasc);
                    })->get()    ;
            }

            return ExameCollection::collection($retorno);


//        }

           //TODO listar pessoas left join  funcionarios / medicos
        //}



    }



    /**

     * Show the my users page.

     *

     * @return \Illuminate\Http\Response

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
