@extends('layouts.admin_dashboard')
@section('breadcrumb')
Banks
@endsection
@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('admin/add-bank')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>   New Bank</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Banks</div>
    <div class="panel-body">
        <table class="table table-responsive table-hover">
            <tr>
                <th>#Id</th>
                <th>Admin</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>County</th>
                <th>Created On</th>
                <th>Updated On</th>
                <th>Actions</th>
            </tr>

            @foreach($banks as $bank)
            <tr>
                <td>{{ $bank->id }}</td>
                <td>{{ $bank->admin->name }}</td>
                <td>{{ $bank->name }}</td>
                <td>{{ $bank->email }}</td>
                <td>{{ $bank->phone }}</td>
                <td>{{ $bank->county }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($bank->created_at)) }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($bank->updated_at)) }}</td>
                <td>
                    <a href="{{ url('admin/bank/edit/'.$bank->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('admin/bank/delete/'.$bank->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach




        </table>


        {{ $banks->render() }}

    </div>

</div>

@stop
