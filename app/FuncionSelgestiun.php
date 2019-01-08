<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuncionSelgestiun extends Model
{
    protected $connection = 'selgestiun';
    
    protected $table = 'tb_funcion';
    protected $primaryKey = 'tb_funcion_id';
    public $timestamps = false;
    
    
    
}
