<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestigadorProyecto extends Model
{
    
    protected $table = 'investigador_proyecto';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function investigador() {
        return UsuarioSelgestiun::find($this->id_investigador);
    }

    public function proyecto() {
        return Proyecto::find($this->id_proyecto);
    }

    public function completo(){
        $investigador = UsuarioSelgestiun::find($this->id_investigador);
    	return $investigador->tb_usuario_apellidopaterno.' '.$investigador->tb_usuario_apellidomaterno.' '.$investigador->tb_usuario_nombre;
    }
}
