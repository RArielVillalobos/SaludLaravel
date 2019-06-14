<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAssistantDiagram extends Model
{
    //
    public function episode(){
        return $this->belongsTo(Episode::class);
    }

    public function citas_asist_social(){
        return $this->hasMany(CitasAsistenteSocial::class);
    }

    public function asis_social_shift(){
        return $this->belongsTo(SocialAssistantShift::class,'social_assistant_shift_id');
    }
}
