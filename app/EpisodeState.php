<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpisodeState extends Model
{
    //
    protected $table='episode_states';

    public function episodes(){
        return $this->hasMany(Episode::class);
    }
}
