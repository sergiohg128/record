<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TramiteSelgestiun extends Model
{
    protected $connection = 'selgestiun';
    
    protected $table = 'tb_tramite';
    protected $primaryKey = 'tb_tramite_id';
    public $timestamps = false;
    
    
    
}
