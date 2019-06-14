<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalEvolution extends Model
{
    //

    protected $table='medical_evolutions';



    protected $fillable=[
        'cita_id','fecha','hora','ta','fr','fc','temp','hgt','spo','diuresis',
        'catarsis','evolucion'
    ];
    public function citaMedicalEvolution(){
        return $this->belongsTo(CitaEvolutionMedical::class,'cita_evolution_medical_id');
    }

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }

    public function indication(){
        return $this->belongsTo(Indication::class);
    }

    public function episode(){
        return $this->belongsTo(Episode::class);
    }
}
