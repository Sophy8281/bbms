<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\User;
use App\Models\Plasma;
use App\Models\Platelet;
use App\Models\Rbc;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Users by names',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'group_by_field' => 'name',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month', // show users only registered this month
        ];

        $chart2 = new LaravelChart($chart_options);

        // $chart_options = [
        //     'chart_title' => 'Transactions by dates',
        //     'report_type' => 'group_by_date',
        //     'model' => 'App\Transaction',
        //     'group_by_field' => 'transaction_date',
        //     'group_by_period' => 'day',
        //     'aggregate_function' => 'sum',
        //     'aggregate_field' => 'amount',
        //     'chart_type' => 'line',
        // ];

        // $chart3 = new LaravelChart($chart_options);

        // return view('charts.users', compact('chart1', 'chart2', 'chart3'));
        return view('charts.users', compact('chart1', 'chart2'));
    }

    public function plasma_charts()
    {
        $chart_options = [
            'chart_title' => 'Plasma by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Plasma',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Plasma by Bag SNos.',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Plasma',
            'group_by_field' => 'bag_serial_number',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month', // show users only registered this month
        ];

        $chart2 = new LaravelChart($chart_options);

        return view('admin.charts.plasma', compact('chart1', 'chart2'));
    }

    public function platelets_charts()
    {
        $chart_options = [
            'chart_title' => 'Platelet by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Platelet',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Platelet by Bag SNos.',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Platelet',
            'group_by_field' => 'bag_serial_number',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month', // show users only registered this month
        ];

        $chart2 = new LaravelChart($chart_options);

        return view('admin.charts.platelets', compact('chart1', 'chart2'));
    }

    public function rbc_charts()
    {
        $chart_options = [
            'chart_title' => 'RBC by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Rbc',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'RBC by Bag SNos.',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Rbc',
            'group_by_field' => 'bag_serial_number',
            'chart_type' => 'pie',
            'chart_height' => '100px',
            'filter_field' => 'created_at',
            'filter_period' => 'month', // show users only registered this month
        ];

        $chart2 = new LaravelChart($chart_options);

        return view('admin.charts.rbc', compact('chart1', 'chart2'));
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
        //
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
        //
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
