<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProyecto extends Model
{
    
    protected $table = 'tipo_proyecto';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}
