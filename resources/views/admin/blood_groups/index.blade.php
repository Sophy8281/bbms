@extends('layouts.admin_dashboard')
@section('breadcrumb')
Blood Groups
@endsection
@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('admin/add-blood-group')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>New Blood Group
    </a>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Blood Groups </div>
    <div class="panel-body">
        <table id="example" class="table table-responsive table-hover">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Admin</th>
                    <th>B_Group</th>
                    <th>Created On</th>
                    <th>Updated On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach($blood_groups as $blood_group)
            <tr>
                <td>{{ $blood_group->id }}</td>
                <td>{{ $blood_group->admin->name }}</td>
                <td>{{ $blood_group->name }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($blood_group->created_at)) }}</td>
                <td>{{ date('F d, Y h:m A', strtotime($blood_group->updated_at)) }}</td>
                <td>
                    <a href="{{ url('admin/group/edit/'.$blood_group->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('admin/group/delete/'.$blood_group->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blood group-{{ $blood_group->name }}?')"><i class="fa fa-trash"></i> Delete</a>
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
                {extend: 'copy', exportOptions: { columns: [0,1,2,3,4] }, className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
                {extend: 'csv',  exportOptions: { columns: [0,1,2,3,4] }, title: 'Blood Groups', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
                {extend: 'excel', exportOptions: { columns: [0,1,2,3,4] }, title: 'Blood Groups', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
                {extend: 'pdf', exportOptions: { columns: [0,1,2,3,4] }, title: 'Blood Groups',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
                {extend: 'print', exportOptions: { columns: [0,1,2,3,4] }, title: 'Blood Groups', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
