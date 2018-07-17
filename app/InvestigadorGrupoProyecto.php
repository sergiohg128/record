<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestigadorGrupoProyecto extends Model
{
    
    protected $table = 'investigador_grupo_proyecto';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function investigadorgrupo() {
        return InvestigadorGrupo::find($this->id_investigador_grupo);
    }

    public function proyecto() {
        return Proyecto::find($this->id_proyecto);
    }
}
