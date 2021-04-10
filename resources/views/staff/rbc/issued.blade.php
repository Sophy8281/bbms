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
                <th>Rbc ID</th>
                <th>Bank ID</th>
                <th>Issued_By</th>
                <th>Refrigerator</th>
                <th>Bag Serial No.</th>
                <th>Blood Group</th>
                <th>Issued_To</th>

            </tr>

            @forelse($rbcs as $rbc)
            <tr>
                <td>{{ $rbc->id }}</td>
                <td>{{ $rbc->rbc_id }}</td>
                <td>{{ $rbc->bank_id }}</td>
                <td>{{ $rbc->staff_id }}</td>
                <td>{{ $rbc->refrigerator->name}}</td>
                <td>{{ $rbc->bag_serial_number }}</td>
                <td>{{ $rbc->group_id }}</td>
                <td>{{ $rbc->hospital_id }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No Red Blood Cells Bags Issued.</td>
            </tr>
        @endforelse
        </table>

    </div>

</div>

@stop
