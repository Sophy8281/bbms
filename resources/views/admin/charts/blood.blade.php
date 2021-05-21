@extends('layouts.admin_dashboard')
@section('breadcrumb')
Blood Charts
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Whole Blood Analysis</div>

            <div class="card-body">

                <h2>{{ $chart1->options['chart_title'] }}</h2>
                    {!! $chart1->renderHtml() !!}

                {{-- <hr />

                <h1>{{ $chart2->options['chart_title'] }}</h1>
                <h3>Key</h3>
                @foreach ($banks as $bank)
                {{$bank->id}}-{{$bank->name}}<br>
                @endforeach
                {!! $chart2->renderHtml() !!} --}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Whole Blood Analysis</div>

            <div class="card-body">

                <h2>{{ $chart2->options['chart_title'] }}</h2>
                <div class="row">

                    <div class="col-md-6">
                        <h3>Key</h3>
                        @foreach ($banks as $bank)
                        {{$bank->id}}-{{$bank->name}}<br>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        {!! $chart2->renderHtml() !!}
                    </div>

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
