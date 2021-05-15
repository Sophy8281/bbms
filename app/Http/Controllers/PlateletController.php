<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Agitator;
use App\Models\IssuedPlatelet;
use App\Models\DiscardedPlatelet;
use App\Models\HospitalRequest;
use App\Models\Hospital;
use App\Models\Platelet;
use App\Models\Group;
use App\Models\Staff;
use App\Models\Bank;
use Carbon\Carbon;

class PlateletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
        $this->middleware('assigned')->except('assigned');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $bank_id=Auth::user()->bank_id;
        $agitator = Agitator::findOrFail($id);
        $platelets = Platelet::get()->where('bank_id',$bank_id)
            ->where('agitator_id',$id)
            ->whereNull('issued_at')
            ->whereNull('discarded_at');
        return view('staff.platelets.index', compact('agitator','platelets'));

        // $bank_id=Auth::user()->bank_id;
        // $platelets = Platelet::get()->where('bank_id',$bank_id);

        // $donation_date = Carbon::createFromFormat('Y-m-d','donation_date');
        // $expiry_date = Carbon::createFromFormat('Y-m-d','expiry_date');

        // $today = Carbon::today();
        // $expiry_date = $platelets->expiry_date;
        // $difference = $expiry_date->diffInDays($donation_date);
        // dd($difference);
        // return view('staff.platelets.index', compact('platelets'));
    }

    //test for show what in in agitator
    // public function show_stock($id)
    // {
    //     $bank_id=Auth::user()->bank_id;
    //     $agitator = Agitator::findOrFail($id);
    //     $platelets = Platelet::get()->where('bank_id',$bank_id)->where('agitator_id',$id);
    //     // dd($platelets);
    //     return view('staff.platelets.test', compact('agitator','platelets'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank_id=Auth::user()->bank_id;
        // $platelets = Platelet::get()->where('bank_id',$bank_id);
        $agitators = Agitator::get()->where('bank_id',$bank_id);
        // $agitators = Agitator::all();
        $blood_groups = Group::all();
        return view('staff.platelets.create', compact('agitators','blood_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'bag_serial_number' => ['required', 'unique:platelets'],
            'donation_date' => ['required', 'before_or_equal:today','after:1900-01-01'],
        ]);
        $data = new Platelet();
        $data->bank_id=Auth::user()->bank_id;
        $data->staff_id=Auth::user()->id;
        $data['agitator_id']=$request->agitator_id;
        $data['bag_serial_number']=$request->bag_serial_number;
        $data['group_id']=$request->group_id;
        $data['donation_date']=$request->donation_date;
        $donation_date =$data['donation_date'];
        $carbonone = new Carbon($donation_date);
        $carbontwo = $carbonone->copy()->addDays(5);
        $data->expiry_date=$carbontwo;

        // dd($data);
        $data->save();
        return Redirect::to('staff/all-agitators')
            ->with('success', 'Platelets Bag Stored successfully!');
    }

    public function issue($id)
    {
        $platelet = Platelet::findOrFail($id);
        $group_id = $platelet->group_id;
        $product = 'platelets';
        $hospitals = HospitalRequest::where('group_id', $group_id)->where('product', $product)
            ->where('remaining', '>', 0)->whereNull('satisfied_at')->get()->unique('hospital_id');

        return view('staff.platelets.issue', compact('hospitals','platelet'));
    }

    public function store_issued(Request $request, $id)
    {
        $issued_at = Carbon::today();
        $platelet = Platelet::findOrFail($id);

        //now save the data in the variables;
        $platelet_id = $platelet->id;
        $agitator_id = $platelet->agitator_id;
        $bag_serial_number = $platelet->bag_serial_number;
        $group_id = $platelet->group_id;
        $donation_date = $platelet->donation_date;
        $expiry_date = $platelet->expiry_date;

        //validate input to issued platelet
        $request->validate([
            'bag_serial_number' => ['unique:issued_platelets'],
            'hospital_id' => ['required'],
        ]);
        //new record to issued platelet
        $issued_platelet = new IssuedPlatelet();
        $issued_platelet->platelet_id = $platelet_id;//from platelet

        $issued_platelet->bank_id=Auth::user()->bank_id;//in session
        $issued_platelet->staff_id=Auth::user()->id;//in session

        $issued_platelet->agitator_id = $agitator_id;//from platelet
        $issued_platelet->bag_serial_number = $bag_serial_number;//from platelet
        $issued_platelet->group_id = $group_id;//from platelet
        $issued_platelet->donation_date = $donation_date;//from platelet
        $issued_platelet->expiry_date = $expiry_date;//from platelet
        $issued_platelet['hospital_id']=$request->hospital_id;//from form
        $issued_platelet['issued_at']=$issued_at;//carbon

        // dd($issued_platelet);
        $issued_platelet->save();
        // $platelet->delete();

        //validate input to platelet
        $input_to_update_platelet = [
            'issued_at' => $issued_at,
        ];

        //variables for updating request
        $satisfied_at = Carbon::today();
        $group_id = $platelet->group_id;
        $product = 'platelets';
        $hospital_request = HospitalRequest::where('hospital_id', $issued_platelet['hospital_id'])
            ->where('group_id', $group_id)->where('product', $product)
            ->where('remaining', '>', 0)->whereNull('satisfied_at')->first();

        $hospital_request_id =  $hospital_request->id;
        $hospital_request_remaining =  $hospital_request->remaining;
        $new_remaining = $hospital_request_remaining -1;

        // dd($hospital_request);
        // dd($hospital_request_id);
        // dd($hospital_request_remaining);
        // dd($new_remaining);

        //check if new remaining will be greater than 0
        if($new_remaining > 0)
        {
            $input_to_update_request = [
                'remaining' => $new_remaining,
            ];
            HospitalRequest::where('id', $hospital_request_id)
            ->update($input_to_update_request);
        }else{
            $input_to_update_request = [
                'remaining' => $new_remaining,
                'satisfied_at' => $satisfied_at,
            ];
            HospitalRequest::where('id', $hospital_request_id)
            ->update($input_to_update_request);
        }

        // dd($input_to_update_request);

        Platelet::where('id', $id)
            ->update($input_to_update_platelet);

        //then return to your view or whatever you want to do
        return redirect('staff/all-agitators')
            ->with('success', 'Platelet Bag issued successfully!');
    }

    public function issued_platelets()
    {
        $bank_id=Auth::user()->bank_id;
        $platelets = IssuedPlatelet::get()->where('bank_id',$bank_id);
        return view('staff.platelets.issued', compact('platelets'));
    }

    // public function issue($id)
    // {
    //     $platelet = Platelet::findOrFail($id);
    //     $hospitals = Hospital::all();
    //     return view('staff.rbc.issue', compact('hospitals','platelet'));
    // }

    // public function store_issued(Request $request, $id)
    // {
    //     $issued_at = Carbon::now();
    //     $platelet = Platelet::findOrFail($id);
    //      $constraints = [
    //         'hospital_id' => 'required|unique:hospitals',
    //      ];
    //     $input = [
    //         'hospital_id' => $request['issued_to'],
    //         'issued_at' => $issued_at,
    //     ];
    //     // dd($input);
    //     $this->validate($request, $constraints);
    //     Platelet::where('id', $id)
    //         ->update($input);

    //     return redirect('staff/all-agitators/')
    //         ->with('success', 'Platelet Bag issued successfully');
    // }


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

     public function discard($id)
    {
        $discarded_at = Carbon::today();
        $platelet = Platelet::findOrFail($id);

        //save the data in the variables;
        $platelet_id = $platelet->id;
        $agitator_id = $platelet->agitator_id;
        $bag_serial_number = $platelet->bag_serial_number;
        $group_id = $platelet->group_id;
        $donation_date = $platelet->donation_date;
        $expiry_date = $platelet->expiry_date;


        $discarded_platelet = new DiscardedPlatelet();
        $discarded_platelet->platelet_id = $platelet_id;//from platelet

        $discarded_platelet->bank_id=Auth::user()->bank_id;//in session
        $discarded_platelet->staff_id=Auth::user()->id;//in session

        $discarded_platelet->agitator_id = $agitator_id;//from platelet
        $discarded_platelet->bag_serial_number = $bag_serial_number;//from platelet
        $discarded_platelet->group_id = $group_id;//from platelet
        $discarded_platelet->donation_date = $donation_date;//from platelet
        $discarded_platelet->expiry_date = $expiry_date;//from platelet

        $discarded_platelet['discarded_at']=$discarded_at;//carbon

        // dd($discarded_platelet);
        $discarded_platelet->save();
        // $platelet->delete();

        $input = [
            'discarded_at' => $discarded_at,
        ];

        // dd($input);
        Platelet::where('id', $id)
            ->update($input);

        //then return to your view or whatever you want to do
        return redirect('staff/all-agitators')
            ->with('success', 'Platelet Bag issued successfully!');
    }

    public function discarded_platelets()
    {
        $bank_id=Auth::user()->bank_id;
        $platelets = DiscardedPlatelet::get()->where('bank_id',$bank_id);

        return view('staff.platelets.discarded', compact('platelets'));
    }

}
