<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitasAsistenteSocial extends Model
{
    //
    protected $table='citas_asistente_socials';

    public function cita(){
        return $this->belongsTo(Cita::class,'id');
    }

    public function asisSocialEvolution(){
        return $this->hasOne(SocialAssistantEvolution::class,'cita_asis_social_id');
    }

    public function asis_social(){
        return $this->belongsTo(SocialAssistant::class,'social_assistant_id');
    }
    public function SocialAssistantDiagram(){
        return $this->belongsTo(SocialAssistantDiagram::class);
    }
}
