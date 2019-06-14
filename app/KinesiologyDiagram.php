<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KinesiologyDiagram extends Model
{
    //
    public function episode(){
        return $this->belongsTo(Episode::class);
    }

    public function citas_kinesiologia(){
        return $this->hasMany(CitasKinesiologia::class);
    }

    public function kinesiology_shift(){
        return $this->belongsTo(KinesiologyShift::class);
    }
}
