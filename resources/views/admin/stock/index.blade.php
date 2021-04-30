@extends('layouts.admin_dashboard')
@section('breadcrumb')
Banks Stock
@endsection
@section('content')
@include('flash-message')

 <h3>Bag Count in Blood Banks
    <a class="btn btn-primary" href="{{ url('admin') }}" title="Go back">
        <i class="fas fa-backward"> Back</i>
    </a>
 </h3>
    <div class="panel-body">

            <div class="row">
                @forelse($banks as $bank)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                <a href="{{ url('admin/stock/show/'.$bank->id) }}">{{ $bank->name }}</a>
                            </div>
                            <div class="card-body">

                                <p>Platelets COUNT: {{ $bank->platelets->count() }}</p>
                                <p>Plasma COUNT: {{ $bank->plasma->count() }}</p>
                                <p>Red Blood Cells COUNT: {{ $bank->rbc->count() }}</p>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md">
                        No Banks found.
                    </div>
                @endforelse
            </div>

</div>

@stop
