<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialContext extends Model
{
    //

   /* public function medicalReport(){
        return $this->belongsTo(MedicalReport::class);
    }*/

   public function psychosocial_income(){
       return $this->belongsTo(PsychoSocialIncome::class);
   }
}
