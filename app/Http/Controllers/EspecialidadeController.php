<?php

namespace App\Http\Controllers;

use App\Especialidade;
use App\Http\Resources\ExameCollection;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
    public function listar()
    {
        return ExameCollection::collection((Especialidade::all()));
    }
}
