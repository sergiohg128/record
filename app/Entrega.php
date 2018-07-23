<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    
    protected $table = 'entrega';
    protected $primaryKey = 'id';
    public $timestamps = false;
    


    public function proyecto() {
        return Proyecto::find($this->id_proyecto);
    }

}
