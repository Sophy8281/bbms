<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Password;

class StaffResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/staff';

    protected function guard()
    {
        return Auth::guard('staff');
    }

    protected function broker()
    {
        return Password::broker('staff');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.staff-reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
