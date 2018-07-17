<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    
    protected $table = 'escuela';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function facultad() {
        return Facultad::find($this->id_facultad);
    }
}
