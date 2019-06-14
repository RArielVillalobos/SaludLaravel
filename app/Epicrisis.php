<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epicrisis extends Model
{
    //


    public function episode(){
        return $this->belongsTo(Episode::class);
    }

    //doctor que realiza la epicrisis
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function altaMedica(){
        return $this->hasOne(HighMedical::class);
    }
}
