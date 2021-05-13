@extends('layouts.staff_dashboard')
@section('breadcrumb')
Refrigerators
@endsection
@section('content')
@include('flash-message')

<div>
    <a href="{{ URL::to('staff/rbc/add')  }}" class="btn btn-success float-right">
        <i class="fa fa-plus-circle"></i>   Add RBC to Stock
    </a>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Refrigerators(Store RBC) </div>
    <div class="panel-body">
        <table id="example" class="table table-responsive table-hover">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Name</th>
                    <th>Capacity</th>
                    <th>Bags Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach($refrigerators as $refrigerator)
            <tr>
                <td>{{ $refrigerator->id }}</td>
                <td>
                    <a style="text-decoration:underline;color:blue" href="{{ url('staff/refrigerator/show/'.$refrigerator->id) }}">{{ $refrigerator->name }}</a></td>
                <td>{{ $refrigerator->capacity }}</td>
                @if ($refrigerator->rbc->count() < $refrigerator->capacity && $refrigerator->rbc->count() != $refrigerator->capacity)
                    <td>{{ $refrigerator->rbc->count() }}</td>
                @else
                 <td>Full</td>
                @endif
                <td>
                    <a href="{{ url('staff/refrigerator/'.$refrigerator->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Open</a>
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
