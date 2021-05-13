<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agitator extends Model
{
    use HasFactory;

    protected $table="agitators";

    protected $fillable = [
        'bank_id',
        'name',
        'capacity',
    ];

    public function platelets()
    {
        return $this->hasMany(Platelet::class);
    }

    public function issued_platelets()
    {
        return $this->hasMany(IssuedPlatelet::class);
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class);
    }

    public function staff()
    {
       return $this->belongsTo(Staff::class);
    }

    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }
}
