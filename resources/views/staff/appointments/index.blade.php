@extends('layouts.staff_dashboard')
@section('breadcrumb')
Appointments
@endsection
@section('content')
@include('flash-message')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">

                <div class="card">
                    <div class="card-header bg-warning text-light">Pending Appointments</div>

                    <div class="card-body">
                    <table class="table table-responsive table-hover">
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Bank</th>
                                <th>Group</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($pending_appointments as $pending_appointment)
                                <tr>
                                    <td>{{ $pending_appointment->id }}</td>
                                    <td>{{ $pending_appointment->name }}</td>
                                    <td>{{ $pending_appointment->email }}</td>
                                    <td>{{ $pending_appointment->phone }}</td>
                                    <td>{{ $pending_appointment->date }}</td>
                                    <td>{{ $pending_appointment->bank->name }}</td>
                                    <td>{{ $pending_appointment->group->name }}</td>
                                    <td>
                                        <a href="{{ url('staff/appointment/mark/'.$pending_appointment->id) }}" class="">Mark as Done</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Appointments Made.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md">

                <div class="card">
                    <div class="card-header bg-primary text-light">Done Appointments</div>

                    <div class="card-body">

                        {{-- @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif --}}

                        <table class="table">
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Bank</th>
                                <th>Group</th>
                                <th>Staff</th>
                                <th>Done_at</th>
                            </tr>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->name }}</td>
                                    <td>{{ $appointment->email }}</td>
                                    <td>{{ $appointment->phone }}</td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->bank->name }}</td>
                                    <td>{{ $appointment->group->name }}</td>
                                    <td>{{ $appointment->staff->name }}</td>
                                    <td>{{ $appointment->done_at }}</td>
                                    {{-- <td>
                                        <a href="{{ url('staff/appointment/mark/'.$pending_appointment->id) }}" class="">Mark as Done</a>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Appointments Done.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
