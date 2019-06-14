<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NursingProvisions extends Model
{
    //
    protected $fillable=['dia'];

    public function provision(){
        return $this->hasOne(Provisions::class);
    }


}
