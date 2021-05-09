@extends('layouts.staff_dashboard')
@section('breadcrumb')
Drives
@endsection
@section('content')
@include('flash-message')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-light">Hosted Drives</div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <table class="table table-responsive table-hover">
                <tr>
                    <th>#Id</th>
                    <th>Name</th>
                    <th>Organization</th>
                    <th>Population</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Bank</th>
                    <th>Comment</th>
                    <th>Actions</th>
                </tr>
                @forelse ($hosted_drives as $hosted_drive)
                <tr>
                    <td>{{ $hosted_drive->id }}</td>
                    <td>{{ $hosted_drive->name }}</td>
                    <td>{{ $hosted_drive->organization }}</td>
                    <td>{{ $hosted_drive->population }}</td>
                    <td>{{ $hosted_drive->email }}</td>
                    <td>{{ $hosted_drive->phone }}</td>
                    <td>{{ $hosted_drive->location }}</td>
                    <td>{{ $hosted_drive->date }}</td>
                    <td>{{ $hosted_drive->bank->name }}</td>
                    <td>{{ $hosted_drive->comment }}</td>
                    <td>
                        <a href="{{ url('staff/hosted/accept/'.$hosted_drive->id) }}" class="btn btn-success"  onclick="return confirm('Are you sure you want to accept drive hosted by {{ $hosted_drive->organization }}?')">ACCEPT</a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4">No request for hosting drives.</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection
