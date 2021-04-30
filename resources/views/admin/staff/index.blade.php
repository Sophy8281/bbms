@extends('layouts.admin_dashboard')
@section('breadcrumb')
Staff
@endsection
@section('content')
@include('flash-message')

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Bank Staff</div>
    <div class="panel-body">

        <table class="table table-responsive table-hover">
            <tr>
                <th>#Id</th>
                <th>Bank</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created On</th>
                <th>Updated On</th>
                <th>Actions</th>
            </tr>


            @forelse($staffs as $staff)
            <tr>
                <td>{{ $staff->id }}</td>
                <td>{{ $staff->bank->name }}</td>
                <td>{{ $staff->name }}</td>
                <td>{{ $staff->email }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($staff->created_at)) }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($staff->updated_at)) }}</td>

                <td>

                    <a href="{{ url('admin/staff/edit/'.$staff->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('admin/staff/delete/'.$staff->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">There are no staff in the system.</td>
            </tr>
            @endforelse

        </table>


        {{-- {{ $staffs->render() }} --}}

    </div>

</div>

@stop
