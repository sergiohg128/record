<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivoSelgestiun extends Model
{
    protected $connection = 'selgestiun';
    
    protected $table = 'tb_archivo';
    protected $primaryKey = 'tb_archivo_id';
    public $timestamps = false;
    
    
    
}
