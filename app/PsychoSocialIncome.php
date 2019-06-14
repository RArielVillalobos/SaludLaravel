<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsychoSocialIncome extends Model
{
    //

    protected $table='psycho_social_incomes';

    public function episode(){
        return $this->belongsTo(Episode::class,'episode_id');
    }

    public function social_assistant(){
        return $this->belongsTo(SocialAssistant::class);
    }

    public function social_context(){
        return $this->hasOne(SocialContext::class);
    }
}
