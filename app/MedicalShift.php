<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalShift extends Model
{
    //
    public function medical_diagrams(){
        return $this->hasMany(MedicalDiagram::class);
    }
}
