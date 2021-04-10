@extends('layouts.staff_dashboard')

@section('content')
@include('flash-message')

{{-- <div>
    <a href="{{ URL::to('staff/add-agitator')  }}" class="btn btn-success">
        <i class="fa fa-plus-square"></i>   New Agitator</a>
</div> --}}
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Red Blood Cells</div>
    <div class="panel-body">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('staff/all-refrigerators') }}" title="Go back"> <i
          class="fas fa-backward"> Back</i> </a>
       </div>
        <table class="table">

            <tr>
                <th>#Id</th>
                <th>Bank</th>
                <th>Staff</th>
                <th>Refrigerator</th>
                <th>Bag Serial No.</th>
                <th>Blood Group</th>
                <th>Donation Date</th>
                <th>Expiry Date</th>
                <th>Days Remaining</th>
                <th>Actions</th>

            </tr>

            @forelse($rbcs as $rbc)
            <tr>
                <td>{{ $rbc->id }}</td>
                <td>{{ $rbc->bank->name }}</td>
                <td>{{ $rbc->staff->name }}</td>
                <td>{{ $rbc->refrigerator->name}}</td>
                <td>{{ $rbc->bag_serial_number }}</td>
                <td>{{ $rbc->group->name }}</td>
                <td>{{ $rbc->donation_date }}</td>
                <td>{{ $rbc->expiry_date }}</td>
                @if ($rbc->expiry_date == Carbon\Carbon::today()|$rbc->expiry_date < Carbon\Carbon::today())
                    <td>
                        <a href="" class="btn btn-warning">EXPIRED</a>
                    </td>
                    <td>
                        <a href="{{ url('staff/rbc/discard/'.$rbc->id) }}" class="btn btn-danger">Discard</a>
                    </td>
                @else
                    <td>{{ Carbon\Carbon::create($rbc->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>
                    <td>
                        <a href="{{ url('staff/rbc/issue/'.$rbc->id) }}" class="btn btn-success">Issue</a>
                    </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="4">There are no red blood cells bags in this regrigerator.</td>
            </tr>
        @endforelse
        </table>

        {{-- {{ $rbcs->render() }} --}}

    </div>

</div>

@stop
