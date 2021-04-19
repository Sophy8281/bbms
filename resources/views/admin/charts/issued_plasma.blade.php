@extends('layouts.admin_dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md">
        <div class="card">
            <div class="card-header">Plasma Charts</div>

            <div class="card-body">

                <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}

                <hr />

                <h1>{{ $chart2->options['chart_title'] }}</h1>
                <h3>Key</h3>
                @foreach ($hospitals as $hospital)
                {{$hospital->id}}-{{$hospital->name}}
                @endforeach
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
