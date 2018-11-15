<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioSelgestiun extends Model
{
    protected $connection = 'selgestiun';

    protected $table = 'tb_usuario';
    protected $primaryKey = 'tb_usuario_id';
    public $timestamps = false;
    
    public function completo(){
    	return $this->tb_usuario_apellidopaterno.' '.$this->tb_usuario_apellidomaterno.' '.$this->tb_usuario_nombre;
    }
}
