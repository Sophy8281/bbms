<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewStaffNotification;
use Illuminate\Support\Facades\Notification;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class StaffRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:staff');
    }

    public function showRegistrationForm()
    {
        return view('auth.staff_register');
    }

    // public function register(Request $request)
    // {
    //     // Validate form data
    //     $this->validate($request,
    //         [
    //             'name' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'email', 'max:255', 'unique:staff'],
    //             'password' => ['required', 'string', 'min:8']
    //         ]
    //     );

    //     // Create staff user
    //     try {
    //         $staff = Staff::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //         ]);

    //         // Log the staff in
    //         Auth::guard('staff')->loginUsingId($staff->id);
    //         return redirect()->route('staff.dashboard');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withInput($request->only('name', 'email'));
    //     }
    // }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:staff'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Staff
     */
    protected function register(Request $request)
    {

        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:staff'],
                'password' => ['required', 'string', 'min:8','confirmed']
            ]
        );

        $staff = Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'name' => $data['name'],
            // 'email' => $data['email'],
            // 'password' => Hash::make($data['password']),
        ]);

       // $administrators = DB::table('admins')->get();
        $administrators = Admin::all();

        foreach ($administrators as $administrator) {
            $administrator->notify(new NewStaffNotification($staff));
        }
        // $users->each->notify(new PrescriptionNotification($Prescription));

        // Notification::send($administrators, new PrescriptionNotification($staff));

        // if($administrators){
        //     $administrators->notify(new NewStaffNotification($staff));
        // }

        // return $staff ;
        // return redirect()->route('assigned');
        return view('staff.assigned');
    }
}
