<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class NurseEvolution extends Model
{
    //
    protected $table='nurse_evolutions';



    protected $fillable=[
        'citas_enfermeria_id','fecha','hora','ta','fr','fc','temp','hgt','spo','diuresis',
        'catarsis','evolucion'
    ];
    public function cita_enfermeria(){
        return $this->belongsTo(CitaEnfermeria::class);
    }

    public function episode(){
        return $this->belongsTo(Episode::class);
    }
}
