<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedRbc extends Model
{
    use HasFactory;

    protected $table="issued_rbcs";

    protected $fillable = [
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