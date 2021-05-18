<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\HospitalRequest;
use App\Models\DiscardedBlood;
use App\Models\IssuedBlood;
use App\Models\Donation;
use App\Models\Hospital;
use App\Models\Blood;
use App\Models\Group;
use App\Models\Staff;
use App\Models\Bank;
use Carbon\Carbon;

class BloodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
        $this->middleware('assigned');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_safe()
    {
        $safe = 'Safe';
        $bank_id=Auth::user()->bank_id;
        $safe_blood = Donation::where('status', $safe)->where('bank_id',$bank_id)
            ->whereNull('processed_at')->whereNull('stored_at')->get();
        return view('staff.blood.process',compact('safe_blood'));
    }

    public function whole_blood()
    {
        $today = Carbon::today();
        $bank_id=Auth::user()->bank_id;
        $blood = Blood::get()->where('bank_id',$bank_id)->whereNull('issued_at')
            ->whereNull('discarded_at');
        $expired_blood =  Blood::where('bank_id',$bank_id)->where('expiry_date', '<=', $today)
            ->whereNull('issued_at')->whereNull('discarded_at')->count();
        return view('staff.blood.index',compact('blood','expired_blood'));
    }

    public function issue($id)
    {
        $blood = Blood::findOrFail($id);
        $group_id = $blood->group_id;
        $product = 'whole blood';
        $hospitals = HospitalRequest::where('group_id', $group_id)->where('product', $product)
            ->where('remaining', '>', 0)->whereNull('satisfied_at')->get()->unique('hospital_id');
        return view('staff.blood.issue', compact('hospitals','blood'));
    }

    public function store_issued(Request $request, $id)
    {
        $issued_at = Carbon::today();
        $blood = Blood::findOrFail($id);

        //now save the data in the variables;
        $donation_id = $blood->donation_id;
        $bag_serial_number = $blood->bag_serial_number;
        $group_id = $blood->group_id;
        $donation_date = $blood->donation_date;
        $expiry_date = $blood->expiry_date;

        //validate input to issued blood
        $request->validate([
            'hospital_id' => ['required'],
        ]);

        //new record to issued blood
        $issued_blood = new IssuedBlood();
        $issued_blood->donation_id = $donation_id;//from blood
        $issued_blood->bank_id=Auth::user()->bank_id;//in session
        $issued_blood->staff_id=Auth::user()->id;//in session
        $issued_blood->bag_serial_number = $bag_serial_number;//from blood
        $issued_blood->group_id = $group_id;//from blood
        $issued_blood->donation_date = $donation_date;//from blood
        $issued_blood->expiry_date = $expiry_date;//from blood
        $issued_blood['hospital_id']=$request->hospital_id;//from form
        $issued_blood['issued_at']=$issued_at;//carbon
        $issued_blood->save();

        //validate input to blood
        $input_to_update_blood = [
            'issued_at' => $issued_at,
        ];

        //variables for updating request
        $satisfied_at = Carbon::today();
        $group_id = $blood->group_id;
        $product = 'whole blood';
        $hospital_request = HospitalRequest::where('hospital_id', $issued_blood['hospital_id'])
            ->where('group_id', $group_id)->where('product', $product)
            ->where('remaining', '>', 0)->whereNull('satisfied_at')->first();

        $hospital_request_id =  $hospital_request->id;
        $hospital_request_remaining =  $hospital_request->remaining;
        $new_remaining = $hospital_request_remaining -1;

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

        Blood::where('id', $id)
            ->update($input_to_update_blood);

        //then return to your view or whatever you want to do
        return redirect('staff/cold-room')
            ->with('success', 'Whole-Blood Bag issued successfully!');
    }

    public function issued_blood()
    {
        $bank_id=Auth::user()->bank_id;
        $blood = IssuedBlood::get()->where('bank_id',$bank_id);
        return view('staff.blood.issued', compact('blood'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store_blood($id)
    {
        $stored_at = Carbon::now();
        $donation = Donation::findOrFail($id);

        //now save the data in the variables;
        $donation_id = $donation->id;
        $bag_serial_number = $donation->bag_serial_number;
        $group_id = $donation->group_id;
        $donation_date = $donation->created_at;

        $blood = new Blood();
        $blood->donation_id = $donation_id;//from donation

        $blood->bank_id=Auth::user()->bank_id;//in session
        $blood->staff_id=Auth::user()->id;//in session

        $blood->bag_serial_number = $bag_serial_number;//from donation
        $blood->group_id = $group_id;//from donation
        $blood->donation_date = $donation_date;//from donation
        $carbonone = new Carbon($donation_date);
        $carbontwo = $carbonone->copy()->addDays(42);
        $blood->expiry_date=$carbontwo;

        $input = [
            'stored_at' => $stored_at,
        ];

        Donation::where('id', $id)
            ->update($input);

        $blood->save();

        //then return to your view or whatever you want to do
        return redirect('staff/process')
            ->with('success', 'Blood Bag stored in Cold Room successfully!');
    }

    public function process_blood($id)
    {
        $donation = Donation::findOrFail($id);
        $processed_at = Carbon::now();

        $input = [
            'processed_at' => $processed_at,
        ];

        Donation::where('id', $id)
            ->update($input);

        return redirect('staff/process')
            ->with('success', 'Blood Processed successfully!');
    }

    public function processed_blood()
    {
        $processed_blood = Donation::whereNotNull('processed_at')->get();
        return view('staff.blood.processed',compact('processed_blood'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function discard($id)
    {
        $discarded_at = Carbon::today();
        $blood = Blood::findOrFail($id);

        //now save the data in the variables;
        $donation_id = $blood->id;
        $bag_serial_number = $blood->bag_serial_number;
        $group_id = $blood->group_id;
        $donation_date = $blood->donation_date;
        $expiry_date = $blood->expiry_date;

        $discarded_blood = new DiscardedBlood();
        $discarded_blood->donation_id = $donation_id;//from blood

        $discarded_blood->bank_id=Auth::user()->bank_id;//in session
        $discarded_blood->staff_id=Auth::user()->id;//in session

        $discarded_blood->bag_serial_number = $bag_serial_number;//from blood
        $discarded_blood->group_id = $group_id;//from blood
        $discarded_blood->donation_date = $donation_date;//from blood
        $discarded_blood->expiry_date = $expiry_date;//from blood

        $discarded_blood['discarded_at']=$discarded_at;//carbon

        $discarded_blood->save();

        $input = [
            'discarded_at' => $discarded_at,
        ];

        Blood::where('id', $id)
            ->update($input);

        //then return to your view or whatever you want to do
        return redirect('staff/cold-room')
            ->with('success', 'Blood Bag Discarded successfully!');
    }

    public function discarded_blood()
    {
        $bank_id=Auth::user()->bank_id;
        $blood = DiscardedBlood::get()->where('bank_id',$bank_id);
        return view('staff.blood.discarded', compact('blood'));
    }
}
