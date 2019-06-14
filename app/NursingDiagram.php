<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NursingDiagram extends Model
{
    //
    protected $table='nursing_diagrams';

    public function episode(){
        return $this->belongsTo(Episode::class);
    }

    public function citas_enfermeria(){
        return $this->hasMany(CitaEnfermeria::class);
    }

    public function nursing_shift(){
        return $this->belongsTo(NursingShift::class);
    }
}
