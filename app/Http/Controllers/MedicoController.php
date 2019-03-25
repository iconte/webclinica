<?php



namespace App\Http\Controllers;



use App\Http\Resources\ExameCollection;
use App\Medico;
use App\Pessoa;
use DateTime;
use Illuminate\Http\Request;

use App\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class MedicoController extends Controller

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
        $validator = Validator::make($request->all(),[
            'nome' => 'required',
            'crm' => 'required',
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
        $cpf= $request->input('cpf');
        $pessoa = Pessoa::where('cpf', $cpf)->first();
        if(!isset($pessoa)){
            $pessoa= new Pessoa();
        }
        $pessoa = $this->preencherDadosPessoa($request,$pessoa);
        try{
            DB::beginTransaction();
            $pessoa->save();
            $medico = Medico::where('pessoa_id',$pessoa->id)->first();
            if(!isset($medico)){
                $medico= new Medico();
            }
            $medico->crm1 = $request->input('crm');
            $medico->crm2 = $request->input('crm2');
            $medico->pessoa_id = $pessoa->id;
            $medico->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
        }





        return response()->json(['data' => ['message'=>'Registro salvo com sucesso.']],200);
    }


    private function preencherDadosPessoa(Request $request, $pessoa){
        $pessoa->nome = $request->input('nome');
        $pessoa->cpf = $request->input('cpf');
        $dataConv = DateTime::createFromFormat('d/m/Y', $request->input('dataNasc'));
        $dataFormatada= $dataConv->format('Y-m-d');
        $pessoa->data_nasc = $dataFormatada;
        $pessoa->sexo = $request->input('sexo');
        $pessoa->tel_cel = $request->input('tel_cel');
        $pessoa->email = $request->input('email');
        $pessoa->cep = $request->input('cep');
        $pessoa->endereco = $request->input('endereco');
        $pessoa->numero = $request->input('numero');
        $pessoa->complemento = $request->input('complemento');
        $pessoa->bairro = $request->input('bairro');
        $pessoa->cidade = $request->input('cidade');
        $pessoa->uf = $request->input('uf');
        return $pessoa;
    }

    /**

     * Show the my users page.

     *

     * @return \Illuminate\Http\Response

     */

    public function viewBuscarMedicos()
    {

        return view('/medico/busca-medico');

    }

    public function viewNovoMedico()
    {

        return view('/medico/novo-medico');

    }


}
