<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    //
    const ACTIVO=1;
    const PROVISORIO=2;
    const ESPERA=3;
    const ALTA=3;
    const RECHAZADO=4;
    protected $fillable=[
        'patient_id','doctor_id','estado','fecha_ingreso_provisorio','fecha_ingreso_medico',
        'fecha_activacion','diagnostico_principal'
    ];



    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function patient(){
        return $this->belongsTo(Patients::class,'patient_id');
    }
    public function state(){
        return $this->belongsTo(EpisodeState::class);
    }

    public function medicalProvisions(){
        return $this->hasMany(MedicalProvisions::class);
    }


    public function citasMedicas(){
        return $this->hasMany(CitaMedica::class);
    }

    /*public function medicalVisits(){
        return $this->hasMany(CitaMedicalVisit::class);
    }*/

    public function citasEnfermeria(){
        return $this->hasMany(CitaEnfermeria::class);
    }

    public function observations(){
        return $this->hasMany(Observation::class);
    }
    public function recipes(){
        return $this->hasMany(Recipe::class,'episode_id');
    }
    public function nursingEvolutions(){
        return $this->hasMany(NurseEvolution::class);

    }

    public function citas(){
        return $this->hasMany(Cita::class);
    }

    public function nursing_diagrams(){
        return $this->hasMany(NursingDiagram::class);
    }

    public function kinesiology_diagrams(){
        return $this->hasMany(KinesiologyDiagram::class);
    }

    public function psycho_social_income(){
        return $this->hasOne(PsychoSocialIncome::class,'episode_id');

    }

    public function social_assistant_diagrams(){
        return $this->hasMany(SocialAssistantDiagram::class);
    }

    public function  socialWork(){
        return $this->belongsTo(SocialWork::class);
    }

    public function no_ingreso(){
        return $this->hasOne(NoIncome::class);
    }

    public function epicrisis(){
        return $this->hasOne(Epicrisis::class);



    }
    public function medicalIncome(){
        return $this->hasOne(MedicalIncome::class);
    }




    public function diasProvisorio(){
        $fechaIngreso=$this->fecha_ingreso_provisorio;

        $fechaActual=Carbon::now();

        $diferencia= $fechaActual->diffInDays($fechaIngreso);

        if($diferencia==0){
            $diferencia='Ingreso hoy';
        }




        return $diferencia;



    }


}
