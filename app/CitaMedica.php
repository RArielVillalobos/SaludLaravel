<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitaMedica extends Model
{
    //
    protected $table='cita_medicas';
    protected $primaryKey='id';

    public function episode(){
        return $this->belongsTo(Episode::class,'episode_id');
    }
    public function citaIngresoMedico(){
        return $this->hasOne(CitaMedicalVisit::class,'id');

    }

    //en la nueva version esto ya no va
    /*public function citasEvolutionMedical(){
        return $this->hasMany(CitaEvolutionMedical::class,'id');
    }

    public function citasMedicalVisit(){
        return $this->hasOne(CitaMedicalVisit::class,'id');
    }

    public function recipe(){
        return $this->hasOne('\App\Recipe');
    }

    public function indication(){
        return $this->hasOne(Indication::class);
    } hasta aca*/




}
