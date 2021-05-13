<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'product',
        'group_id',
        'quantity',
    ];

    public function hospital()
    {
       return $this->belongsTo(Hospital::class);
    }

    public function group()
    {
       return $this->belongsTo(Group::class);
    }

    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }

    public function staff()
    {
       return $this->belongsTo(Staff::class);
    }
}
