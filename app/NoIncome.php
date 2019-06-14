<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoIncome extends Model
{
    //
    public function episode(){
        return $this->belongsTo(Episode::class);
    }
}
