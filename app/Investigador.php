<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigador extends Model
{
    
    protected $table = 'investigador';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function tipo() {
        return TipoInvestigador::find($this->id_tipo_investigador);
    }

    public function completo(){
    	return $this->paterno.' '.$this->materno.' '.$this->nombres;
    }

    public function conteo(){
    	return Proyecto::where("id_investigador",$this->id)->where("estado","N")->count();
    }

    public function escuela(){
        return Escuela::find($this->id_escuela);
    }
}
