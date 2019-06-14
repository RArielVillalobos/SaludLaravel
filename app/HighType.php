<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HighType extends Model
{
    //
    protected  $table='high_types';

    public function altas(){
        return $this->hasMany(HighMedical::class);
    }
}
