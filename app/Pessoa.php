<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $dateFormat = 'd/m/Y';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'data_nasc',
    ];

    public function funcionario(){
        return $this->hasOne('App\Funcionario');
    }

    public function medico(){
        return $this->hasOne('App\Medico');
    }

    protected $hidden = array('created_at', 'updated_at','deleted_at');
}
