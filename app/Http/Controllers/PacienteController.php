<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Item;



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



    /**

     * Show the my users page.

     *

     * @return \Illuminate\Http\Response

     */

    public function buscarPacientes()

    {

        return view('/paciente/busca-paciente');

    }

    public function novoPaciente()

    {

        return view('/paciente/novo-paciente');

    }




}
