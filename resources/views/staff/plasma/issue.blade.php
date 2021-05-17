@extends('layouts.staff_dashboard')
@section('breadcrumb')
Issue Plasma
@endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading"><h5>Issue Plasma Bag</h5></div>
    <div class="panel-body">

        <form action="{{ url('staff/plasma/issue/'.$plasma->id) }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                Bag Serial No.
                <p class="hint--top" data-hint="Bag Serial No." id="input-field">

                    <input type="text" name="bag_serial_number" class="form-control @error('bag_serial_number') is-invalid @enderror" value="{{ $plasma->bag_serial_number }}" readonly>
                    @error('bag_serial_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Blood Group
                <p class="hint--top" data-hint="Blood Group" id="input-field">

                    <input type="text" name="group_id" class="form-control @error('group_id') is-invalid @enderror" value="{{ $plasma->group->name }}" readonly>
                    @error('group_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            @if(count($hospitals) > 0)
            <div class="form-group">
                Hospital
                <p class="hint--top" data-hint="Hospital" id="input-field">
                    <select  id="hospital_id" type="text"  name="hospital_id" class="form-control @error('hospital_id') is-invalid @enderror" required>
                        @foreach ($hospitals as $hospital)
                            <option value="{{ $hospital->hospital_id }}">{{ $hospital->hospital->name }}</option>
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
            @else
            <p class="bg-warning p-3 text-center">There are no requests for plasma with blood group {{ $plasma->group->name }}</p>
            @endif
            <a href="{{ url('staff/all-freezers') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
@stop
