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

    protected $fillable = [
        'donor_id',
        'bag_serial_number',
        'group_id',
        'status',
        'plasma_bag_no',
        'platelet_bag_no',
        'rbc_bag_no',
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
