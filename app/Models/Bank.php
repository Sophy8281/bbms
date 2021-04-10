<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

   // protected $guard = 'admin';
    protected $table = 'banks';
    //protected $primaryKey ="id";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'county',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function agitators()
    {
        return $this->hasMany(Donation::class);
    }

    public function freezers()
    {
        return $this->hasMany(Donation::class);
    }

    public function refrigerators()
    {
        return $this->hasMany(Donation::class);
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

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function drives()
    {
        return $this->hasMany(Drive::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class);
    }
}