<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Bank;
use App\Models\Appointment;
use App\Models\Group;
use App\Models\Drive;
use Carbon\Carbon;

class SiteController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth','verified');
        // $this->middleware('auth')->except('create_appointment','store_appointment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::today();
        $banks = Bank::all();
        $blood_groups = Group::all();
        $drives = Drive::whereNotNull('approved_at')->where('date','>',$today )->get();
        return view('site', compact('banks','blood_groups','drives'));
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
        return view('donor.appoinment', compact('banks','blood_groups'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required'],
            'date' => ['required','after_or_equal:today'],
            'bank_id' => ['required'],
            'group_id' => ['required', 'string', 'max:255'],
        ]);

        $data = new Appointment();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['date']=$request->date;
        $data['bank_id']=$request->bank_id;
        $data['group_id']=$request->group_id;

        // dd($data);
        $data->save();
        return redirect('appointment/')->with('success',' Appointment Sent Successfully!');
        // return redirect('appointment/')->withMessage(' Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}