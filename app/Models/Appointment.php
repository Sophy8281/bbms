<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table="appointments";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'bank_id',
        'group_id',
    ];

    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }

    public function group()
    {
       return $this->belongsTo(Group::class);
    }
    public function staff()
    {
       return $this->belongsTo(Staff::class);
    }
}
