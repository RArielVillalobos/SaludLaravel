<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAssistantShift extends Model
{
    //
    protected $table='social_assistant_shifts';

    public function social_assistant_diagrams(){
        return $this->hasMany(SocialAssistantDiagram::class,'social_assistant_shift_id');
    }

}
