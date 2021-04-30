@extends('layouts.admin_dashboard')
@section('breadcrumb')
Hospitals
@endsection
@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('admin/hospital/add')  }}" class="btn btn-success">
        <i class="fa fa-plus-square"></i>   New Hospital</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Hospitals</div>
    <div class="panel-body">
        <table class="table table-responsive table-hover">
            <tr>
                <th>#Id</th>
                <th>Name</th>
                <th>Created On</th>
                <th>Updated On</th>
                <th>Actions</th>
            </tr>

            @foreach($hospitals as $hospital)
            <tr>
                <td>{{ $hospital->id }}</td>
                <td>{{ $hospital->name }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($hospital->created_at)) }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($hospital->updated_at)) }}</td>
                <td>
                    <a href="{{ url('admin/hospital/edit/'.$hospital->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('admin/hospital/delete/'.$hospital->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach




        </table>


        {{ $hospitals->render() }}

    </div>

</div>

@stop
