<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Donation;
use App\Models\Group;
use App\Models\Bank;
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
        $this->middleware('auth');
        // $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $donations = Donation::where('donor_id',$id)->whereNotNull('status')->get();
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
            // 'gender' => 'required|max:255',
            'unique_no' => 'required|max:255',
            // 'birth_date' => 'required|before:today|max:255',
            'phone' => 'required|max:255',
            'address' => 'max:255',
            'county'=> 'required|max:255',

        ];
        $input = [
            'name' => $request['name'],
            'gender' => $request['gender'],
            'unique_no' => $request['unique_no'],
            'birth_date' => $request['birth_date'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'county' => $request['county'],

        ];
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);

         return redirect('/home')->with('success','Profile Updated Successfully!');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_appointment()
    {
        $banks = Bank::all();
        $blood_groups = Group::all();
        return view('donor.donor_appointment', compact('banks','blood_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_appointment(Request $request)
    {
        $request->validate([
            'date' => ['required','after_or_equal:today'],
            'bank_id' => ['required'],
        ]);

        $data = new Appointment();
        $data->user_id=Auth::user()->id;
        $data->name=Auth::user()->name;
        $data->email=Auth::user()->email;
        $data->phone=Auth::user()->phone;
        $data['date']=$request->date;
        $data['bank_id']=$request->bank_id;
        $data->blood_group=Auth::user()->blood_group;

        // dd($data);
        $data->save();
        return redirect('home/appointment/')
            ->with('success',' Appointment Request Sent Successfully! We will get to you soon.');
    }
}
