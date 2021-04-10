<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedPlasma extends Model
{
    use HasFactory;

    protected $table="issued_plasmas";

    protected $fillable = [
        'hospital_id',
    ];

    public function freezer()
    {
       return $this->belongsTo(Freezer::class);
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