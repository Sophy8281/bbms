@extends('layouts.admin_dashboard')
@section('breadcrumb')
Refrigerators
@endsection
@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('admin/add-refrigerator')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>
        New Refrigerator
    </a>
</div>
<div class="panel panel-default"></div>
    <div class="panel-heading">Refrigerators</div>
    <div class="panel-body">
        <table id="example" class="table table-responsive table-hover">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Name</th>
                    <th>Bank</th>
                    <th>Capacity</th>
                    {{-- <th>Bags Count</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach($refrigerators as $refrigerator)
            <tr>
                <td>{{ $refrigerator->id }}</td>
                <td>{{ $refrigerator->name }}</td>
                <td>{{ $refrigerator->bank->name }}</td>
                <td>{{ $refrigerator->capacity }}</td>
                {{-- @if ($agitator->platelets->count() < $agitator->capacity && $agitator->platelets->count() != $agitator->capacity)
                    <td>{{ $agitator->platelets->count() }}</td>
                @else
                 <td>Full</td>
                @endif --}}
                <td>
                    <a href="{{ url('admin/refrigerator/edit/'.$refrigerator->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('admin/refrigerator/delete/'.$refrigerator->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this refrigeretor-{{ $refrigerator->name }}?')"><i class="fa fa-trash"></i> Delete</a>
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
            {extend: 'copy', exportOptions: { columns: [0,1,2,3] }, className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
            {extend: 'csv', exportOptions: { columns: [0,1,2,3] }, title: 'Refrigerators', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', exportOptions: { columns: [0,1,2,3] }, title: 'Refrigerators', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', exportOptions: { columns: [0,1,2,3] }, title: 'Refrigerators',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', exportOptions: { columns: [0,1,2,3] }, title: 'Refrigerators', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
