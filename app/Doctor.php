<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function episode()
    {
        return $this->hasMany(Episode::class);
    }

    public function recipes(){
        return $this->hasMany('\App\Recipe');
    }

    public function Extensions(){
        return $this->hasMany(Extension::class);
    }

    public function epicrises(){
        return $this->hasMany(Epicrisis::class);
    }

    public function medicalIncomes(){
        return $this->hasMany(MedicalIncome::class);
    }

}
