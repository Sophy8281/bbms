<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nexmo\Laravel\Facade\Nexmo;

class SendSms extends Model
{
    public static function sendsms($phone)
    {
        Nexmo::message()->send([
            'to' => '+254'.(int) $phone,
            'from' => '+254737094371',
            'text' => 'Thank you for your blood donation. It means a lot to us and people in need of blood.',
        ]);
    }

}