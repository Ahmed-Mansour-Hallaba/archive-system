<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $table = "admins";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'level', 'user_type', 'master_name', 'branch_name', 'department_name', 'user_id', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUnit()
    {
        if($this->user_type==0)
            return $this->belongsTo('App\Master','user_id');
        else if($this->user_type==2)
            return $this->belongsTo('App\Department','user_id');
        else if($this->user_type==1)
        return $this->belongsTo('App\Branch','user_id');
    }
}

