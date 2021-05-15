<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Refrigerator;
use Illuminate\Support\Facades\Redirect;
use App\Models\HospitalRequest;
use App\Models\Hospital;
use App\Models\Bank;
use App\Models\Group;
use App\Models\Staff;
use App\Models\IssuedRbc;
use App\Models\DiscardedRbc;
use App\Models\Rbc;
use Carbon\Carbon;

class RbcController extends Controller
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
        $refrigerator = Refrigerator::findOrFail($id);
        $rbcs = Rbc::get()->where('bank_id',$bank_id)
            ->where('refrigerator_id',$id)
            ->whereNull('issued_at')
            ->whereNull('discarded_at');
        return view('staff.rbc.index', compact('refrigerator','rbcs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank_id=Auth::user()->bank_id;
        // $freezers = Freezer::get()->where('bank_id',$bank_id);
        $refrigerators = Refrigerator::get()->where('bank_id',$bank_id);
        $blood_groups = Group::all();
        return view('staff.rbc.create', compact('refrigerators','blood_groups'));
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
            'bag_serial_number' => ['required', 'unique:red_blood_cells'],
            'donation_date' => ['required', 'before_or_equal:today','after:1900-01-01'],
        ]);
        $data = new Rbc();
        $data->bank_id=Auth::user()->bank_id;
        $data->staff_id=Auth::user()->id;
        $data['refrigerator_id']=$request->refrigerator_id;
        $data['bag_serial_number']=$request->bag_serial_number;
        $data['group_id']=$request->group_id;
        $data['donation_date']=$request->donation_date;

        $donation_date =$data['donation_date'];
        $carbonone = new Carbon($donation_date);
        $carbontwo = $carbonone->copy()->addDays(42);
        $data->expiry_date=$carbontwo;
        // dd($data);
        $data->save();
        return Redirect::to('staff/all-refrigerators/')
            ->with('success', 'Red Blood Cells Stored successfully!');
    }

    public function issue($id)
    {
        $rbc = Rbc::findOrFail($id);
        $group_id = $rbc->group_id;
        $product = 'red blood cells';
        $hospitals = HospitalRequest::where('group_id', $group_id)->where('product', $product)
            ->where('remaining', '>', 0)->whereNull('satisfied_at')->get()->unique('hospital_id');

        return view('staff.rbc.issue', compact('hospitals','rbc'));
    }

    public function store_issued(Request $request, $id)
    {
        $issued_at = Carbon::today();
        $rbc = Rbc::findOrFail($id);

        //now save the data in the variables;
        $rbc_id = $rbc->id;
        $refrigerator_id = $rbc->refrigerator_id;
        $bag_serial_number = $rbc->bag_serial_number;
        $group_id = $rbc->group_id;
        $donation_date = $rbc->donation_date;
        $expiry_date = $rbc->expiry_date;

        //validate input to issued rbc
        $request->validate([
            'bag_serial_number' => ['unique:issued_rbcs'],
            'hospital_id' => ['required'],
        ]);

        $issued_rbc = new IssuedRbc();
        $issued_rbc->rbc_id = $rbc_id;//from rbc

        $issued_rbc->bank_id=Auth::user()->bank_id;//in session
        $issued_rbc->staff_id=Auth::user()->id;//in session

        $issued_rbc->refrigerator_id = $refrigerator_id;//from rbc
        $issued_rbc->bag_serial_number = $bag_serial_number;//from rbc
        $issued_rbc->group_id = $group_id;//from rbc
        $issued_rbc->donation_date = $donation_date;//from rbc
        $issued_rbc->expiry_date = $expiry_date;//from rbc

        $issued_rbc['hospital_id']=$request->hospital_id;//from form

        $issued_rbc['issued_at']=$issued_at;//carbon
        $issued_rbc->save();
        // $rbc->delete();

        //validate input to rbc
        $input_to_update_rbc = [
            'issued_at' => $issued_at,
        ];

        //variables for updating request
        $satisfied_at = Carbon::today();
        $group_id = $rbc->group_id;
        $product = 'red blood cells';
        $hospital_request = HospitalRequest::where('hospital_id', $issued_rbc['hospital_id'])
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

        // dd($input);
        Rbc::where('id', $id)
            ->update($input_to_update_rbc);

        //then return to your view or whatever you want to do
        return redirect('staff/all-refrigerators')
            ->with('success', 'Rbc Bag issued successfully!');
    }

    public function issued_rbc()
    {
        $bank_id=Auth::user()->bank_id;
        $rbcs = IssuedRbc::get()->where('bank_id',$bank_id);
        return view('staff.rbc.issued', compact('rbcs'));
    }

    // public function issue($id)
    // {
    //     $rbc = Rbc::findOrFail($id);
    //     return view('staff.rbc.issue', compact('rbc'));
    // }

    // public function store_issued(Request $request, $id)
    // {
    //     $issued_at = Carbon::now();
    //     $rbc = Rbc::findOrFail($id);
    //      $constraints = [
    //         'hospital_id' => 'required|unique:hospitals',
    //      ];
    //     $input = [
    //         'hospital_id' => $request['issued_to'],
    //         'issued_at' => $issued_at,
    //     ];
    //     // dd($input);
    //     $this->validate($request, $constraints);
    //     Rbc::where('id', $id)
    //         ->update($input);

    //     return redirect('staff/rbc/')
    //         ->with('success', 'Red blood cells issued successfully');
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
        $rbc = Rbc::findOrFail($id);

        //now save the data in the variables;
        $rbc_id = $rbc->id;
        $refrigerator_id = $rbc->refrigerator_id;
        $bag_serial_number = $rbc->bag_serial_number;
        $group_id = $rbc->group_id;
        $donation_date = $rbc->donation_date;
        $expiry_date = $rbc->expiry_date;

        $discarded_rbc = new IssuedRbc();
        $discarded_rbc->rbc_id = $rbc_id;//from rbc

        $discarded_rbc->bank_id=Auth::user()->bank_id;//in session
        $discarded_rbc->staff_id=Auth::user()->id;//in session

        $discarded_rbc->refrigerator_id = $refrigerator_id;//from rbc
        $discarded_rbc->bag_serial_number = $bag_serial_number;//from rbc
        $discarded_rbc->group_id = $group_id;//from rbc
        $discarded_rbc->donation_date = $donation_date;//from rbc
        $discarded_rbc->expiry_date = $expiry_date;//from rbc

        $discarded_rbc['discarded_at']=$discarded_at;//carbon
        $discarded_rbc->save();
        // $rbc->delete();

        $input = [
            'discarded_at' => $discarded_at,
        ];

        // dd($input);
        Rbc::where('id', $id)
            ->update($input);

        //then return to your view or whatever you want to do
        return redirect('staff/all-refrigerators')
            ->with('success', 'Rbc Bag Discarded successfully!');
    }

    public function discarded_rbc()
    {
        $bank_id=Auth::user()->bank_id;
        $rbc = DiscardedRbc::get()->where('bank_id',$bank_id);
        return view('staff.rbc.discarded', compact('rbc'));
    }
}
