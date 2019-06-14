<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalDiagram extends Model
{
    //

    public function episode(){
        return $this->belongsTo(Episode::class);
    }

    public function citas_evolucion_medica(){
        return $this->hasMany(CitaEvolutionMedical::class);
    }

    public function medical_shift(){
        return $this->belongsTo(MedicalShift::class);
    }
}
