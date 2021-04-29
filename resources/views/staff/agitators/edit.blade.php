@extends('layouts.staff_dashboard')
@section('breadcrumb')
Edit Agitator
@endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-ticket"></i> Edit Agitator
    </div>
    <div class="panel-body">

        <form action="{{ url('staff/agitator/edit/'.$agitator->id) }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                Name
                <p class="hint--top" data-hint="Name" id="input-field">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $agitator->name }}" placeholder="Name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Capacity
                <p class="hint--top" data-hint="Capacity" id="input-field">
                    <input type="text" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ $agitator->capacity }}" placeholder="Capacity">
                    @error('capacity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('staff/all-agitators') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
@stop
