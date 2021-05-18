<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Bank;
use App\Models\Appointment;
use App\Models\HostDrive;
use App\Models\Group;
use App\Models\Drive;
use App\Models\About;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Faq;

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
        $donors = User::all();
        $blood_groups = Group::all();
        $faqs = Faq::where('status','=','1')->get();
        $about = About::find(1);
        $drives = Drive::whereNotNull('approved_at')->where('date','>',$today )->get();
        return view('site', compact('banks','donors','blood_groups','faqs','about','drives'));
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
            // 'group_id' => ['required', 'string', 'max:255'],
        ]);

        $data = new Appointment();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['date']=$request->date;
        $data['bank_id']=$request->bank_id;
        $data['blood_group']=$request->group_id;

        // dd($data);
        $data->save();
        return redirect('appointment/')
            ->with('success',' Appointment Request Sent Successfully! We will get to you soon.');
        // return redirect('appointment/')->withMessage(' Created Successfully!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_drive()
    {
        $banks = Bank::all();
        return view('donor.host_drive', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_drive(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'population' => ['required', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required','string',],
            'location' => ['required', 'string', 'max:255'],
            'date' => ['required','after:today'],
            'bank_id' => ['required'],
            // 'comment' => ['text'],
        ]);

        $data = new HostDrive();
        $data['name']=$request->name;
        $data['organization']=$request->organization;
        $data['population']=$request->population;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['location']=$request->location;
        $data['date']=$request->date;
        $data['bank_id']=$request->bank_id;
        $data['comment']=$request->comment;

        // dd($data);
        $data->save();
        return redirect('host/')->with('success',' Request Sent Successfully! We will get to you soon.');
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
