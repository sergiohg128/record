<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoSelgestiun extends Model
{
    protected $connection = 'selgestiun';
    
    protected $table = 'tb_proyecto';
    protected $primaryKey = 'tb_proyecto_id';
    public $timestamps = false;
    
    

}
