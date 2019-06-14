<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalIncome extends Model
{
    //

    
    /*
    Version vieja
    public function citaIngresoMedico(){
        return $this->belongsTo(CitaMedicalVisit::class,'id');
    }*/
    public function episode(){
        return $this->belongsTo(Episode::class);
    }

    public function informeMedico(){
        return $this->belongsTo(MedicalReport::class,'medical_report_id');
    }

    public function prorrogas(){
        return $this->hasMany(Extension::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }


}
