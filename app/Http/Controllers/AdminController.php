<?php

namespace App\Http\Controllers;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\Platelet;
use App\Models\Plasma;
use App\Models\Rbc;
use App\Models\IssuedPlatelet;
use App\Models\IssuedPlasma;
use App\Models\IssuedBlood;
use App\Models\IssuedRbc;
use App\Models\DiscardedPlatelet;
use App\Models\DiscardedPlasma;
use App\Models\DiscardedBlood;
use App\Models\DiscardedRbc;
use App\Models\Hospital;
use App\Models\Donation;
use App\Models\Blood;
use App\Models\About;
use App\Models\Bank;
use App\Models\Admin;
use App\Models\Group;
use App\Models\Staff;
use App\Models\Drive;
use App\Models\User;
use PDF;
use Carbon\Carbon;
use App\Notifications\DonorNewDriveNotification;
use DB;
use App\Models\Faq;
use App\Models\HospitalRequest;
use LarapexChart;

class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $donors = User::all()->count();
        $platelets = Platelet::whereNull('issued_at')->whereNull('discarded_at')->count();
        $plasma = Plasma::whereNull('issued_at')->whereNull('discarded_at')->count();
        $rbc = Rbc::whereNull('issued_at')->whereNull('discarded_at')->count();
        return view('admin.admin', compact('donors','platelets','plasma','rbc'));
    }

    /******************** ADMIN BANK - MANAGEMENT *****************************/
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function addBank()
    {
        return view('admin.add_bank');
    }

    public function storeBank(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:banks'],
            'phone' => ['required'],
            'county' => ['required', 'string', 'max:255'],
        ]);
        $data = new Bank();
        $data->admin_id=Auth::user()->id;
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['county']=$request->county;
        // dd($data);
        $data->save();
        return redirect('admin/all-banks/')->with('success','Bank Created Successfully!');
    }

    public function allBanks()
    {
        $banks = Bank::all();
        return view('admin.banks.index', compact('banks'));
    }

    public function edit_bank($id)
    {
        $bank = Bank::findOrFail($id);
        return view('admin.banks.edit', compact('bank'));
    }

    public function update_bank(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);
         $constraints = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required'],
            'county' => ['required', 'string', 'max:255'],
         ];
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'county' => $request['county'],
        ];
        $this->validate($request, $constraints);
        Bank::where('id', $id)
            ->update($input);
        return redirect('admin/all-banks/')->with('success', 'Bank updated successfully!');
    }

    public function delete_bank($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        return redirect('admin/all-banks/')->with('success','Bank deleted Successfully!');
    }

    /******************** ADMIN BlOOD-GROUP - MANAGEMENT *****************************/
    public function add_blood_group()
    {
        return view('admin.add_blood_group');
    }

    public function store_blood_group(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $data = new Group();
        $data->admin_id=Auth::user()->id;
        $data['name']=$request->name;
        // dd($data);
        $data->save();
        return redirect('admin/all-blood-groups/')->with('success','Blood Group Created Successfully!');
    }

    public function all_blood_groups()
     {
         $blood_groups = Group::all();
         return view('admin.blood_groups.index', compact('blood_groups'));
     }

     public function edit_blood_group($id)
    {
        $blood_group = Group::findOrFail($id);
        return view('admin.blood_groups.edit', compact('blood_group'));
    }

    public function update_blood_group(Request $request, $id)
    {
        $blood_group = Group::findOrFail($id);
         $constraints = [
            'name' => 'required',
         ];
        $input = [
            'name' => $request['name'],
        ];
        $this->validate($request, $constraints);
        Group::where('id', $id)
            ->update($input);
        return redirect('admin/all-blood-groups/')
            ->with('success', 'Blood Group updated successfully');
    }

    public function delete_blood_group($id)
     {
         $blood_group = Group::findOrFail($id);
         $blood_group->delete();
         return redirect('admin/all-blood-groups/')->with('success','Blood Group deleted Successfully!');
     }

     /******************** ADMIN STAFF - MANAGEMENT *****************************/
    public function all_staff ()
    {
        $staffs = Staff::whereNotNull('bank_id')->get();
        return view('admin.staff.index', compact('staffs'));
    }

    public function create_staff()
    {
        $banks =Bank::all();
        return view('admin.staff.index',compact('banks'));
    }

    public function store_staff(Request $request)
    {
        $request->validate([
            'bank_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:staff'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Staff::create([
            'bank_id' => $request['bank_id'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        // dd($request);
       return redirect()->intended('/admin/all-staff')->with('success','Staff Created Successfully!');
    }

    public function all_unassigned_staff()
    {
        $staffs = Staff::whereNull('bank_id')->get();
        return view('admin.all_unassigned_staff', compact('staffs'));
    }
    public function assign_bank($id)
    {
        $banks =Bank::all();
        $staff = Staff::findOrFail($id);
        return view('admin.assign_bank', compact('banks','staff'));
    }

    public function save_assigned_bank(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        $constraints = [
            'bank_id' => 'required|max:255',
        ];
        $input = [
            'bank_id' => $request['bank_id'],
        ];
        $this->validate($request, $constraints);
        Staff::where('id', $id)
            ->update($input);
        return redirect()->route('admin.staff.index')->withMessage('Staff Assigned Bank successfully!');
    }

    public function edit_staff($id)
    {
        $banks =Bank::all();
        $staff = Staff::findOrFail($id);
        return view('admin.staff.edit', compact('banks','staff'));
    }

    public function update_staff(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        $constraints = [
            'bank_id' => 'required|max:255',
            'name' => 'required|max:255',
            'email'=> 'required|max:255',
        ];
    $input = [
        'bank_id' => $request['bank_id'],
        'name' => $request['name'],
        'email' => $request['email'],
    ];
    $this->validate($request, $constraints);
    Staff::where('id', $id)
        ->update($input);
        return redirect('/admin/all-staff')->with('success','Staff Updated Successfully!');
    }

    public function delete_staff($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect('/admin/all-staff')->with('success','Staff Deleted Successfully!');

    }

    /******************** ADMIN DONOR - MANAGEMENT *****************************/
    public function all_donors(Request $request)
    {
        $users = User::all();
        return view('admin.donors.index', compact('users'));
    }

    public function search_donor(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate   = $request->input('toDate');

        $users = DB::table('users')->select()
            ->where('created_at', '>=', $fromDate)
            ->where('created_at', '<=', $toDate)
            ->get();
        return view('admin.donors.index', compact('users'));
    }

    public function edit_donor($id)
    {
        $user = User::findOrFail($id);
        $blood_groups = Group::all();
        return view('admin.donors.edit', compact('user','blood_groups'));
    }

    public function update_donor(Request $request, $id)
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

        return redirect('/admin/all-donors')->with('success','Donor Updated Successfully!');
    }

    public function delete_donor($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/all-donors')->with('success','Donor Deleted Successfully!');
    }

    /******************** ADMIN DONATION - MANAGEMENT *****************************/
    public function all_donations()
    {
        $donations = Donation::all();
        return view('admin.donations.index', compact('donations'));
    }

    /******************** ADMIN STOCK- MANAGEMENT *****************************/
    public function banks_stock()
    {
        $banks = Bank::all();
        return view('admin.stock.index',compact('banks'));
    }

    public function bank_stock($id)
    {
        $blood_groups = Group::all();
        $blood = Blood::get()->where('bank_id',$id)->whereNull('issued_at')->whereNull('discarded_at');
        $platelets = Platelet::get()->where('bank_id',$id)->whereNull('issued_at')->whereNull('discarded_at');
        $plasma = Plasma::get()->where('bank_id',$id)->whereNull('issued_at')->whereNull('discarded_at');
        $rbcs = Rbc::get()->where('bank_id',$id)->whereNull('issued_at')->whereNull('discarded_at');
        return view('admin.stock.show',compact('blood_groups','blood','platelets','plasma','rbcs'));
    }

    public function blood()
    {
        $bloods = Blood::whereNull('issued_at')->whereNull('discarded_at')->get();
        return view('admin.stock.blood',compact('bloods'));
    }

    public function plasma()
    {
        $plasma = Plasma::whereNull('issued_at')->whereNull('discarded_at')->get();
        return view('admin.stock.plasma',compact('plasma'));
    }

    public function platelets()
    {
        $platelets = Platelet::whereNull('issued_at')->whereNull('discarded_at')->get();
        return view('admin.stock.platelets',compact('platelets'));
    }

    public function rbc()
    {
        $rbc = Rbc::whereNull('issued_at')->whereNull('discarded_at')->get();
        return view('admin.stock.rbc',compact('rbc'));
    }

    public function issued_blood()
    {
        $blood = IssuedBlood::all();
        return view('admin.stock.issued_blood',compact('blood'));
    }

    public function issued_plasma()
    {
        $plasma = IssuedPlasma::all();
        return view('admin.stock.issued_plasma',compact('plasma'));
    }

    public function issued_platelets()
    {
        $platelets = IssuedPlatelet::all();
        return view('admin.stock.issued_platelets',compact('platelets'));
    }

    public function issued_rbc()
    {
        $rbc = IssuedRbc::all();
        return view('admin.stock.issued_rbc',compact('rbc'));
    }

    public function discarded_blood()
    {
        $blood  = DiscardedBlood::all();
        return view('admin.stock.discarded_blood',compact('blood'));
    }

    public function discarded_plasma()
    {
        $plasma = DiscardedPlasma::all();
        return view('admin.stock.discarded_plasma',compact('plasma'));
    }

    public function discarded_platelets()
    {
        $platelets = DiscardedPlatelet::all();
        return view('admin.stock.discarded_platelets',compact('platelets'));
    }

    public function discarded_rbc()
    {
        $rbc = DiscardedRbc::all();
        return view('admin.stock.discarded_rbc',compact('rbc'));
    }


    /******************** ADMIN DRIVES- MANAGEMENT *****************************/
    public function unapproved_drives()
    {
        $unapproved_drives = Drive::whereNull('approved_at')->get();
        $approved_drives = Drive::whereNotNull('approved_at')->get();
        return view('admin.drives.unapproved', compact('unapproved_drives','approved_drives'));
    }
    public function approve_drive($id)
    {
        $unapproved_drive = Drive::findOrFail($id);

        $admin_id=Auth::user()->id;
        $approved_at = Carbon::now();

        $input = [
            'admin_id' => $admin_id,
            'approved_at' => $approved_at,
        ];

        // dd($input);
        Drive::where('id', $id)
            ->update($input);

        $donors = User::all();
        foreach ($donors as $donor) {
            $donor->notify(new DonorNewDriveNotification($unapproved_drive));
        }
        return redirect('admin/unapproved-drives')->withMessage('Drive Approved successfully!');
    }

    /******************** ADMIN REPORTS- MANAGEMENT *****************************/
    public function donors_pdf(Request $request)
    {
        $users = User::all();
        $pdf = PDF::loadView('reports.donors', compact('users'));
        return $pdf->stream();
    }
    public function staff_pdf(Request $request)
    {
        $staff = Staff::all();
        $pdf = PDF::loadView('reports.staff', compact('staff'));
        return $pdf->stream();
    }
    public function donations_pdf()
    {
        $donations = Donation::all();
        $pdf = PDF::loadView('reports.donations', compact('donations'));
        return $pdf->stream();
    }
    public function blood_pdf(Request $request)
    {
        $blood = Blood::whereNull('issued_at')->whereNull('discarded_at')->get();
        $pdf = PDF::loadView('reports.blood', compact('blood'));
        return $pdf->stream();
    }
    public function plasma_pdf(Request $request)
    {
        $plasma = Plasma::whereNull('issued_at')->whereNull('discarded_at')->get();
        $pdf = PDF::loadView('reports.plasma', compact('plasma'));
        return $pdf->stream();
    }
    public function platelets_pdf(Request $request)
    {
        $platelets = Platelet::whereNull('issued_at')->whereNull('discarded_at')->get();
        $pdf = PDF::loadView('reports.platelets', compact('platelets'));
        return $pdf->stream();
    }
    public function rbc_pdf(Request $request)
    {
        $rbc = Rbc::whereNull('issued_at')->whereNull('discarded_at')->get();
        $pdf = PDF::loadView('reports.rbc', compact('rbc'));
        return $pdf->stream();
    }
     public function issued_plasma_pdf(Request $request)
    {
        $plasma = IssuedPlasma::all();
        $pdf = PDF::loadView('reports.issued_plasma', compact('plasma'));
        return $pdf->stream();
    }
    public function issued_platelets_pdf(Request $request)
    {
        $platelets = IssuedPlatelet::all();
        $pdf = PDF::loadView('reports.issued_platelets', compact('platelets'));
        return $pdf->stream();
    }
    public function issued_rbc_pdf(Request $request)
    {
        $rbc = IssuedRbc::all();
        $pdf = PDF::loadView('reports.issued_rbc', compact('rbc'));
        return $pdf->stream();
    }
    public function issued_blood_pdf(Request $request)
    {
        $blood = IssuedBlood::all();
        $pdf = PDF::loadView('reports.issued_blood', compact('blood'));
        return $pdf->stream();
    }
    public function discarded_plasma_pdf(Request $request)
    {
        $plasma = DiscardedPlasma::all();
        $pdf = PDF::loadView('reports.discarded_plasma', compact('plasma'));
        return $pdf->stream();
    }
    public function discarded_platelets_pdf(Request $request)
    {
        $platelets = DiscardedPlatelet::all();
        $pdf = PDF::loadView('reports.discarded_platelets', compact('platelets'));
        return $pdf->stream();
    }
    public function discarded_rbc_pdf(Request $request)
    {
        $rbc = DiscardedRbc::all();
        $pdf = PDF::loadView('reports.discarded_rbc', compact('rbc'));
        return $pdf->stream();
    }
    public function discarded_blood_pdf(Request $request)
    {
        $blood = DiscardedBlood::all();
        $pdf = PDF::loadView('reports.discarded_blood', compact('blood'));
        return $pdf->stream();
    }

    /******************** ADMIN CHARTS- MANAGEMENT *****************************/
    public function donors_charts()
    {
        $chart_options = [
            'chart_title' => 'Donors registered by Month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Donors by Blood Group',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'group_by_field' => 'blood_group',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            // 'filter_period' => 'year',
        ];

        $chart2 = new LaravelChart($chart_options);

        return view('admin.charts.donors', compact('chart1', 'chart2'));
    }

    public function staff_charts()
    {
        $chart_options = [
            'chart_title' => 'Staff registered by Month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Staff',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Staff by banks',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Staff',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.staff', compact('chart1', 'chart2', 'banks'));
    }

    public function donations_charts()
    {
        $chart_options = [
            'chart_title' => 'Donations collected by Month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Donation',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Donations collected by banks',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Donation',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            // 'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.donations', compact('chart1', 'chart2', 'banks'));
    }

    public function blood_charts()
    {
        $chart_options = [
            'chart_title' => 'Blood IN by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Blood',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Blood IN by Bank',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Blood',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'year',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.blood', compact('chart1', 'chart2', 'banks'));
    }

    public function plasma_charts()
    {
        $chart_options = [
            'chart_title' => 'Plasma IN by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Plasma',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Plasma IN by Bank',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Plasma',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'year',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.plasma', compact('chart1', 'chart2', 'banks'));
    }

    public function platelets_charts()
    {
        $chart_options = [
            'chart_title' => 'Platelet IN by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Platelet',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Platelet IN by Bank',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Platelet',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.platelets', compact('chart1', 'chart2', 'banks'));
    }

    public function rbc_charts()
    {
        $chart_options = [
            'chart_title' => 'RBC IN by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Rbc',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'RBC IN by Bank',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Rbc',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.rbc', compact('chart1', 'chart2', 'banks'));
    }

    public function issued_plasma_charts()
    {
        $chart_options = [
            'chart_title' => 'Plasma Bags Issued by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\IssuedPlasma',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Issued Plasma Bags by Hospital',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\IssuedPlasma',
            'group_by_field' => 'hospital_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $hospitals = Hospital::all();

        return view('admin.charts.issued_plasma', compact('chart1', 'chart2', 'hospitals'));
    }

    public function issued_platelets_charts()
    {
        $chart_options = [
            'chart_title' => 'Issued Platelet Bags by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\IssuedPlatelet',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Issued Platelet Bags by Hospital',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\IssuedPlatelet',
            'group_by_field' => 'hospital_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $hospitals = Hospital::all();

        return view('admin.charts.issued_platelets', compact('chart1', 'chart2', 'hospitals'));
    }

    public function issued_rbc_charts()
    {
        $chart_options = [
            'chart_title' => 'Issued RBC Bags by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\IssuedRbc',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Issued RBC by Hospital',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\IssuedRbc',
            'group_by_field' => 'hospital_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $hospitals = Hospital::all();

        return view('admin.charts.issued_rbc', compact('chart1', 'chart2', 'hospitals'));
    }

    public function issued_blood_charts()
    {
        $chart_options = [
            'chart_title' => 'Issued Blood Bags by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\IssuedBlood',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Issued Blood by Hospital',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\IssuedBlood',
            'group_by_field' => 'hospital_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $hospitals = Hospital::all();

        return view('admin.charts.issued_blood', compact('chart1', 'chart2','hospitals'));
    }

    public function discarded_plasma_charts()
    {
        $chart_options = [
            'chart_title' => 'Plasma Discarded months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\DiscardedPlasma',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Discarded Plasma by Bank',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\DiscardedPlasma',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.discarded_plasma', compact('chart1', 'chart2', 'banks'));
    }

    public function discarded_platelets_charts()
    {
        $chart_options = [
            'chart_title' => 'Discarded Platelet Bags by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\DiscardedPlatelet',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Discarded Platelet by Bank',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\DiscardedPlatelet',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.discarded_platelets', compact('chart1', 'chart2', 'banks'));
    }

    public function discarded_rbc_charts()
    {
        $chart_options = [
            'chart_title' => 'Discarded RBC Bags by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\DiscardedRbc',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Discarded RBC by Bank',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\DiscardedRbc',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.discarded_rbc', compact('chart1', 'chart2', 'banks'));
    }

    public function discarded_blood_charts()
    {
        $chart_options = [
            'chart_title' => 'Discarded Blood Bags by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\DiscardedBlood',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Discarded Blood by Bank',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\DiscardedBlood',
            'group_by_field' => 'bank_id',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart2 = new LaravelChart($chart_options);
        $banks = Bank::all();

        return view('admin.charts.discarded_blood', compact('chart1', 'chart2', 'banks'));
    }

    public function statistics()
    {
        $chart = LarapexChart::setTitle('Users')
            ->setDataset([HospitalRequest::where('id', '<=', 10)->count(), User::where('id', '>', 5)->count()])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setLabels(['HospitalRequest', 'User']);
        return view('chart', compact('chart'));
    }

    /********************ADMIN BBMS-SITE - MANAGEMENT *****************************/
    public function faqs()
    {
        $faqs = Faq::all();
        return view('admin.site.faq.index', compact('faqs'));
    }

    public function store_faq(Request $request)
    {
        $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:255'],
        ]);

        Faq::create([
            'question' => $request['question'],
            'answer' => $request['answer'],
        ]);
        return redirect('admin/faqs/')->with('success','Faq Created Successfully!');
    }

    public function update_faq_status(Request $request)
    {
        $faq = Faq::find($request->faq_id);
        $faq->status = $request->status;
        $faq->save();

        return response()->json(['success'=>'Status changed successfully!']);
    }

    public function edit_about()
    {
        $about = About::find(1);
        return view('admin.site.about.index', compact('about'));
    }

    public function update_about(Request $request)
    {
         $constraints = [
            'history' => 'required',
         ];
        $input = [
            'history' => $request['history'],
            'vision' => $request['vision'],
            'mission' => $request['mission'],
            'values' => $request['values'],
            'objectives' => $request['objectives'],
        ];
        $this->validate($request, $constraints);
        About::find(1)
            ->update($input);
        return redirect('admin/about/')->with('success', 'About updated successfully!');
    }
}
