<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    //
    protected $fillable=[
        'nombres','apellido','dni','familiar_responsable','numero_tel_familiar','obra_social',
        'numero_afiliado_obra','sexo','estado_civil','ocupacion','viv_adecuada','cumple_reque_int',
        'grado_inf_enf_pac','grado_inf_enf_fam','telefono','direccion','localidad','fecha_nacimiento','edad'
    ];

    public function episodes(){
        return $this->hasMany(Episode::class,'patient_id');
    }


}
