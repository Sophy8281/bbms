@extends('layouts.staff_dashboard')
@section('breadcrumb')
Agitators
@endsection
@section('content')
@include('flash-message')
{{-- <div>
    <a href="{{ URL::to('staff/platelets/add')  }}" class="btn btn-success float-right">
        <i class="fa fa-plus-circle"></i>
        Add Platelets to Stock
    </a>
</div> --}}
<div class="panel panel-default"></div>
    <div class="panel-heading">Agitators(Platelets) </div>
    <div class="panel-body">
        @if ($expired_platelets > 0)
        <div><script>alert('You have an expired platelet bag(s) in stock!!');</script></div>
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
            @foreach($agitators as $agitator)
            <tr>
                <td>{{ $agitator->id }}</td>
                <td>
                    <a style="text-decoration:underline;color:blue" href="{{ url('staff/agitator/show/'.$agitator->id) }}">{{ $agitator->name }}</a>
                </td>
                <td>{{ $agitator->capacity }}</td>
                @if ($agitator->platelets->whereNull('issued_at')->whereNull('discarded_at')->count() < $agitator->capacity && $agitator->platelets->whereNull('issued_at')->whereNull('discarded_at')->count() != $agitator->capacity)
                    <td>{{ $agitator->platelets->whereNull('issued_at')->whereNull('discarded_at')->count() }}</td>
                @else
                 <td>Full</td>
                @endif
                <td>
                    <a href="{{ url('staff/agitator/'.$agitator->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Open</a></a>
                </td>
            </tr>
            @endforeach
        </table>
        {{-- {{ $agitators->render() }} --}}
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
            {extend: 'csv', exportOptions: { columns: [0,1,2,3] }, title: 'Agitators', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', exportOptions: { columns: [0,1,2,3] }, title: 'Agitators', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', exportOptions: { columns: [0,1,2,3] }, title: 'Agitators',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', exportOptions: { columns: [0,1,2,3] }, title: 'Agitators', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
