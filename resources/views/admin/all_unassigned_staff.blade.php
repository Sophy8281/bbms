@extends('layouts.admin_dashboard')
@section('breadcrumb')
Unapproved Staff
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-warning text-light">Staff Awaiting Approval</div>

                    <div class="card-body">

                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table table-responsive table-hover">
                            <tr>
                                <th>Staff name</th>
                                <th>Email</th>
                                <th></th>
                                <th>Action</th>
                            </tr>
                            @forelse ($staffs as $staff)
                                <tr>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td>{{ $staff->created_at->diffForHumans() }}</td>
                                    <td><a href="{{ route('admin.staff.assign', $staff->id) }}"
                                           class="btn btn-primary btn-sm">Assign Bank</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No unapproved staff found.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
