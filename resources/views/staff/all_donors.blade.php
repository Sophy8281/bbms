@extends('layouts.staff_dashboard')

@section('content')
@include('flash-message')
<div class="">
    <a href="{{ URL::to('staff/add-user')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>   New Donor</a>
</div>
<div class="d-flex justify-content-end">
    <a class="btn btn-primary" href="{{ URL::to('staff/reports/donors') }}" target="_blank">Export to PDF</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Donors</div>
    <div class="panel-body">



        <table class="table table-responsive">
            <tr>
                <th>#Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Student Number /ID /Passport</th>
                <th>DoB</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Blood Group</th>
                <th>County of Residence</th>
                <th>Created On</th>
                {{-- <th>Updated On</th> --}}
                <th>Actions</th>
            </tr>


            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->unique_no }}</td>
                <td>{{ date('F d, Y', strtotime($user->birth_date)) }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->blood_group }}</td>
                <td>{{ $user->county }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($user->created_at)) }}</td>
                {{-- <td>{{ date('F d, Y h:m A', strtotime($user->updated_at)) }}</td> --}}

                <td>

                    <a href="{{ url('staff/user/edit/'.$user->id) }}" class=""><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('staff/user/delete/'.$user->id) }}" class=""><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $users->render() }}
    </div>
</div>

@stop
