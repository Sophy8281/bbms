@extends('layouts.staff_dashboard')

@section('content')
@include('flash-message')

{{-- <div>
    <a href="{{ URL::to('staff/platelets/add')  }}" class="btn btn-success">
        <i class="fa fa-plus-square"></i>   Store Platelets</a>
</div> --}}
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Platelets in Stock</div>
    <div class="panel-body">

        <table class="table">

            <tr>
                <th>#Id</th>
                <th>Bank ID</th>
                <th>Staff ID</th>
                <th>Agitator</th>
                <th>Bag Serial No.</th>
                <th>Blood Group</th>
                <th>Donation Date</th>
                <th>Expiry Date</th>
                <th>Days Remaining</th>


            </tr>

            @forelse($platelets as $platelet)
            <tr>
                <td>{{ $platelet->id }}</td>
                <td>{{ $platelet->bank->name }}</td>
                <td>{{ $platelet->staff->name }}</td>
                <td>{{ $platelet->agitator->name}}</td>
                <td>{{ $platelet->bag_serial_number }}</td>
                <td>{{ $platelet->blood_group->name }}</td>
                <td>{{ $platelet->donation_date }}</td>
                <td>{{ $platelet->expiry_date }}</td>
                @if ($platelet->expiry_date == Carbon\Carbon::today()|$platelet->expiry_date < Carbon\Carbon::today())
                    <td>
                        <a href="" class="btn btn-warning"> EXPIRED</a>
                    </td>
                @else
                    {{-- <td>Safe</td> --}}
                    <td>{{ Carbon\Carbon::create($platelet->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="4">No Platelets found.</td>
            </tr>
        @endforelse
        </table>

    </div>

</div>

@stop
