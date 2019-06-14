<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indication extends Model
{
    //

    public function treatments(){
        return $this->hasMany(Treatment::class);
    }

    public function citaMedica(){
        return $this->belongsTo(CitaMedica::class);
    }

    public function medicalReport(){
        return $this->hasOne(MedicalReport::class);
    }

    public function medicalEvolution(){
        return $this->hasOne(Indication::class);
    }


}
