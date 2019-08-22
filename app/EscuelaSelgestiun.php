<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EscuelaSelgestiun extends Model
{
    protected $connection = 'selgestiun';
    
    protected $table = 'tb_escuela';
    protected $primaryKey = 'tb_escuela_id';
    public $timestamps = false;

    public function facultad() {
        return Facultad::find($this->tb_facultad_id);
    }
}