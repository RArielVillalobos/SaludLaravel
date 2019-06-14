<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitaEvolutionMedical extends Model
{
    //

    protected $table='cita_evolution_medicals';

    public function citaMedica(){
        return $this->belongsTo(CitaMedica::class,'id');
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function medicalEvolution(){
        return $this->hasOne(MedicalEvolution::class);
    }

    public function medicalDiagram(){
        return $this->belongsTo(MedicalDiagram::class);
    }
}
