<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refrigerator extends Model
{
    use HasFactory;

    protected $table="refrigerators";

    protected $fillable = [
        'blood_group',
        'name',
        'capacity',
    ];


    public function rbc()
    {
        return $this->hasMany(Rbc::class);
    }

    public function issuedrbc()
    {
        return $this->hasMany(IssuedRbc::class);
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