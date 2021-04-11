<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'bag_serial_number',
        'group_id',
        'donation_date',
    ];

    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }

    public function staff()
    {
       return $this->belongsTo(Staff::class);
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