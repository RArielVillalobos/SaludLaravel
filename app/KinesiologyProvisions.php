<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KinesiologyProvisions extends Model
{
    //
    protected $fillable=['semana'];

    public function provision(){
        return $this->hasOne(Provisions::class);
    }
}
