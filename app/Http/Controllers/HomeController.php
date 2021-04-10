<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Group;
use App\Models\User;


class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$blood_groups = Group::all();
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $donations = Donation::where('donor_id',$id)->whereNotNull('status')->paginate(10);
        // return view('home', compact('donations','user'));
        return view('home', compact('user','donations'));
    }

    public function edit_profile($id)
    {
        //  $blood_groups = Group::all();
        $user = User::findOrFail($id);
        return view('donor.profile', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $constraints = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255',
            'unique_no' => 'required|max:255',
            'birth_date' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'max:255',
            // 'blood_group'=> 'required|max:255',
            'county'=> 'required|max:255',

        ];
        $input = [
            'name' => $request['name'],
            'gender' => $request['gender'],
            'unique_no' => $request['unique_no'],
            'birth_date' => $request['birth_date'],
            'phone' => $request['phone'],
            'address' => $request['address'],
           // 'blood_group' => $request['blood_group'],
            'county' => $request['county'],

        ];
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);

         return redirect('/home')->with('success','Profile Updated Successfully!');
    }
}