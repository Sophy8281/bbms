<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freezer extends Model
{
    use HasFactory;

    protected $table="freezers";

    protected $fillable = [
        'bank_id',
        'name',
        'capacity',
    ];

    public function plasma()
    {
        return $this->hasMany(Plasma::class);
    }

    public function issued_plasma()
    {
        return $this->hasMany(IssuedPlasma::class);
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class);
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
