<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsychologyShift extends Model
{
    //

    public function psychology_diagrams(){
        return $this->hasMany(PsychologyDiagram::class);
    }
}
