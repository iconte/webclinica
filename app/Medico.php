<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    //
    function pessoa(){
        return  $this->belongsTo('App\Funcionario');

    }

    protected $hidden = array('created_at', 'updated_at');
}
