<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'county',
    ];

    public function rbc()
    {
        return $this->hasMany(Rbc::class);
    }

    public function plasma()
    {
        return $this->hasMany(Plasma::class);
    }

    public function platelets()
    {
        return $this->hasMany(Platelet::class);
    }

    public function blood()
    {
        return $this->hasMany(Blood::class);
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
