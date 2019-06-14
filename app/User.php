<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','last_name','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);

    }
    public static function navigation(){
        return auth()->check() ? auth()->user()->role->name : 'guest';
    }

    public function doctor(){
        return $this->hasOne(Doctor::class);
    }

    public function nurse(){
        return $this->hasOne(Nurse::class);
    }
    public function kinesiologist(){
        return $this->hasOne(Kinesiologist::class);
    }
    public function psychologist(){
        return $this->hasOne(Psychologist::class);
    }

    public function socialAssistant(){
        return $this->hasOne(SocialAssistant::class);
    }

}
