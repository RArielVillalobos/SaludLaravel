<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitaPsicologia extends Model
{
    //
    protected $table='citas_psicologia';

    public function cita(){
        return $this->belongsTo(Cita::class,'id');
    }

    public function psychologistEvolution(){
        return $this->hasOne(PsychologistEvolution::class,'cita_psicologia_id');
    }

    public function psychologist(){
        return $this->belongsTo(Psychologist::class);
    }
    public function PsychologyDiagram(){
        return $this->belongsTo(PsychologyDiagram::class);
    }
}
