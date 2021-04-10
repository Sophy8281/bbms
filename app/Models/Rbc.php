<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rbc extends Model
{
    use HasFactory;

    protected $table="red_blood_cells";

    protected $fillable = [
        'refrigerator_id',
        'bag_serial_number',
        'group_id',
        'donation_date',
        'hospital_id',
    ];

    public function refrigerator()
    {
       return $this->belongsTo(Refrigerator::class);
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
