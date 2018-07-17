<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    
    protected $table = 'grupo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function tipo() {
        return TipoGrupo::find($this->id_tipo_grupo);
    }

    public function conteo(){
    	return Proyecto::where("id_grupo",$this->id)->where("estado","N")->count();
    }
}
