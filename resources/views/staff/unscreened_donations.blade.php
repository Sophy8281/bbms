@extends('layouts.staff_dashboard')

@section('content')
@include('flash-message')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header bg-warning text-light">unscreened Donations</div>

                    <div class="card-body">

                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

        <table class="table">

            <tr>
                <th>Donation ID</th>
                <th>Donor ID</th>
                <th>Bank ID</th>
                <th>Bag Serial No.</th>
                <th>Blood Group</th>
                <th>status</th>
            </tr>

            @forelse ($donations as $donation)
            <tr>
                <td>{{ $donation->id }}</td>
                <td>{{ $donation->donor->name }}</td>
                <td>{{ $donation->bank_id }}</td>
                <td>{{ $donation->bag_serial_number }}</td>
                <td> <a class="btn btn-success" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">{{ $donation->blood_group }}
                    <i class="fas fa-heart">Pending</i>
                    </a>
                </td>
                <td> <a class="btn btn-success" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">{{ $donation->status }}
                    <i class="fas fa-thumbs-up">Pending</i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No Unscreened Donations found.</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>
</div>
</div>
</div>
@endsection
