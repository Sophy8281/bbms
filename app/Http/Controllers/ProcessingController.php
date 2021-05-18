<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Donation;
use Carbon\Carbon;

class ProcessingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
    public function index()
    {
        $safe = 'Safe';
        $bank_id=Auth::user()->bank_id;
        $unprocessed = Donation::where('status', $safe)
            ->whereNull('processed_at')
            ->whereNull('stored_at')
            ->where('bank_id',$bank_id)->get();
        return view('staff.processing.index',compact('unprocessed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $unprocessed = Donation::findOrFail($id);
        return view('staff.processing.process',compact('unprocessed'));
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
        $unprocessed = Donation::findOrFail($id);
        $processed_at = Carbon::now();

        $constraints = [
            'plasma_bag_no' => 'required_without_all:platelet_bag_no,rbc_bag_no|max:255|unique:plasmas,bag_serial_number',
            'platelet_bag_no'=> 'required_without_all:plasma_bag_no,rbc_bag_no|max:255|unique:platelets,bag_serial_number',
            'rbc_bag_no'=> 'required_without_all:plasma_bag_no,platelet_bag_no|max:255|unique:red_blood_cells,bag_serial_number',
        ];

        $input = [
            'plasma_bag_no' => $request['plasma_bag_no'],
            'platelet_bag_no' => $request['platelet_bag_no'],
            'rbc_bag_no' => $request['rbc_bag_no'],
            'processed_at' => $processed_at,
        ];

        // dd($input);
        $this->validate($request, $constraints);
        Donation::where('id', $id)
            ->update($input);

        return redirect('staff/process')
            ->with('success', 'Blood Processed successfully!');
    }

    public function processed_blood()
    {
        $bank_id=Auth::user()->bank_id;
        $processed_blood = Donation::whereNotNull('processed_at')
        ->where('bank_id',$bank_id)->get();
        return view('staff.processing.processed',compact('processed_blood'));
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
