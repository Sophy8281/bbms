@extends('layouts.admin_dashboard')
@section('breadcrumb')
Bank Stock
@endsection
@section('content')
@include('flash-message')

<h3>Bank Stock
    <a class="btn btn-primary" href="{{ url('admin/stock') }}" title="Go back">
        <i class="fas fa-backward"> Back</i>
    </a>
</h3>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-header bg-primary text-light">Whole Blood</div>
            <div class="card-body">


                <table class="table table-responsive table-hover">

                    <tr>
                        <th>#Id</th>
                        <th>Bank</th>
                        <th>Stored By</th>
                        <th>Bag Serial No.</th>
                        <th>Blood Group</th>
                        <th>Donation Date</th>
                        <th>Expiry Date</th>
                        <th>Days Remaining</th>
                    </tr>

                    @forelse($blood as $blood)
                    <tr>
                        <td>{{ $blood->id }}</td>
                        <td>{{ $blood->bank->name }}</td>
                        <td>{{ $blood->staff->name }}</td>
                        <td>{{ $blood->bag_serial_number }}</td>
                        <td>{{ $blood->group->name }}</td>
                        <td>{{ $blood->donation_date }}</td>
                        <td>{{ $blood->expiry_date }}</td>
                        @if ($blood->expiry_date == Carbon\Carbon::today()|$blood->expiry_date < Carbon\Carbon::today())
                            <td>
                                <a href="" class="btn btn-warning"> EXPIRED</a>
                            </td>

                        @else
                            <td>{{ Carbon\Carbon::create($blood->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>


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
    </div>
</div>

<div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-light">Platelets</div>
                <div class="card-body">


                    <table class="table table-responsive table-hover">

                        <tr>
                            <th>#Id</th>
                            <th>Bank</th>
                            <th>Stored By</th>
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
                            <td>{{ $platelet->group->name }}</td>
                            <td>{{ $platelet->donation_date }}</td>
                            <td>{{ $platelet->expiry_date }}</td>
                            @if ($platelet->expiry_date == Carbon\Carbon::today()|$platelet->expiry_date < Carbon\Carbon::today())
                                <td>
                                    <a href="" class="btn btn-warning"> EXPIRED</a>
                                </td>

                            @else
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
        </div>
</div>
<div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-light">Plasma</div>
                <div class="card-body">

                    <table class="table table-responsive table-hover">

                        <tr>
                            <th>#Id</th>
                            <th>Bank</th>
                            <th>Stored By</th>
                            <th>Freezer</th>
                            <th>Bag Serial No.</th>
                            <th>Blood Group</th>
                            <th>Donation Date</th>
                            <th>Expiry Date</th>
                            <th>Days Remaining</th>
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

                                @else
                                <td>{{ Carbon\Carbon::create($plasma->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>

                            @endif
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4">No Plasma found.</td>
                        </tr>
                    @endforelse
                    </table>

                </div>
            </div>
        </div>
</div>
<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-header bg-primary text-light">Red Blood cells</div>
            <div class="card-body">

                <table class="table table-responsive table-hover">

                    <tr>
                        <th>#Id</th>
                        <th>Bank</th>
                        <th>Stored By</th>
                        <th>Refrigerator</th>
                        <th>Bag Serial No.</th>
                        <th>Blood Group</th>
                        <th>Donation Date</th>
                        <th>Expiry Date</th>
                        <th>Days Remaining</th>


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

                        @else
                            <td>{{ Carbon\Carbon::create($rbc->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>

                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No Red Blood Cells found.</td>
                    </tr>
                @endforelse
                </table>

            </div>
        </div>
    </div>
</div>

</div>

@stop
