<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedPlatelet extends Model
{
    use HasFactory;

    protected $table="issued_platelets";

    protected $fillable = [
        'hospital_id',
    ];

    public function agitator()
    {
       return $this->belongsTo(Agitator::class);
    }

    public function staff()
    {
       return $this->belongsTo(Staff::class);
    }

    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }

    public function group()
    {
       return $this->belongsTo(Group::class);
    }

    public function hospital()
    {
       return $this->belongsTo(Hospital::class);
    }
}