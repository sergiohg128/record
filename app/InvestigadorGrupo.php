<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestigadorGrupo extends Model
{
    
    protected $table = 'investigador_grupo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function investigador() {
        return Investigador::find($this->id_investigador);
    }

    public function grupo() {
        return Grupo::find($this->id_grupo);
    }
}
