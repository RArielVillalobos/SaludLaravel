<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsychologyDiagram extends Model
{
    //

    public function episode(){
        return $this->belongsTo(Episode::class);
    }

    public function citas_psicologia(){
        return $this->hasMany(CitaPsicologia::class);
    }

    public function psychology_shift(){
        return $this->belongsTo(PsychologyShift::class);
    }
}
