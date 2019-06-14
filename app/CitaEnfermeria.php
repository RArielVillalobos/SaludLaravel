<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CitaEnfermeria extends Model
{
    //
    protected $table='citas_enfermeria';

    protected $fillable=[
        'episode_id','nurse_id','fecha','hora',
    ];
    //
    /*public function episode(){
        return $this->belongsTo(Episode::class);
    }*/

    public function nurseEvolution(){
        return $this->hasOne(NurseEvolution::class);
    }

    public function nurse(){
        return $this->belongsTo(Nurse::class);
    }

    public function cita(){
        return $this->belongsTo(Cita::class,'id');
    }

    public function nursing_diagram(){
        return $this->belongsTo(NursingDiagram::class,'nursing_diagram_id');
    }


}
