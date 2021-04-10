<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platelet extends Model
{
    use HasFactory;

    protected $table="platelets";

    protected $fillable = [
        'agitator_id',
        'bag_serial_number',
        'group_id',
        'donation_date',
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
