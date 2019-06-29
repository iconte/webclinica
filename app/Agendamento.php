<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $hidden = array('created_at', 'updated_at','deleted_at');

    function medico(){
        return  $this->belongsTo('App\Medico');

    }

    function pessoa(){
        return  $this->belongsTo('App\Pessoa');

    }
}
