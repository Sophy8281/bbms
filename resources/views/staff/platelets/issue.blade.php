@extends('layouts.staff_dashboard')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">


        <i class="fa fa-ticket"></i> Issue Platelet Bag
    </div>
    <div class="panel-body">

        <form action="{{ url('staff/platelet/issue/'.$platelet->id) }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                Bag Serial No.
                <p class="hint--top" data-hint="Bag Serial No." id="input-field">

                    <input type="text" name="bag_serial_number" class="form-control @error('bag_serial_number') is-invalid @enderror" value="{{ $platelet->bag_serial_number }}" readonly>
                    @error('bag_serial_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Hospital
                <p class="hint--top" data-hint="Hospital" id="input-field">
                    <select  id="hospital_id" type="text"  name="hospital_id">
                        @foreach ($hospitals as $hospital)
                            <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                        @endforeach
                    </select>
                    @error('hospital_id')
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
