<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DonorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth','verified');
        $this->middleware('auth');
    }

    public function edit_profile($id)
     {
        //  $blood_groups = Group::all();
         $user = User::findOrFail($id);
         return view('home', compact('user'));
     }

    public function update_profile(Request $request, $id)
     {
         $user = User::findOrFail($id);
         $constraints = [
             'name' => 'required|max:255',
             'phone' => 'required|max:255',
            // 'blood_group'=> 'required|max:255',
             'county'=> 'required|max:255',

         ];
        $input = [
            'name' => $request['name'],
            'phone' => $request['phone'],
           // 'blood_group' => $request['blood_group'],
            'county' => $request['county'],

        ];
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);

         return redirect('/home')->with('success','Profile Updated Successfully!');
     }
}