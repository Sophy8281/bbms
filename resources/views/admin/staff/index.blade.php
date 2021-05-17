@extends('layouts.admin_dashboard')
@section('breadcrumb')
Staff
@endsection
@section('content')
@include('flash-message')

<div class="panel panel-default">
    <div class="panel-heading"><h5>Staff List</h5></div>
    <div class="panel-body">

        <table id="example" class="table table-responsive table-hover">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Bank</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created On</th>
                    <th>Updated On</th>
                    <th>Actions</th>
                </tr>
            </thead>
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
                    <a href="{{ url('admin/staff/delete/'.$staff->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff-{{ $staff->name }}?')"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">There are no staff in the system.</td>
            </tr>
            @endforelse

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
                {extend: 'csv',  exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Staff', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
                {extend: 'excel', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Staff', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
                {extend: 'pdf', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Staff',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
                {extend: 'print', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Staff', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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

