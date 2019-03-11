<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Item;



class UsuarioController extends Controller

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

    public function viewBuscarUsuarios()

    {

        return view('/usuario/busca-usuario');

    }

    public function viewNovoUsuario()

    {

        return view('/usuario/novo-usuario');

    }


}
