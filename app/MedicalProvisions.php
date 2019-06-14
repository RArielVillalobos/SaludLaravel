<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalProvisions extends Model
{
    //
    protected $fillable=['id','semana'];

    public function provision(){
        return $this->hasOne(Provisions::class);
    }



}
