@extends('layouts.staff_dashboard')
@section('breadcrumb')
Freezers
@endsection
@section('content')
@include('flash-message')
{{-- <div>
    <a href="{{ URL::to('staff/plasma/add')  }}" class="btn btn-success float-right">
        <i class="fa fa-plus-circle"></i>
        Add Plasma to Stock
    </a>
</div> --}}
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Freezers(Plasma) </div>
    <div class="panel-body">
        @if ($expired_plasma > 0)
        <div><script>alert('You have an expired plasma bag(s) in stock!!');</script></div>
        @endif
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
            @foreach($freezers as $freezer)
            <tr>
                <td>{{ $freezer->id }}</td>
                <td>
                     <a style="text-decoration:underline;color:blue" href="{{ url('staff/freezer/show/'.$freezer->id) }}">{{ $freezer->name }}</a>
                </td>
                <td>{{ $freezer->capacity }}</td>
                @if ($freezer->plasma->whereNull('issued_at')->whereNull('discarded_at')->count() < $freezer->capacity && $freezer->plasma->whereNull('issued_at')->whereNull('discarded_at')->count() != $freezer->capacity)
                    <td>{{ $freezer->plasma->whereNull('issued_at')->whereNull('discarded_at')->count() }}</td>
                @else
                 <td>Full</td>
                @endif
                <td>
                    <a href="{{ url('staff/freezer/'.$freezer->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Open</a>
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
            {extend: 'csv', exportOptions: { columns: [0,1,2,3] }, title: 'Freezers', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', exportOptions: { columns: [0,1,2,3] }, title: 'Freezers', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', exportOptions: { columns: [0,1,2,3] }, title: 'Freezers',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', exportOptions: { columns: [0,1,2,3] }, title: 'Freezers', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
