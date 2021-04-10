<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drive extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'location',
        'date',
        'time',
    ];

    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }

    public function staff()
    {
       return $this->belongsTo(Staff::class);
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class);
    }

}