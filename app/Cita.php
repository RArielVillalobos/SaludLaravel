<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table='citas';

    protected $fillable=[
        'episode_id','doctor_id','fecha','hora',
    ];
    //
    public function episode(){
        return $this->belongsTo(Episode::class);
    }

    /*public function medicalEvolution(){
        return $this->hasOne(MedicalEvolution::class);
    }*/

    /*public function doctor(){
        return $this->belongsTo(Doctor::class);
    }*/

    /*public function user(){
        return $this->belongsTo(User::class);
    }*/

    public function citas_enfermeria(){
        return $this->hasMany(CitaEnfermeria::class,'id');
    }

    public function cita_visita_medicas(){
        return $this->hasMany(CitaMedicalVisit::class,'id');
    }

    public function citas_kinesiologias(){
        return $this->hasMany(CitasKinesiologia::class);
    }
    public function citas_psicologia(){
        return $this->hasMany(CitaPsicologia::class);
    }
}
