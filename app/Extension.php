<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    //

    protected $table='extensions';

    public function medicalIncome(){
        return $this->belongsTo(MedicalIncome::class);
    }

    public function medicalReport(){
        return $this->belongsTo(MedicalReport::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
