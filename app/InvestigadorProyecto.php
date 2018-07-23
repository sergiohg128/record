<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestigadorProyecto extends Model
{
    
    protected $table = 'investigador_proyecto';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function investigador() {
        return Investigador::find($this->id_investigador);
    }

    public function proyecto() {
        return Proyecto::find($this->id_proyecto);
    }

    public function completo(){
        $investigador = Investigador::find($this->id_investigador);
    	return $investigador->paterno.' '.$investigador->materno.' '.$investigador->nombres;
    }
}
