<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLibro extends Model
{
    
    protected $table = 'tipo_libro';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
