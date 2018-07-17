<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    
    protected $table = 'proyecto';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function tipo() {
        return TipoProyecto::find($this->id_tipo_proyecto);
    }

    public function investigador() {
        return Investigador::find($this->id_investigador);
    }

    public function grupo() {
        return Grupo::find($this->id_grupo);
    }

    public function responsable(){
        if($this->modalidad=="I"){
            return Investigador::find($this->id_investigador)->completo();
        }else{
            return Grupo::find($this->id_grupo)->nombre;       
        }
    }

    public function linea(){
        if($this->id_linea>0){
            return Linea::find($this->id_linea);
        }else{
            $linea = new Linea();
            $linea->id = 0;
            $linea->nombre = "Sin Linea";
            return $linea;
        }
    }
}
