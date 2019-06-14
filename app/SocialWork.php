<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialWork extends Model
{
    //

    public function episodes(){
        return $this->hasMany(Episode::class);
    }
}
