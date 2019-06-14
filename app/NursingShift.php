<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NursingShift extends Model
{
    //
    public function nursing_diagrams(){
        return $this->hasMany(NursingDiagram::class);
    }
}
