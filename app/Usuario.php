<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function completo(){
    	return $this->paterno.' '.$this->materno.' '.$this->nombres;
    }
}
