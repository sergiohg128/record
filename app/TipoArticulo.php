<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoArticulo extends Model
{
    
    protected $table = 'tipo_articulo';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
