<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAssistantEvolution extends Model
{
    //

    public function cita_asis_social(){
        return $this->belongsTo(CitasAsistenteSocial::class,'cita_asis_social_id');
    }

    public function episode(){
        return $this->belongsTo(Episode::class);
    }
}
