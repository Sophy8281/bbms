<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Freezer;
use App\Models\Bank;

class FreezerController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freezers = Freezer::all();
        return view('admin.freezers.index', compact('freezers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('admin.freezers.create', compact('banks'));
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
            'bank_id' => ['required'],
            'name' => ['required', 'unique:freezers'],
            'capacity' => ['required'],
        ]);
        $data = new Freezer();
        $data['bank_id']=$request->bank_id;
        $data->admin_id=Auth::user()->id;
        $data['name']=$request->name;
        $data['capacity']=$request->capacity;
        $data->save();

       return redirect('admin/all-freezers/')->with('success', 'Freezer created successfully!');
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
        $freezer = Freezer::findOrFail($id);
        return view('admin.freezers.edit', compact('freezer'));
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
        $freezer = Freezer::findOrFail($id);
        $constraints = [
           'name' => 'required',
           'capacity' => 'required',
        ];
       $input = [
           'name' => $request['name'],
           'capacity' => $request['capacity'],
       ];
       $this->validate($request, $constraints);
       Freezer::where('id', $id)
           ->update($input);

       return redirect('admin/all-freezers/')->with('success', 'Freezer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $freezer = Freezer::findOrFail($id);
        $freezer->delete();
        return redirect('admin/all-freezers/')->with('success','Freezer deleted Successfully!');
    }
}
