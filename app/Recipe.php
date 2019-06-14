<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //

    public function medicalReport(){
        return $this->hasOne(MedicalReport::class);
    }
    public function medicines(){
        return $this->belongsToMany('\App\Medicine','medicine_recipe')->withPivot('dosis','via','int','observaciones','entregado');
    }

    public function medicalEvolution(){
        return $this->hasOne(MedicalEvolution::class);
    }

    public function episode(){
        return $this->belongsTo(Episode::class,'episode_id');
    }




}
