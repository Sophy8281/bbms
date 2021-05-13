<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HostDrive extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'organization',
        'population',
        'email',
        'phone',
        'location',
        'date',
        'bank_id',
        'comment',
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
