<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PsycologyProvision extends Model
{
    //
    protected $fillable=['semana'];

    public function provision(){
        return $this->hasOne(Provisions::class);
    }
}
