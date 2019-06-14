<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitasKinesiologia extends Model
{
    //

    protected $table='citas_kinesiologias';


    public function cita(){
        return $this->belongsTo(Cita::class,'id');
    }

    public function kinesiologistEvolution(){
        return $this->hasOne(KinesiologistEvolution::class,'cita_kinesiologia_id');
    }

    public function kinesiologist(){
        return $this->belongsTo(Kinesiologist::class);
    }
    public function KinesiologyDiagram(){
        return $this->belongsTo(KinesiologyDiagram::class);
    }
}

