@extends('layouts.staff_dashboard')
@section('breadcrumb')
Cold Room
@endsection
@section('content')
@include('flash-message')
<div class="panel panel-default">
    <div class="panel-heading"><h5>Whole Blood in Stock </h5></div>
    <div class="panel-body">
        <div class="col-md">
            <table id="example" class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Donation Id</th>
                        <th>Bank</th>
                        <th>Staff</th>
                        <th>Bag Serial No.</th>
                        <th>B_Group</th>
                        <th>Donation Date</th>
                        <th>Expiry</th>
                        <th>Days Remaining</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($blood as $blood)
                    <tr>
                        <td>{{ $blood->id }}</td>
                        <td>{{ $blood->donation_id }}</td>
                        <td>{{ $blood->bank->name }}</td>
                        <td>{{ $blood->staff->name }}</td>
                        <td>{{ $blood->bag_serial_number }}</td>
                        <td>{{ $blood->group->name }}</td>
                        <td>{{ date('F d, Y', strtotime($blood->donation_date)) }}</td>
                        <td>{{ date('F d, Y', strtotime($blood->expiry_date)) }}</td>
                        @if ($blood->expiry_date == Carbon\Carbon::today()|$blood->expiry_date < Carbon\Carbon::today())
                        <td>
                            <a href="" class="btn btn-warning"> EXPIRED</a>
                        </td>
                        <td>
                            <a href="{{ url('staff/blood/discard/'.$blood->id) }}" class="btn btn-warning"> Discard</a>
                        </td>
                    @else
                        <td>{{ Carbon\Carbon::create($blood->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>
                        <td>
                            <a href="{{ url('staff/blood/issue/'.$blood->id) }}" class="btn btn-success"> Issue</a>
                        </td>

                    @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">No blood in cold room.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
