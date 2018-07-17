<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoInvestigador extends Model
{
    
    protected $table = 'tipo_investigador';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}
