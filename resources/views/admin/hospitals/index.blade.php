@extends('layouts.admin_dashboard')
@section('breadcrumb')
Hospitals
@endsection
@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('admin/hospital/add')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>   New Hospital</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Hospitals</div>
    <div class="panel-body">
        <table id="example" class="table table-responsive table-hover">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>County</th>
                    <th>Created On</th>
                    <th>Updated On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach($hospitals as $hospital)
            <tr>
                <td>{{ $hospital->id }}</td>
                <td>{{ $hospital->name }}</td>
                <td>{{ $hospital->email }}</td>
                <td>{{ $hospital->phone }}</td>
                <td>{{ $hospital->county }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($hospital->created_at)) }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($hospital->updated_at)) }}</td>
                <td>
                    <a href="{{ url('admin/hospital/edit/'.$hospital->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('admin/hospital/delete/'.$hospital->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this hospital-{{ $hospital->name }}?')"><i class="fa fa-trash"></i> Delete</a>
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
                {extend: 'copy', exportOptions: { columns: [0,1,2,3,4,5,6] }, className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
                {extend: 'csv',  exportOptions: { columns: [0,1,2,3,4,5,6] }, title: 'Hospitals', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
                {extend: 'excel', exportOptions: { columns: [0,1,2,3,4,5,6] }, title: 'Hospitals', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
                {extend: 'pdf', exportOptions: { columns: [0,1,2,3,4,5,6] }, title: 'Hospitals',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
                {extend: 'print', exportOptions: { columns: [0,1,2,3,4,5,6] }, title: 'Hospitals', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
