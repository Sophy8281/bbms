<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="donations";
    //protected $primaryKey ="donation_id";

    protected $fillable = [

       // 'donation_id',
        'donor_id',
        'bag_serial_number',
        'blood_group',
        'status',
    ];

    public function donor()
    {
       return $this->belongsTo(User::class);
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

}