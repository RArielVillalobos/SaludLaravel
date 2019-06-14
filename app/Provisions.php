<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provisions extends Model
{
    //
    protected $table='provisions';

    public function medical_provision(){
        return $this->belongsTo(MedicalProvisions::class);
    }

    public function nursing_provision(){
        return $this->belongsTo(NursingProvisions::class);
    }
    public function kinesiology_provision(){
        return $this->belongsTo(KinesiologyProvisions::class);
    }

    public function psycology_provision(){
        return $this->belongsTo(PsycologyProvision::class);
    }

    public function medicalReport(){
        return $this->hasOne(MedicalReport::class);
    }
}
