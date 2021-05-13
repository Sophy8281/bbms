<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\UsersExport;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Donation;

class ViewController extends Controller
{
    public function test()
    {
        // $donations = Donation::select('bag_serial_number','group_id')->distinct('group_id')->get();
        $donations = Donation::all()->unique('group_id');
        return view('test', compact('donations'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $method = $req->method();

        if ($req->isMethod('post'))
        {
            $from = $req->input('from');
            $to   = $req->input('to');
            if ($req->has('search'))
            {
                // select search
                $search = DB::select("SELECT * FROM users WHERE created_at BETWEEN '$from' AND '$to'");
                return view('reports.users',['ViewsPage' => $search]);
            }
            elseif ($req->has('exportPDF'))
            {
                // select PDF
                $PDFReport = DB::select("SELECT * FROM users WHERE created_at BETWEEN '$from' AND '$to'");
                $pdf = PDF::loadView('reports.PDF_report', ['PDFReport' => $PDFReport])->setPaper('a4', 'landscape');
                return $pdf->download('PDF-report.pdf');


            }


                elseif($req->has('exportExcel'))

                // select Excel
                return Excel::download(new UsersExport($from, $to), 'Excel-reports.xlsx');
            {
        }
        }
            else
        {
            //select all
            $ViewsPage = DB::select('SELECT * FROM users');
            return view('reports.users',['ViewsPage' => $ViewsPage]);
        }
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
