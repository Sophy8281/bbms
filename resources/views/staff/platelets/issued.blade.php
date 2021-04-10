@extends('layouts.staff_dashboard')

@section('content')
@include('flash-message')

{{-- <div>
    <a href="{{ URL::to('staff/plasma/add')  }}" class="btn btn-success">
        <i class="fa fa-plus-square"></i>   Store Plasma</a>
</div> --}}
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Platelets Issued</div>
    <div class="panel-body">

        <table class="table">

            <tr>
                <th>#Id</th>
                <th>Platelet ID</th>
                <th>Bank ID</th>
                <th>Issued_By</th>
                <th>Agitator</th>
                <th>Bag Serial No.</th>
                <th>Blood Group</th>
                <th>Issued_To</th>

            </tr>

            @forelse($platelets as $platelet)
            <tr>
                <td>{{ $platelet->id }}</td>
                <td>{{ $platelet->platelet_id }}</td>
                <td>{{ $platelet->bank_id }}</td>
                <td>{{ $platelet->staff_id }}</td>
                <td>{{ $platelet->agitator->name}}</td>
                <td>{{ $platelet->bag_serial_number }}</td>
                <td>{{ $platelet->group_id }}</td>
                <td>{{ $platelet->hospital_id }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No Platelet Bags Issued.</td>
            </tr>
        @endforelse
        </table>

    </div>

</div>

@stop
