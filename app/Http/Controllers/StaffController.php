<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewDonationNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\Refrigerator;
use App\Models\Appointment;
use App\Models\Donation;
use App\Models\Agitator;
use App\Models\Platelet;
use App\Models\Freezer;
use App\Models\Plasma;
use App\Models\Drive;
use App\Models\Bank;
use App\Models\Admin;
use App\Models\Group;
use App\Models\Staff;
use App\Models\User;
use App\Models\Rbc;
use App\models\SendSms;
use Illuminate\Support\Str;
use App\Http\Controllers\Mail;
use App\DataTables\UsersDataTable;
use PDF;
use Carbon\Carbon;


class StaffController extends Controller
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

    /******************** STAFF WAITING-ASSIGNNMENT - PAGE *****************************/
    public function assigned()
    {
        return view('staff.assigned');
    }

    /******************** STAFF MAIN - PAGE ******************************************/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $donors = User::all()->count();
        $bank_id=Auth::user()->bank_id;
        $platelets = Platelet::where('bank_id',$bank_id)->count();
        $plasma = Plasma::where('bank_id',$bank_id)->count();
        $rbc = Rbc::where('bank_id',$bank_id)->count();

        return view('staff.staff', compact('donors','platelets','plasma','rbc'));
    }

    /******************** STAFF DONOR - MANAGEMENT *****************************/
    public function all_donors ()
    {
        $users = User::all();

        return view('staff.donors.index', compact('users'));
    }

    // public function users_datatable(UsersDataTable $dataTable)
    // {
    //     return $dataTable->render('users');
    // }

    public function createUser()
    {
        $blood_groups = Group::all();

        return view('staff.create-user', compact('blood_groups'));
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function storeUser(Request $request)
    {
        $password = Str::random();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string', 'max:255'],
            'unique_no' => ['required', 'max:255'],
            'birth_date' => 'required|max:255|before:today',
            'address' => ['max:255'],
            'phone' => ['required', 'max:255'],
            'blood_group' => ['string', 'max:255'],
            'county' => ['required', 'string', 'max:255'],
        ]);
        // dd($request);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'unique_no' => $request['unique_no'],
            'birth_date' => $request['birth_date'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'blood_group' => $request['blood_group'],
            'county' => $request['county'],
            'password' => bcrypt($password),
        ]);
        Password::sendResetLink($request->only(['email']));

        return redirect('/staff/all-users')->with('success','Donor Created Successfully!');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $blood_groups = Group::all();
        return view('staff.edit-user', compact('user','blood_groups'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $constraints = [
            'name' => 'required|max:255',
            'email'=> 'required|max:255',
            'gender'=> 'required|max:255',
            'unique_no'=> 'required|max:255',
            'birth_date'=> 'required|max:255',
            'address'=> 'max:255',
            'phone'=> 'required|max:255',
            'blood_group'=> 'required|max:255',
            'county'=> 'required|max:255',
        ];
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'unique_no' => $request['unique_no'],
            'birth_date' => $request['birth_date'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'blood_group' => $request['blood_group'],
            'county' => $request['county'],
        ];
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);

        return redirect('/staff/all-users')->with('success','Donor Updated Successfully!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/staff/all-users')->with('success','Donor Deleted Successfully!');
    }

    /******************** STAFF DONATION - MANAGEMENT *****************************/
    public function all_donations()
    {
        $bank_id=Auth::user()->bank_id;
        $donations = Donation::where('bank_id',$bank_id)->paginate(10);
        return view('staff.donations.index', compact('donations'));
    }

    public function add_donation()
    {
        $donors = User::all();
        $blood_groups = Group::all();
        return view('staff.add_donation',compact('donors','blood_groups'));
    }

    public function save_donation(Request $request )
    {
        $request->validate([
            'bag_serial_number' => ['required', 'unique:donations'],
        ]);
        $data = new Donation();
        $data->staff_id=Auth::user()->id;
        $data['donor_id']=$request->donor_id;
        $data->bank_id=Auth::user()->bank_id;
        $data['bag_serial_number']=$request->bag_serial_number;
        $data['blood_group']=$request->blood_group;
        $data['status']=$request->status;
       // dd($data);
        $data->save();
        $donor = User::get()->where('id',$data['donor_id']);
        // dd($donor);
        Notification::send( $donor, new NewDonationNotification($data));
        $phone = DB::table('users')
            ->where('id',$data['donor_id'])
            ->select('phone')
            ->pluck('phone')
            ->first();
        // dd( $phone );
        if($phone){
            SendSms::sendsms($phone);
        }
        return redirect('staff/all-donations/')->with('success','Donation Added Successfully!');
    }

    public function edit_donation($id)
    {
        $donors = User::all();
        $blood_groups = Group::all();
        $donation = Donation::findOrFail($id);
        return view('staff.donations.edit', compact('donors','blood_groups','donation'));
    }

    public function update_donation(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);
         $constraints = [
            'donor_id' => ['required'],
            'bag_serial_number' => ['required', 'unique:donations'],
            'blood_group' => ['required'],
            'status' => ['required'],
         ];
        $input = [
            'donor_id' => $request['donor_id'],
            'bag_serial_number' => $request['bag_serial_number'],
            'blood_group' => $request['blood_group'],
            'status' => $request['status'],
        ];
        $this->validate($request, $constraints);
        Donation::where('id', $id)
            ->update($input);

        return redirect('staff/all-donations/')->with('success', 'Donation updated successfully!');
    }

    public function delete_donation($id)
     {
         $donation = Donation::findOrFail($id);
         $donation->delete();

         return redirect('staff/all-donations/')->with('success','Donation deleted Successfully!');

     }

    /******************** STAFF BLOOD-RESULTS - MANAGEMENT *****************************/
    public function all_unscreened_donations()
    {
        $bank_id=Auth::user()->bank_id;
        // $donations = Donation::where('bank_id',$bank_id)->paginate(10);
        $donations = Donation::whereNull('blood_group')->where('bank_id',$bank_id)->get();
        //  $donations = Donation::paginate(10);
         return view('staff.unscreened_donations', compact('donations'));
     }

    public function add_blood_results(Request $request ,$id)
    {
        $donations = Donation::findOrFail($id);
        $blood_groups =Group::all();
        return view('staff.add_blood_results',compact('donations','blood_groups'));

    }

    public function store_blood_results(Request $request, $id)
    {
        $data =array();
        $data['blood_group']=$request->blood_group;
        $data['status']=$request->status;

        DB::table('donations')
        ->where('id', $id)
        ->update($data);

        return Redirect::to('staff/all-donations/')->with('success','Results Added Successfully!');
    }

    /******************** STAFF STORAGE-FACILITY - MANAGEMENT *****************************/
    // Agitators
    public function all_agitators()
    {
        $bank_id=Auth::user()->bank_id;
        // $platelets = Platelet::get()->where('bank_id',$bank_id);
        $agitators = Agitator::get()->where('bank_id',$bank_id);
        // $count = Platelet::where('bank_id',$bank_id)
        // ->whereNull('hospital_id')->whereNull('issued_at')->count();
        return view('staff.agitators.index', compact('agitators'));
    }

    public function add_agitator()
    {
        return view('staff.agitators.create');
    }

    public function store_agitator(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:agitators'],
            'capacity' => ['required'],
        ]);
        $data = new Agitator();
        $data->bank_id=Auth::user()->bank_id;
        $data->staff_id=Auth::user()->id;
        $data['name']=$request->name;
        $data['capacity']=$request->capacity;
        $data->save();

       return Redirect::to('staff/all-agitators/')->with('success', 'Agitator created successfully!');
    }

    public function show_agitator($id)
    {
        $agitator = Agitator::findOrFail($id);
        return view('staff.agitators.show', compact('agitator'));
    }

    public function edit_agitator($id)
    {
        $agitator = Agitator::findOrFail($id);
        return view('staff.agitators.edit', compact('agitator'));
    }

    public function update_agitator(Request $request, $id)
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

        return redirect('staff/all-agitators/')
            ->with('success', 'Agitator updated successfully!');
    }

    public function delete_agitator($id)
     {
         $agitator = Agitator::findOrFail($id);
         $agitator->delete();
         return redirect('staff/all-agitators/')->with('success','Agitator deleted Successfully!');

     }

    // Freezers
    public function all_freezers()
    {
        $bank_id=Auth::user()->bank_id;
        $freezers = Freezer::where('bank_id',$bank_id)->paginate(1);
        // $count = Plasma::where('bank_id',$bank_id)
        // ->whereNull('hospital_id')->whereNull('issued_at');
        return view('staff.freezers.index', compact('freezers'));
    }

    public function add_freezer()
    {
        return view('staff.freezers.create');
    }

    public function store_freezer(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:freezers'],
            'capacity' => ['required'],
        ]);
        $data = new Freezer();
        $data->bank_id=Auth::user()->bank_id;
        $data->staff_id=Auth::user()->id;
        $data['name']=$request->name;
        $data['capacity']=$request->capacity;
        $data->save();

       return Redirect::to('staff/all-freezers/')->with('success', 'Freezer created successfully!');
    }

    public function show_freezer($id)
    {
        $freezer = Freezer::findOrFail($id);
        return view('staff.freezers.show', compact('freezer'));
    }

    public function edit_freezer($id)
    {
        $freezer = Freezer::findOrFail($id);
        return view('staff.freezers.edit', compact('freezer'));
    }

    public function update_freezer(Request $request, $id)
    {
        $freezers = Freezer::findOrFail($id);
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

        return redirect('staff/all-freezers/')
            ->with('success', 'Freezer updated successfully!');
    }

    public function delete_freezer($id)
     {
         $freezer = Freezer::findOrFail($id);
         $freezer->delete();
         return redirect('staff/all-freezers/')->with('success','Freezer deleted Successfully!');
     }

    // Refrigerators
    public function all_refrigerators()
    {
        $bank_id=Auth::user()->bank_id;
        $refrigerators = Refrigerator::get()->where('bank_id',$bank_id);
        // $count = Rbc::where('bank_id',$bank_id)
        // ->whereNull('hospital_id')->whereNull('issued_at')->count();
        return view('staff.refrigerators.index', compact('refrigerators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_refrigerator()
    {
        // $blood_groups = Group::all();
        return view('staff.refrigerators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_refrigerator(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:refrigerators'],
            'capacity' => ['required'],
        ]);
        $data = new Refrigerator();
        $data->bank_id=Auth::user()->bank_id;
        $data->staff_id=Auth::user()->id;
        $data['name']=$request->name;
        $data['capacity']=$request->capacity;
        $data->save();
       return Redirect::to('staff/all-refrigerators/')
            ->with('success', 'Refrigerator created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Refrigerator  $refrigerator
     * @return \Illuminate\Http\Response
     */
    public function show_refrigerator(Refrigerator $refrigerator, $id)
    {
        $refrigerator = Refrigerator::findOrFail($id);
        return view('staff.refrigerators.show', compact('refrigerator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Refrigerator  $refrigerator
     * @return \Illuminate\Http\Response
     */
    public function edit_refrigerator($id)
    {
        $refrigerator = Refrigerator::findOrFail($id);
        return view('staff.refrigerators.edit', compact('refrigerator'));
    }

    public function update_refrigerator(Request $request, $id)
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

        return redirect('staff/all-refrigerators/')
            ->with('success', 'Refrigerator updated successfully!');
    }

    public function delete_refrigerator($id)
     {
         $refrigerator = Refrigerator::findOrFail($id);
         $refrigerator->delete();
         return redirect('staff/all-refrigerators/')->with('success','Refrigerator deleted Successfully!');

     }

    /******************** STAFF DRIVE - MANAGEMENT *****************************/
    public function all_drives()
    {
        $bank_id=Auth::user()->bank_id;
        $unapproved_drives = Drive::whereNull('approved_at')->get();
        $drives = Drive::get()->where('bank_id',$bank_id)->whereNotNull('approved_at','approved_by');
        return view('staff.drives.index', compact('unapproved_drives','drives'));
    }

    public function create_drive()
    {
        return view('staff.drives.create');
    }

    public function store_drive(Request $request)
    {
        $request->validate([
            'location' => ['required','string'],
            'date' => ['required','after_or_equal:today'],
            'time' => ['required','string'],
        ]);
        $data = new Drive();
        $data->bank_id=Auth::user()->bank_id;
        $data->staff_id=Auth::user()->id;
        $data['location']=$request->location;
        $data['date']=$request->date;
        $data['time']=$request->time;
        // dd($data);
        $data->save();
       return Redirect::to('staff/drives/')
            ->with('success', 'Drive created successfully!');
    }

    public function show_drive($id)
    {
        $drive = Drive::findOrFail($id);
        return view('staff.drives.show', compact('drive'));
    }

    public function edit_drive($id)
    {
        $unapproved_drive = Drive::findOrFail($id);
        return view('staff.drives.edit', compact('unapproved_drive'));
    }

    public function update_drive(Request $request, $id)
    {
        $unapproved_drive = Drive::findOrFail($id);
         $constraints = [
            'location' => ['required','string'],
            'date' => ['required','after_or_equal:today'],
            'time' => ['required','string'],
         ];
        $input = [
            'location' => $request['location'],
            'date' => $request['date'],
            'time' => $request['time'],
        ];
        $this->validate($request, $constraints);
        Drive::where('id', $id)
            ->update($input);

        return redirect('staff/drives/')
            ->with('success', 'Drive updated successfully!');
    }

    public function destroy_drive($id)
     {
         $unapproved_drive = Drive::findOrFail($id);
         $unapproved_drive->delete();

         return redirect('staff/drives/')->with('success','Drive deleted Successfully!');
     }

     /******************** STAFF APPOINTMENT - MANAGEMENT *****************************/
    public function appointments()
    {
        $bank_id=Auth::user()->bank_id;
        $pending_appointments = Appointment::get()->whereNull('done_at')->where('bank_id',$bank_id);
        $appointments = Appointment::get()->where('bank_id',$bank_id)->whereNotNull('done_at');

        return view('staff.appointments.index', compact('pending_appointments','appointments'));

    }
    public function mark_appointment($id)
    {
        $staff_id=Auth::user()->id;
        $done_at = Carbon::now();
        $appointment = Appointment::findOrFail($id);
        // $appointment->update(['done_at' => now()]);

        $input = [
            'staff_id' => $staff_id,
            'done_at' => $done_at,
        ];
        // $this->validate($request, $constraints);
        Appointment::where('id', $id)
            ->update($input);

        return redirect('staff/appointments/')->with('success','Appointment Marked Successfully!');
    }

    /******************** STAFF REPORTS- MANAGEMENT *****************************/
    public function donors_pdf(Request $request)
    {
        $users = User::all();
        $pdf = PDF::loadView('reports.donors', compact('users'));
        return $pdf->stream();
    }

    public function plasma_pdf(Request $request)
    {
        $bank_id=Auth::user()->bank_id;
        $plasma = Plasma::where('bank_id',$bank_id)->get();
        $pdf = PDF::loadView('reports.plasma', compact('plasma'));
        return $pdf->stream();
    }

    public function platelets_pdf(Request $request)
    {
        $bank_id=Auth::user()->bank_id;
        $platelets = Platelet::where('bank_id',$bank_id)->get();
        $pdf = PDF::loadView('reports.platelets', compact('platelets'));
        return $pdf->stream();
    }

    public function rbc_pdf(Request $request)
    {
        $bank_id=Auth::user()->bank_id;
        $rbc = rbc::where('bank_id',$bank_id)->get();
        $pdf = PDF::loadView('reports.rbc', compact('rbc'));
        return $pdf->stream();
    }


}