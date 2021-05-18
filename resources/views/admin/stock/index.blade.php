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

                                <p>Whole Blood COUNT: {{ $bank->blood->whereNull('issued_at')->whereNull('discarded_at')->count() }}</p>
                                <p>Platelets COUNT: {{ $bank->platelets->whereNull('issued_at')->whereNull('discarded_at')->count() }}</p>
                                <p>Plasma COUNT: {{ $bank->plasma->whereNull('issued_at')->whereNull('discarded_at')->count() }}</p>
                                <p>Red Blood Cells COUNT: {{ $bank->rbc->whereNull('issued_at')->whereNull('discarded_at')->count() }}</p>

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
