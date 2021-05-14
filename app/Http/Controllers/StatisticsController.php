<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\HospitalRequest;
use App\Models\Platelet;
use App\Models\Plasma;
use App\Models\Blood;
use App\Models\Rbc;

class StatisticsController extends Controller
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

    public function blood_highchart()
    {
        $blood = Blood::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('donation_date', date('Y'))
                    ->groupBy(\DB::raw("Month(donation_date)"))
                    ->pluck('count');

        $blood_requests = HospitalRequest::select(\DB::raw("SUM(quantity) as count"))
                    ->where('product', '=', 'whole blood')
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

        return view('admin.statistics.blood_highchart',compact('blood','blood_requests'));
    }

    public function plasma_highchart()
    {
        $plasma = Plasma::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('donation_date', date('Y'))
                    ->groupBy(\DB::raw("Month(donation_date)"))
                    ->pluck('count');

        $plasma_requests = HospitalRequest::select(\DB::raw("SUM(quantity) as count"))
                    ->where('product', '=', 'plasma')
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

        return view('admin.statistics.plasma_highchart',compact('plasma','plasma_requests'));
    }

    public function platelets_highchart()
    {
        $platelets = Platelet::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('donation_date', date('Y'))
                    ->groupBy(\DB::raw("Month(donation_date)"))
                    ->pluck('count');

        $platelets_requests = HospitalRequest::select(\DB::raw("SUM(quantity) as count"))
                    ->where('product', '=', 'platelets')
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

        return view('admin.statistics.platelets_highchart',compact('platelets','platelets_requests'));
    }

    public function rbc_highchart()
    {
        $rbc = Rbc::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('donation_date', date('Y'))
                    ->groupBy(\DB::raw("Month(donation_date)"))
                    ->pluck('count');

        $rbc_requests = HospitalRequest::select(\DB::raw("SUM(quantity) as count"))
                    ->where('product', '=', 'red blood cells')
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

        return view('admin.statistics.rbc_highchart',compact('rbc','rbc_requests'));
    }
}
