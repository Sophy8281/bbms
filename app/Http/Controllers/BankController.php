<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BloodBank;
use App\Models\Donation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class BankController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:bank');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
     {

         $users = User::paginate(10);
         return view('bank.index', compact('users'));
     }

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */

        /******************** STAFF DONOR-MANAGEMENT *****************************/
    public function createUser()
    {
        return view('bank.create-user');
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //User::create($request->all());
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        return redirect()->intended('bank')->with('success','Donor Created Successfully!');
    }

     public function editUser($id)
     {
         $user = User::findOrFail($id);
         return view('bank.edit-user', compact('user'));
     }

     public function updateUser(Request $request, $id)
     {
         $user = User::findOrFail($id);
         $constraints = [
             'name' => 'required|max:255',
             'email'=> 'required|max:255',

         ];
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
        ];
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);
         return redirect('bank')->with('success','Donor Updated Successfully!');
     }

    public function deleteUser($id)
     {
         $user = User::findOrFail($id);
         $user->delete();
         return redirect('bank')->with('success','Donor Deleted Successfully!');
     }

     /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */

        /******************** STAFF DONATION-MANAGEMENT *****************************/
    public function addDonation()
    {
        return view('bank.add-donation');
    }

    public function storeDonation(Request $request)
    {
        $storeData = $request->validate([
            'user_id' => ['required'],
            //'bank_id' =>[],
            'bag_serial_number' => ['required', 'string','unique:donations'],
            'blood_group' => [],
            'status' => [],
        ]);

        Auth::user()->bloodbank_id;
        $donation = Donation::create($storeData);
        return redirect()->intended('bank')->with('success','Donation Added Successfully!');
    }



}
