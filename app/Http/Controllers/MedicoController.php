<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Item;



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
