<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HighMedical extends Model
{
    //
    protected $table='high_medicals';


    public function epicrisis(){
        return $this->belongsTo(Epicrisis::class);
    }

    public function tipo_alta(){
        return $this->belongsTo(HighType::class,'high_type_id');
    }
}
