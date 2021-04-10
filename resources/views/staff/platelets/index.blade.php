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
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('staff/all-agitators') }}" title="Go back"> <i
          class="fas fa-backward"> Back</i> </a>
       </div>

        <table class="table">

            <tr>
                <th>#Id</th>
                <th>Bank</th>
                <th>Staff</th>
                <th>Agitator</th>
                <th>Bag Serial No.</th>
                <th>Blood Group</th>
                <th>Donation Date</th>
                <th>Expiry Date</th>
                <th>Days Remaining</th>
                <th>Actions</th>


            </tr>

            @forelse($platelets as $platelet)
            <tr>
                <td>{{ $platelet->id }}</td>
                <td>{{ $platelet->bank->name }}</td>
                <td>{{ $platelet->staff->name }}</td>
                <td>{{ $platelet->agitator->name}}</td>
                <td>{{ $platelet->bag_serial_number }}</td>
                <td>{{ $platelet->group->name }}</td>
                <td>{{ $platelet->donation_date }}</td>
                <td>{{ $platelet->expiry_date }}</td>
                @if ($platelet->expiry_date == Carbon\Carbon::today()|$platelet->expiry_date < Carbon\Carbon::today())
                    <td>
                        <a href="" class="btn btn-warning"> EXPIRED</a>
                    </td>
                    <td>
                        <a href="{{ url('staff/platelet/discard/'.$platelet->id) }}" class="btn btn-danger"> Discard</a>
                    </td>
                @else
                    <td>{{ Carbon\Carbon::create($platelet->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>
                    <td>
                        <a href="{{ url('staff/platelet/issue/'.$platelet->id) }}" class="btn btn-success"> Issue</a>
                    </td>

                @endif
            </tr>
            @empty
            <tr>
                <td colspan="4">There are no platelet bags in this agitator.</td>
            </tr>
        @endforelse
        </table>

    </div>

</div>

@stop
