@extends('layouts.admin_dashboard')
@section('breadcrumb')
Donors
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Donor Analysis</div>

            <div class="card-body">

                <h2>{{ $chart1->options['chart_title'] }}</h2>
                    {!! $chart1->renderHtml() !!}

                {{-- <hr />

                <h1>{{ $chart2->options['chart_title'] }}</h1>
                {!! $chart2->renderHtml() !!} --}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Donor Analysis</div>

            <div class="card-body">

                {{-- <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}

                <hr /> --}}

                <h2>{{ $chart2->options['chart_title'] }}</h2>
                {!! $chart2->renderHtml() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
{!! $chart1->renderChartJsLibrary() !!}

{!! $chart1->renderJs() !!}
{!! $chart2->renderJs() !!}
@endsection
