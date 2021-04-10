@extends('layouts.staff_dashboard')

@section('content')
@include('flash-message')

{{-- <div>
    <a href="{{ URL::to('staff/plasma/add')  }}" class="btn btn-success">
        <i class="fa fa-plus-square"></i>   Store Plasma</a>
</div> --}}
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Plasma in Stock</div>
    <div class="panel-body">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('staff/all-freezers') }}" title="Go back"> <i
          class="fas fa-backward"> Back</i> </a>
       </div>

        <table class="table">

            <tr>
                <th>#Id</th>
                <th>Bank</th>
                <th>Staff</th>
                <th>Freezer</th>
                <th>Bag Serial No.</th>
                <th>Blood Group</th>
                <th>Donation Date</th>
                <th>Expiry Date</th>
                <th>Days Remaining</th>
                <th>Actions</th>

            </tr>

            @forelse($plasma as $plasma)
            <tr>
                <td>{{ $plasma->id }}</td>
                <td>{{ $plasma->bank->name }}</td>
                <td>{{ $plasma->staff->name }}</td>
                <td>{{ $plasma->freezer->name}}</td>
                <td>{{ $plasma->bag_serial_number }}</td>
                <td>{{ $plasma->group->name }}</td>
                <td>{{ $plasma->donation_date }}</td>
                <td>{{ $plasma->expiry_date }}</td>
                @if ($plasma->expiry_date == Carbon\Carbon::today()|$plasma->expiry_date < Carbon\Carbon::today())
                    <td>
                        <a href="" class="btn btn-warning"> EXPIRED</a>
                    </td>
                    <td>
                        <a href="{{ url('staff/plasma/discard/'.$plasma->id) }}" class="btn btn-danger"> Discard</a>
                    </td>
                 @else
                    <td>{{ Carbon\Carbon::create($plasma->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>
                    <td>
                        <a href="{{ url('staff/plasma/issue/'.$plasma->id) }}" class="btn btn-success"> Issue</a>
                    </td>
                @endif
            </tr>

            @empty
            <tr>
                <td colspan="4">There are no plasma bags in this freezer.</td>
            </tr>
        @endforelse
        </table>
        {{-- {{ $plasma->render() }} --}}
        {{-- {{ $plasma->links() }} --}}

    </div>

</div>

@stop
