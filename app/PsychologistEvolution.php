<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsychologistEvolution extends Model
{
    //
    public function cita_psicologia(){
        return $this->belongsTo(CitaPsicologia::class,'cita_psicologia_id');
    }

    public function episode(){
        return $this->belongsTo(Episode::class);
    }
}
