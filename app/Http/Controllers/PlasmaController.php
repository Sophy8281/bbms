<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Hospital;
use App\Models\Freezer;
use App\Models\Plasma;
use App\Models\IssuedPlasma;
use App\Models\DiscardedPlasma;
use App\Models\HospitalRequest;
use App\Models\Group;
use App\Models\Staff;
use App\Models\Bank;
use Carbon\Carbon;

class PlasmaController extends Controller
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
        $freezer = Freezer::findOrFail($id);
        // $plasma = Plasma::paginate(1)->where('bank_id',$bank_id)->where('freezer_id',$id)
        // ->whereNull('hospital_id','issued_at');
        // $plasma = Plasma::where('bank_id',$bank_id)->where('freezer_id',$id)
        // ->whereNull('hospital_id')
        // ->whereNull('issued_at')->paginate(1);
        $plasma = Plasma::get()->where('bank_id',$bank_id)
            ->where('freezer_id',$id)
            ->whereNull('issued_at')
            ->whereNull('discarded_at');
        return view('staff.plasma.index', compact('freezer','plasma'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank_id=Auth::user()->bank_id;
        $freezers = Freezer::get()->where('bank_id',$bank_id);
        // $freezers = Freezer::all();
        $blood_groups = Group::all();
        return view('staff.plasma.create', compact('freezers','blood_groups'));
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
            'bag_serial_number' => ['required', 'unique:plasmas'],
            'donation_date' => ['required', 'before_or_equal:today','after:1900-01-01'],

        ]);
        $data = new Plasma();
        $data->bank_id=Auth::user()->bank_id;
        $data->staff_id=Auth::user()->id;
        $data['freezer_id']=$request->freezer_id;
        $data['bag_serial_number']=$request->bag_serial_number;
        $data['group_id']=$request->group_id;
        $data['donation_date']=$request->donation_date;
        $donation_date =$data['donation_date'];
        $carbonone = new Carbon($donation_date);
        $carbontwo = $carbonone->copy()->addDays(365);
        $data->expiry_date=$carbontwo;

        // dd($data);
        $data->save();
        return Redirect::to('staff/all-freezers')
            ->with('success', 'Plasma Bag Stored successfully!');
    }

    // public function issue($id)
    // {
    //     $hospitals = Hospital::all();
    //     $plasma = Plasma::findOrFail($id);
    //     return view('staff.plasma.issue', compact('hospitals','plasma'));
    // }

    // public function store_issued(Request $request, $id)
    // {
    //     $issued_at = Carbon::today();
    //     $plasma = Plasma::findOrFail($id);
    //     // $first = First::where('id', $id)->first(); //this will select the row with the given id

    //     //now save the data in the variables;
    //     $plasma_id = $plasma->id;
    //     $freezer_id = $plasma->freezer_id;
    //     $bag_serial_number = $plasma->bag_serial_number;
    //     $group_id = $plasma->group_id;
    //     $donation_date = $plasma->donation_date;
    //     $expiry_date = $plasma->expiry_date;
    //     // $plasma->delete();

    //     $request->validate([
    //         'bag_serial_number' => ['unique:issued_plasmas'],
    //         'hospital_id' => ['required'],
    //     ]);

    //     $issued_plasma = new IssuedPlasma();
    //     $issued_plasma->plasma_id = $plasma_id;//from plasma

    //     $issued_plasma->bank_id=Auth::user()->bank_id;//in session
    //     $issued_plasma->staff_id=Auth::user()->id;//in session

    //     $issued_plasma->freezer_id = $freezer_id;//from plasma
    //     $issued_plasma->bag_serial_number = $bag_serial_number;//from plasma
    //     $issued_plasma->group_id = $group_id;//from plasma
    //     $issued_plasma->donation_date = $donation_date;//from plasma
    //     $issued_plasma->expiry_date = $expiry_date;//from plasma

    //     $issued_plasma['hospital_id']=$request->hospital_id;//from form

    //     $issued_plasma['issued_at']=$issued_at;//carbon
    //     $issued_plasma->save();
    //     // $plasma->delete();

    //     $input = [
    //         'issued_at' => $issued_at,
    //     ];

    //     // dd($input);
    //     Plasma::where('id', $id)
    //         ->update($input);

    //     // dd($issued_plasma);
    //     //then return to your view or whatever you want to do
    //     return redirect('staff/all-freezers')
    //         ->with('success', 'Plasma Bag issued successfully');
    // }

    public function issue($id)
    {
        $plasma = Plasma::findOrFail($id);
        $group_id = $plasma->group_id;
        $product = 'plasma';
        $hospitals = HospitalRequest::where('group_id', $group_id)->where('product', $product)
            ->where('remaining', '>', 0)->whereNull('satisfied_at')->get()->unique('hospital_id');

            return view('staff.plasma.issue', compact('hospitals','plasma'));
    }

    public function store_issued(Request $request, $id)
    {
        $issued_at = Carbon::today();
        $plasma = Plasma::findOrFail($id);

        //now save the data in the variables;
        $plasma_id = $plasma->id;
        $freezer_id = $plasma->freezer_id;
        $bag_serial_number = $plasma->bag_serial_number;
        $group_id = $plasma->group_id;
        $donation_date = $plasma->donation_date;
        $expiry_date = $plasma->expiry_date;

        //validate input to issued plasma
        $request->validate([
            'hospital_id' => ['required'],
            'bag_serial_number' => ['unique:issued_plasmas'],
        ]);

        //new record to issued plasma
        $issued_plasma = new IssuedPlasma();
        $issued_plasma->plasma_id = $plasma_id;//from plasma

        $issued_plasma->bank_id=Auth::user()->bank_id;//in session
        $issued_plasma->staff_id=Auth::user()->id;//in session

        $issued_plasma->freezer_id = $freezer_id;//from plasma
        $issued_plasma->bag_serial_number = $bag_serial_number;//from plasma
        $issued_plasma->group_id = $group_id;//from plasma
        $issued_plasma->donation_date = $donation_date;//from plasma
        $issued_plasma->expiry_date = $expiry_date;//from plasma
        $issued_plasma['hospital_id']=$request->hospital_id;//from form
        $issued_plasma['issued_at']=$issued_at;//carbon
        $issued_plasma->save();
            // dd($issued_plasma);
        //validate input to plasma
        $input_to_update_plasma = [
            'issued_at' => $issued_at,
        ];

        //variables for updating request
        $satisfied_at = Carbon::today();
        $group_id = $plasma->group_id;
        $product = 'plasma';
        $hospital_request = HospitalRequest::where('hospital_id', $issued_plasma['hospital_id'])
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

        Plasma::where('id', $id)
            ->update($input_to_update_plasma);

        //then return to your view or whatever you want to do
        return redirect('staff/all-freezers')
            ->with('success', 'Plasma Bag issued successfully');
    }

    public function issued_plasma()
    {
        $bank_id=Auth::user()->bank_id;
        $plasma = IssuedPlasma::get()->where('bank_id',$bank_id);
        return view('staff.plasma.issued', compact('plasma'));
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

    public function discard($id)
    {
        $discarded_at = Carbon::today();
        $plasma = Plasma::findOrFail($id);
        // $first = First::where('id', $id)->first(); //this will select the row with the given id

        //now save the data in the variables;
        $plasma_id = $plasma->id;
        $freezer_id = $plasma->freezer_id;
        $bag_serial_number = $plasma->bag_serial_number;
        $group_id = $plasma->group_id;
        $donation_date = $plasma->donation_date;
        $expiry_date = $plasma->expiry_date;

        $discarded_plasma = new DiscardedPlasma();
        $discarded_plasma->plasma_id = $plasma_id;//from plasma

        $discarded_plasma->bank_id=Auth::user()->bank_id;//in session
        $discarded_plasma->staff_id=Auth::user()->id;//in session

        $discarded_plasma->freezer_id = $freezer_id;//from plasma
        $discarded_plasma->bag_serial_number = $bag_serial_number;//from plasma
        $discarded_plasma->group_id = $group_id;//from plasma
        $discarded_plasma->donation_date = $donation_date;//from plasma
        $discarded_plasma->expiry_date = $expiry_date;//from plasma

        $discarded_plasma['discarded_at']=$discarded_at;//carbon

        // dd($discarded_plasma);
        $discarded_plasma->save();
        // $plasma->delete();

        $input = [
            'discarded_at' => $discarded_at,
        ];

        // dd($input);
        Plasma::where('id', $id)
            ->update($input);

        //then return to your view or whatever you want to do
        return redirect('staff/all-freezers')
            ->with('success', 'Plasma Bag Discarded successfully!');
    }

    public function discarded_plasma()
    {
        $bank_id=Auth::user()->bank_id;
        $plasma = DiscardedPlasma::get()->where('bank_id',$bank_id);
        return view('staff.plasma.discarded', compact('plasma'));
    }
}
