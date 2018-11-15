<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaseSelgestiun extends Model
{
    protected $connection = 'selgestiun';
    
    protected $table = 'tb_fase';
    protected $primaryKey = 'tb_fase_id';
    public $timestamps = false;
    
    
    
}
