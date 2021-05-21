@extends('layouts.admin_dashboard')
@section('breadcrumb')
Issued RBC
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Red Blood Cells Analysis</div>

            <div class="card-body">

                <h2>{{ $chart1->options['chart_title'] }}</h2>
                    {!! $chart1->renderHtml() !!}

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Red Blood Cells Analysis</div>

            <div class="card-body">

                <h2>{{ $chart2->options['chart_title'] }}</h2>

                <div class="row">

                    <div class="col-md-6">
                        <h3>Key</h3>
                        @foreach ($hospitals as $hospital)
                        {{$hospital->id}}-{{$hospital->name}}<br>
                        @endforeach
                    </div>

                    <div class="col-md-6">{!! $chart2->renderHtml() !!}</div>

                </div>
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
