<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    
    protected $table = 'linea';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function programa() {
        return Programa::find($this->id_programa);
    }
}
