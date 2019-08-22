<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultadSelgestiun extends Model
{
    protected $connection = 'selgestiun';
    
    protected $table = 'tb_facultad';
    protected $primaryKey = 'tb_facultad_id';
    public $timestamps = false;
}
