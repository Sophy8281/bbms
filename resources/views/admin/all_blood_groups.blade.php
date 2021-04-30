@extends('layouts.admin_dashboard')
@section('breadcrumb')
Blood Groups
@endsection
@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('admin/add-blood-group')  }}" class="btn btn-success">
        <i class="fa fa-plus-square"></i>   New Blood Group</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Blood Groups </div>
    <div class="panel-body">

        <table class="table table-responsive table-hover">
            <tr>
                <th>Bank ID</th>
                <th>Admin ID</th>
                <th>Blood Group</th>
                <th>Created On</th>
                <th>Updated On</th>
            </tr>


            @foreach($blood_groups as $blood_group)
            <tr>
                <td>{{ $blood_group->id }}</td>
                <td>{{ $blood_group->admin_id }}</td>
                <td>{{ $blood_group->name }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($blood_group->created_at)) }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($blood_group->updated_at)) }}</td>
            </tr>
            @endforeach




        </table>


        {{ $blood_groups->render() }}

    </div>

</div>

@stop
