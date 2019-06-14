<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //
    public function recipes(){
        return $this->belongsToMany('\App\Recipe','medicine_recipe')->withPivot('dosis','via','int','observaciones','entregado');
    }
}
