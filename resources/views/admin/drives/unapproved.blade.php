@extends('layouts.admin_dashboard')
@section('breadcrumb')
Unapproved Drives
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header bg-warning text-light">Drives Awaiting Approval</div>
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table table-responsive table-hover">
                            <tr>
                                <th>#Id</th>
                                <th>Bank</th>
                                <th>Staff</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th></th>
                                <th>Action</th>
                            </tr>
                            @forelse ($unapproved_drives as $unapproved_drive)
                                <tr>
                                    <td>{{ $unapproved_drive->id }}</td>
                                    <td>{{ $unapproved_drive->bank->name }}</td>
                                    <td>{{ $unapproved_drive->staff->name }}</td>
                                    <td>{{ $unapproved_drive->location }}</td>
                                    <td>{{ $unapproved_drive->date }}</td>
                                    <td>{{ $unapproved_drive->time }}</td>
                                    <td>{{ $unapproved_drive->created_at->diffForHumans() }}</td>
                                    <td><a href="{{ url('admin/drive/approve', $unapproved_drive->id) }}"
                                           class="btn btn-primary btn-sm">Approve</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No drives found.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
