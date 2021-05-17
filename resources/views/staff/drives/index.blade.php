@extends('layouts.staff_dashboard')
@section('breadcrumb')
Drives
@endsection
@section('content')
@include('flash-message')
<div class="container">
    {{-- <div class="row"> --}}
        <div>
            <a href="{{ URL::to('staff/drive/add') }}" class="btn btn-success">
                <i class="fa fa-plus-circle"></i>
                New Drive
            </a>
        </div>
        <hr>
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
                        <th>Posted</th>
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
                        <td>
                            <a class="btn btn-info" href="{{ url('staff/drive/edit/'.$unapproved_drive->id) }}" class=""><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger" href="{{ url('staff/drive/delete/'.$unapproved_drive->id) }}" class="" onclick="return confirm('Are you sure you want to dismiss drive scheduled on {{ $unapproved_drive->date }}?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No drives found.</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-primary text-light">Approved Drives</div>
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
                        <th>Created_at</th>
                        <th>Approved_at</th>
                        <th>Approved_by</th>
                    </tr>
                    @forelse ($drives as $drive)
                    <tr>
                        <td>{{ $drive->id }}</td>
                        <td>{{ $drive->bank->name }}</td>
                        <td>{{ $drive->staff->name }}</td>
                        <td>{{ $drive->location }}</td>
                        <td>{{ $drive->date }}</td>
                        <td>{{ $drive->time }}</td>
                        <td>{{ $drive->created_at }}</td>
                        <td>{{ $drive->approved_at }}</td>
                        <td>{{ $drive->admin->name }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Scheduled drives.</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    {{-- </div> --}}
</div>
@endsection
