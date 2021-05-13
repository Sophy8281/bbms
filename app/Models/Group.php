<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    // protected $guard = 'admin';
    protected $table = 'groups';
    //protected $primaryKey ="id";

    protected $fillable = [
        'name',
    ];

    public function donor()
    {
        return $this->hasMany(User::class);
    }

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

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class);
    }

    public function requests()
    {
        return $this->hasMany(HospitalRequest::class);
    }
}
