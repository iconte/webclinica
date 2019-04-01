<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $hidden = array('created_at', 'updated_at','deleted_at');
}
