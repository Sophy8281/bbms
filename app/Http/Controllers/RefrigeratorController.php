<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Refrigerator;
use App\Models\Bank;

class RefrigeratorController extends Controller
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
        $refrigerators = Refrigerator::all();
        return view('admin.refrigerators.index', compact('refrigerators'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('admin.refrigerators.create', compact('banks'));
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
            'name' => ['required', 'unique:refrigerators'],
            'capacity' => ['required'],
        ]);
        $data = new Refrigerator();
        $data['bank_id']=$request->bank_id;
        $data->admin_id=Auth::user()->id;
        $data['name']=$request->name;
        $data['capacity']=$request->capacity;
        $data->save();
       return redirect('admin/all-refrigerators/')->with('success', 'Refrigerator created successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $refrigerator = Refrigerator::findOrFail($id);
        return view('admin.refrigerators.edit', compact('refrigerator'));
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
        $refrigerator = Refrigerator::findOrFail($id);
        $constraints = [
           'name' => 'required',
           'capacity' => 'required',
        ];
       $input = [
           'name' => $request['name'],
           'capacity' => $request['capacity'],
       ];
       $this->validate($request, $constraints);
       Refrigerator::where('id', $id)
           ->update($input);
       return redirect('admin/all-refrigerators/')->with('success', 'Refrigerator updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $refrigerator = Refrigerator::findOrFail($id);
        $refrigerator->delete();
        return redirect('admin/all-freezers/')->with('success','Refrigerator deleted Successfully!');
    }
}
