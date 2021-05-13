<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscardedBlood extends Model
{
    use HasFactory;

    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }

    public function staff()
    {
       return $this->belongsTo(Staff::class);
    }

    public function group()
    {
       return $this->belongsTo(Group::class);
    }
}
