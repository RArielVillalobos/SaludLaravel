<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Provisions;


class MedicalReport extends Model
{
    //


    public function medicalIncome(){
        return $this->hasOne(MedicalIncome::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }


    public function provision(){
        return $this->belongsTo(Provisions::class);
    }

    public function socialContext(){
        return $this->hasOne(SocialContext::class);
    }

    public function indication(){
        return $this->belongsTo(Indication::class);
    }

    public function episode(){
        return $this->belongsTo(Episode::class);
    }


}
