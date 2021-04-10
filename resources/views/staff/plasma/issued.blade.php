@extends('layouts.staff_dashboard')

@section('content')
@include('flash-message')

{{-- <div>
    <a href="{{ URL::to('staff/plasma/add')  }}" class="btn btn-success">
        <i class="fa fa-plus-square"></i>   Store Plasma</a>
</div> --}}
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Plasma Issued</div>
    <div class="panel-body">

        <table class="table">

            <tr>
                <th>#Id</th>
                <th>Plasma ID</th>
                <th>Bank ID</th>
                <th>Issued_By</th>
                <th>Freezer</th>
                <th>Bag Serial No.</th>
                <th>Blood Group</th>
                <th>Issued_To</th>

            </tr>

            @forelse($plasma as $plasma)
            <tr>
                <td>{{ $plasma->id }}</td>
                <td>{{ $plasma->plasma_id }}</td>
                <td>{{ $plasma->bank_id }}</td>
                <td>{{ $plasma->staff_id }}</td>
                <td>{{ $plasma->freezer->name}}</td>
                <td>{{ $plasma->bag_serial_number }}</td>
                <td>{{ $plasma->group_id }}</td>
                <td>{{ $plasma->hospital_id }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No Plasma bags Issued.</td>
            </tr>
        @endforelse
        </table>

    </div>

</div>

@stop
