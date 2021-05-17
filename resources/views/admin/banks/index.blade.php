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
    <div class="panel-heading">Banks</div>
    <div class="panel-body">
        <table id="example" class="table table-responsive table-hover">
            <thead>
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
            </thead>
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
                    <a href="{{ url('admin/bank/delete/'.$bank->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this bank-{{ $bank->name }}?')"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>
@stop
@section('javascript')
<!-- export Scripts -->
<script>
    $(document).ready(function(){
        $('#example').DataTable({
            pageLength: 25,
            paging:true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy', exportOptions: { columns: [0,1,2,3,4,5] }, className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
                {extend: 'csv',  exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Banks', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
                {extend: 'excel', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Banks', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
                {extend: 'pdf', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Banks',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
                {extend: 'print', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Banks', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
                    customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
                    }
                }
            ]
        });
    });

</script>
@endsection
