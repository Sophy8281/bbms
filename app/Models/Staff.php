<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mail;

class Staff extends Authenticatable
{
    use Notifiable;
    protected $guard = 'staff';
    protected $table= 'staff';

    protected $fillable = [
        'bank_id','name', 'email', 'password',
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

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function blood()
    {
        return $this->hasMany(Blood::class);
    }

    public function issued_blood()
    {
        return $this->hasMany(IssuedBlood::class);
    }

     public function rbc()
    {
        return $this->hasMany(Rbc::class);
    }

    public function platelets()
    {
        return $this->hasMany(Platelet::class);
    }

    public function plasma()
    {
        return $this->hasMany(Plasma::class);
    }

    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }

    public function drives()
    {
        return $this->hasMany(Drive::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function requests()
    {
        return $this->hasMany(HospitalRequest::class);
    }

    // public static function generatePassword()
    // {
    //   // Generate random string and encrypt it.
    //   return bcrypt(str_random(35));
    // }

    // public static function sendWelcomeEmail($user)
    // {
    //   // Generate a new reset password token
    //   $token = app('auth.password.broker')->createToken($user);

    //   // Send email
    //   Mail::send('emails.welcome', ['user' => $user, 'token' => $token], function ($m) use ($user) {
    //     $m->from('hello@appsite.com', 'Your App Name');

    //     $m->to($user->email, $user->name)->subject('Welcome to APP');
    //   });
    // }
}
