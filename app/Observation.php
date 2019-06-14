<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    //

    public function episode(){
        return $this->belongsTo(Episode::class);
    }
}
