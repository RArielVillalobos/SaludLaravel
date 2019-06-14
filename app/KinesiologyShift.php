<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KinesiologyShift extends Model
{
    //
    public function kinesiology_diagrams(){
        return $this->hasMany(KinesiologyDiagram::class);
    }
}
