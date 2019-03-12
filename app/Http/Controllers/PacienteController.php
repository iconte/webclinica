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
       //     $semParametro = !$nome && !$cpf && !$dataNasc;
            $query = DB::table('pessoas');


            if($nome){
                $query->where('nome', 'like', '%'.$nome.'%');
            }

            if($cpf){
                $query->where('cpf', '=' ,$cpf);
             }
            if($dataNasc){
                $query->where('data_nasc', '=' ,$dataNasc);
            }

            $retorno = $query->paginate(10);
            return response()->json($retorno);


//        }

           //TODO listar pessoas left join  funcionarios / medicos
        //}



    }

    function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#')
            {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else
            {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
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
