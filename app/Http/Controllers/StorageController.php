<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Refrigerator;
use App\Models\Donation;
use App\Models\Agitator;
use App\Models\Platelet;
use App\Models\Freezer;
use App\Models\Plasma;
use App\Models\Blood;
use App\Models\Group;
use App\Models\Staff;
use App\Models\Bank;
use App\Models\Rbc;
use Carbon\Carbon;

class StorageController extends Controller
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
    public function blood_index()
    {
        $safe = 'Safe';
        $bank_id=Auth::user()->bank_id;
        $safe_blood = Donation::where('status', $safe)
        ->where('bank_id',$bank_id)
        ->whereNull('processed_at')
        ->whereNull('stored_at')
        ->get();

        return view('staff.store.blood', compact('safe_blood'));
    }

    public function store_blood($id)
    {
        $stored_at = Carbon::now();
        $safe_blood = Donation::findOrFail($id);

        //now save the data in the variables;
        $donation_id = $safe_blood->id;
        $bag_serial_number = $safe_blood->bag_serial_number;
        $group_id = $safe_blood->group_id;
        $donation_date = $safe_blood->created_at;
        // $expiry_date = $donation->expiry_date;

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
        // dd($safe_blood);
        // dd($blood);
        $input = [
            'stored_at' => $stored_at,
        ];

        // dd($input);
        Donation::where('id', $id)
            ->update($input);

        $blood->save();


        //then return to your view or whatever you want to do
        return redirect('staff/blood')
            ->with('success', 'Blood Bag stored in Cold Room successfully!');
    }

    public function plasma_index()
    {
        $bank_id=Auth::user()->bank_id;
        $processed_plasma = Donation::get()->unique('plasma_bag_no')
        ->where('bank_id',$bank_id)
        ->whereNull('plasma_stored_at')
        ->whereNotNull('processed_at');
        return view('staff.store.plasma', compact('processed_plasma'));
    }

    public function plasma_store_view($id)
    {
        $processed_plasma= Donation::findOrFail($id);
        $bank_id=Auth::user()->bank_id;
        $freezers=Freezer::get()
        ->where('bank_id',$bank_id);
        return view('staff.store.store_plasma', compact('processed_plasma','freezers'));
    }

    public function store_plasma(Request $request, $id)
    {
        $plasma_stored_at = Carbon::today();
        $processed_plasma = Donation::findOrFail($id);

        //now save the data in the variables;
        $plasma_bag_no = $processed_plasma->plasma_bag_no;
        $group_id = $processed_plasma->group_id;
        // $plasma_stored_at = $processed_plasma->plasma_stored_at;
        $donation_date = $processed_plasma->created_at;

        //validate
        $request->validate([
            'bag_serial_number' => ['unique:plasmas'],
            'freezer_id' => ['required'],
        ]);

        $plasma = new Plasma();
        $plasma->bank_id=Auth::user()->bank_id;//in session
        $plasma->staff_id=Auth::user()->id;//in session
        $plasma['freezer_id']=$request->freezer_id;//from form
        $plasma->bag_serial_number = $plasma_bag_no;//from donation
        $plasma->group_id = $group_id;//from donation
        $plasma->donation_date = $donation_date;//from donation
        $carbonone = new Carbon($donation_date);
        $carbontwo = $carbonone->copy()->addDays(365);
        $plasma->expiry_date=$carbontwo;

        $input = [
            'plasma_stored_at' => $plasma_stored_at,
        ];
        // dd($processed_plasma);
        // dd($plasma);
        // dd($stored_at);
        // dd($input);

        $plasma->save();

        // $donors = User::all();
        // foreach ($donors as $donor) {
        //     $donor->notify(new DonorNewDriveNotification($unapproved_drive));
        // }
        Donation::where('plasma_bag_no', $plasma_bag_no)
           ->update($input);

        //then return to your view or whatever you want to do
        return redirect('staff/plasma')
            ->with('success', 'Plasma Bag stored successfully!');
    }

    // PLATELETS
    public function platelets_index()
    {
        $bank_id=Auth::user()->bank_id;
        $processed_platelets = Donation::get()->unique('platelet_bag_no')
        ->where('bank_id',$bank_id)
        ->whereNull('platelet_stored_at')
        ->whereNotNull('processed_at');
        return view('staff.store.platelets', compact('processed_platelets'));
    }

    public function platelets_store_view($id)
    {
        $processed_platelets= Donation::findOrFail($id);
        $bank_id=Auth::user()->bank_id;
        $agitators=Agitator::get()
        ->where('bank_id',$bank_id);
        return view('staff.store.store_platelets', compact('processed_platelets','agitators'));
    }

    public function store_platelets(Request $request, $id)
    {
        $platelet_stored_at = Carbon::today();
        $processed_platelets = Donation::findOrFail($id);

        //now save the data in the variables;
        $platelet_bag_no = $processed_platelets->platelet_bag_no;
        $group_id = $processed_platelets->group_id;
        // $platelet_stored_at = $processed_platelets->plasma_stored_at;
        $donation_date = $processed_platelets->created_at;

        //validate
        $request->validate([
            'bag_serial_number' => ['unique:platelets'],
            'agitator_id' => ['required'],
        ]);

        $platelet = new Platelet();
        $platelet->bank_id=Auth::user()->bank_id;//in session
        $platelet->staff_id=Auth::user()->id;//in session
        $platelet['agitator_id']=$request->agitator_id;//from form
        $platelet->bag_serial_number = $platelet_bag_no;//from donation
        $platelet->group_id = $group_id;//from donation
        $platelet->donation_date = $donation_date;//from donation
        $carbonone = new Carbon($donation_date);
        $carbontwo = $carbonone->copy()->addDays(5);
        $platelet->expiry_date=$carbontwo;

        $input = [
            'platelet_stored_at' => $platelet_stored_at,
        ];

        $platelet->save();

        Donation::where('platelet_bag_no', $platelet_bag_no)
           ->update($input);

        //then return to your view or whatever you want to do
        return redirect('staff/platelets')
            ->with('success', 'Platelet Bag stored successfully!');
    }

    // RBC
    public function rbc_index()
    {
        $bank_id=Auth::user()->bank_id;
        $processed_rbc= Donation::get()->unique('rbc_bag_no')
            ->where('bank_id',$bank_id)
            ->whereNull('rbc_stored_at')
            ->whereNotNull('processed_at');
        return view('staff.store.rbc', compact('processed_rbc'));
    }

    public function rbc_store_view($id)
    {
        $processed_rbc= Donation::findOrFail($id);
        $bank_id=Auth::user()->bank_id;
        $refrigerators=Refrigerator::get()
            ->where('bank_id',$bank_id);
        return view('staff.store.store_rbc', compact('processed_rbc','refrigerators'));
    }

    public function store_rbc(Request $request, $id)
    {
        $rbc_stored_at = Carbon::today();
        // print($rbc_stored_at);
        $processed_rbc = Donation::findOrFail($id);

        //now save the data in the variables;
        $rbc_bag_no = $processed_rbc->rbc_bag_no;
        $group_id = $processed_rbc->group_id;
        // $rbc_stored_at = $processed_rbc->rbc_stored_at;
        $donation_date = $processed_rbc->created_at;

        //validate
        $request->validate([
            'bag_serial_number' => ['unique:red_blood_cells'],
            'refrigerator_id' => ['required'],
        ]);

        $rbc = new Rbc();
        $rbc->bank_id=Auth::user()->bank_id;//in session
        $rbc->staff_id=Auth::user()->id;//in session
        $rbc['refrigerator_id']=$request->refrigerator_id;//from form
        $rbc->bag_serial_number = $rbc_bag_no;//from donation
        $rbc->group_id = $group_id;//from donation
        $rbc->donation_date = $donation_date;//from donation
        $carbonone = new Carbon($donation_date);
        $carbontwo = $carbonone->copy()->addDays(42);
        $rbc->expiry_date=$carbontwo;

        $input = [
            'rbc_stored_at' => $rbc_stored_at,
        ];
        // dd($input);
        $rbc->save();

        Donation::where('rbc_bag_no', $rbc_bag_no)
           ->update($input);

        //then return to your view or whatever you want to do
        return redirect('staff/rbc')
            ->with('success', 'RBC Bag stored successfully!');
    }

}
