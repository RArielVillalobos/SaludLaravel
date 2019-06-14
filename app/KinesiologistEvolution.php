<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KinesiologistEvolution extends Model
{
    //

    protected $table='kinesiologist_evolutions';

    public function cita_kinesiologia(){
        return $this->belongsTo(CitasKinesiologia::class,'cita_kinesiologia_id');
    }

    public function episode(){
        return $this->belongsTo(Episode::class);
    }


}
