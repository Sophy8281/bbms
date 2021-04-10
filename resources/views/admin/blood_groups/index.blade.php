@extends('layouts.admin_dashboard')

@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('admin/add-blood-group')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>   New Blood Group</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Blood Groups </div>
    <div class="panel-body">

        <table class="table">
            <tr>
                <th>#Id</th>
                <th>Admin</th>
                <th>B_Group</th>
                <th>Created On</th>
                <th>Updated On</th>
                <th>Actions</th>
            </tr>


            @foreach($blood_groups as $blood_group)
            <tr>
                <td>{{ $blood_group->id }}</td>
                <td>{{ $blood_group->admin->name }}</td>
                <td>{{ $blood_group->name }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($blood_group->created_at)) }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($blood_group->updated_at)) }}</td>
                <td>
                    <a href="{{ url('admin/group/edit/'.$blood_group->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('admin/group/delete/'.$blood_group->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach

        </table>

        {{ $blood_groups->render() }}

    </div>

</div>

@stop
