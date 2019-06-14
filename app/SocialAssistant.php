<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAssistant extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function psycho_social_incomes(){
        return $this->hasMany(PsychoSocialIncome::class);
    }

    public function citas_asis_social(){
        return $this->hasMany(CitasAsistenteSocial::class,'social_assistant_id');
    }
}
