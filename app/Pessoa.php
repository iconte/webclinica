<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{


    public function medico(){
        return $this->hasOne('App\Medico');
    }

    protected $hidden = array('created_at', 'updated_at','deleted_at');
}
