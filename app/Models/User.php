<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
// use Carbon\Carbon;

// class User extends Authenticatable
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use Sortable;

    // protected $dates = ['birth_date'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'gender',
        'unique_no',
        'birth_date',
        'address',
        'phone',
        'group_id',
        'county',
        'password',
    ];

    public $sortable = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForNexmo($notification)
    {
        return $this->phone;
    }

    public function group()
    {
       return $this->belongsTo(Group::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // public function setBirthDateAttribute($value)
    // {
    //     $this->attributes['birth_date'] = \Carbon\Carbon::CreateFromFormat('m/d/Y', $value)->format('Y-m-d');
    //     // dd($value);
    // }

    // public function getBirthDateAttribute()
    // {
    //     return Carbon::createFromFormat('Y-m-d', $this->attributes['birth_date'])->format('m/d/Y');
    // }
}
