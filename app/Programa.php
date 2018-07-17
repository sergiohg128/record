<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class programa extends Model
{
    
    protected $table = 'programa';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function escuela() {
        return Escuela::find($this->id_escuela);
    }
}
