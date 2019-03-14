<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    //
    function pessoa(){
      return  $this->belongsTo('App\Pessoa');

    }

    protected $hidden = array('created_at', 'updated_at','deleted_at');
}
