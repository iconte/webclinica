<?php



namespace App\Http\Controllers;



use App\Http\Resources\ExameCollection;
use App\Http\Resources\ExameResource;
use App\Medico;
use App\Pessoa;
use DateTime;
use Illuminate\Http\Request;

use App\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Exception;


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

    public function listar()
    {
        return ExameCollection::collection(Medico::with('pessoa')->get());
    }

    public function listarComFiltro(Request $request)
    {
        $parametros = $request;
        $nome = $parametros['nome'];
        $cpf = $parametros['cpf'];
        $crm = $parametros['crm'];
        $retorno  = DB::table('medicos')
            ->join('pessoas', function ($join) use ($nome, $cpf) {
                $join->on('pessoas.id', '=', 'medicos.pessoa_id')
                    ->when($nome,function($query)use ($nome){
                        return $query->where('nome','like','%'.$nome.'%');
                    })
                ->when($cpf,function($query)use ($cpf){
                    return $query->where('cpf',$cpf);
                });
            })->when($crm, function ($query) use ($crm) {
                return $query->where('crm1', $crm);
            })->get();

        return response()->json($retorno);
    }

    public function obterPorId($id)
    {
        $retorno = Medico::with('pessoa')->find($id);
        if($retorno){
            return new ExameResource($retorno);
        }else{
            return response()->json(['error' => 'Nenhum resultado encontrado'], 204);
        }

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nome' => 'required',
            'crm1' => 'required|unique:medicos',
            'crm2' => 'nullable|unique:medicos',
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
            $medico = Medico::where('pessoa_id',$pessoa->id)->first();
            if(isset($medico)){
                return response()->json(['errors'=> array('Já existe um Médico com o cpf informado.')]);
            }
            DB::beginTransaction();
            $pessoa->save();
            $medico= new Medico();
            $medico->crm1 = $request->input('crm1');
            $medico->crm2 = $request->input('crm2');
            $medico->pessoa_id = $pessoa->id;
            $medico->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
        }
        return response()->json(['data' => ['message'=>'Registro salvo com sucesso.']],200);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'crm1' => 'required|unique:medicos',
            'crm2' => 'nullable|unique:medicos',
            'nome' => 'required',
            'cpf' => 'required',
            'dataNasc' => 'nullable|date_format:d/m/Y|before:today',
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
        try {
            $cpf= $request->input('cpf');
            $pessoa = Pessoa::where('cpf', $cpf)->first();
            $medicoCpfDuplicado= null;
            if(isset($pessoa)){
                $medicoCpfEncontrado = Medico::where('pessoa_id',$pessoa->id)->first();
                if(isset($medicoCpfEncontrado)){
                    $idMedicoEditar = $request->input('id');
                    $medicoCpfDuplicado = ($medicoCpfEncontrado->id != $idMedicoEditar);
                    if($medicoCpfDuplicado){
                        return response()->json(['errors'=> array('Já existe um Médico com o cpf informado.')]);
                    }
                }
            }else{
                $pessoa = new Pessoa();
            }
            $medico = Medico::find($request->input('id'));
            $pessoa = $this->preencherDadosPessoa($request, $pessoa);
            DB::beginTransaction();
            $pessoa->save();
            $medico->crm1 = $request->input('crm1');
            $medico->crm2 = $request->input('crm2');
            $medico->pessoa_id = $pessoa->id;
            $medico->save();
            DB::commit();
            return response()->json(['data' => ['message'=>'Registro atualizado com sucesso.']],200);

        }catch (Exception $e){
            DB::rollback();
        }
    }

    public function destroy($id)
    {
        try {
            $medicoEncontrado = Medico::find($id);
            if ($medicoEncontrado) {
                $medicoEncontrado->delete();
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
