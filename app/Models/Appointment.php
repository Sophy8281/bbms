<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use HasFactory, Notifiable;

    protected $table="appointments";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'bank_id',
        'blood_group',
    ];

    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }

    public function staff()
    {
       return $this->belongsTo(Staff::class);
    }
}
