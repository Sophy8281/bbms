<?php

namespace App\Models;


use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    protected $table = 'admins';
    //protected $primaryKey ="id";

    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function banks()
    {
        return $this->hasMany(Bank::class);
    }

    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function drives()
    {
        return $this->hasMany(Drive::class);
    }

    public function agitators()
    {
        return $this->hasMany(Agitator::class);
    }

    public function freezers()
    {
        return $this->hasMany(Freezer::class);
    }

    public function refrigerators()
    {
        return $this->hasMany(Refrigerator::class);
    }


}
