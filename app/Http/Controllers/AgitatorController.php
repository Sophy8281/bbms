<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Agitator;
use App\Models\Bank;

class AgitatorController extends Controller
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
        $agitators = Agitator::all();
        return view('admin.agitators.index', compact('agitators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('admin.agitators.create', compact('banks'));
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
            'name' => ['required', 'unique:agitators'],
            'capacity' => ['required'],
        ]);
        $data = new Agitator();
        $data['bank_id']=$request->bank_id;
        $data->admin_id=Auth::user()->id;
        $data['name']=$request->name;
        $data['capacity']=$request->capacity;
        $data->save();

       return redirect('admin/all-agitators/')->with('success', 'Agitator created successfully!');
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
        $agitator = Agitator::findOrFail($id);
        return view('admin.agitators.edit', compact('agitator'));
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
        $agitator = Agitator::findOrFail($id);
        $constraints = [
           'name' => 'required',
           'capacity' => 'required',
        ];
       $input = [
           'name' => $request['name'],
           'capacity' => $request['capacity'],
       ];
       $this->validate($request, $constraints);
       Agitator::where('id', $id)
           ->update($input);

       return redirect('admin/all-agitators/')->with('success', 'Agitator updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agitator = Agitator::findOrFail($id);
        $agitator->delete();
        return redirect('admin/all-agitators/')->with('success','Agitator deleted Successfully!');
    }
}
