<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    //

    public function indication(){
        return $this->belongsTo(Indication::class);
    }
}
