@extends('layouts.staff_dashboard')
@section('breadcrumb')
Agitators
@endsection
@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('staff/platelets/add')  }}" class="btn btn-success float-right">
        <i class="fa fa-plus-circle"></i>
        Add Platelets to Stock
    </a>
    <a href="{{ URL::to('staff/add-agitator')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>
        New Agitator
    </a>
</div>
<div class="panel panel-default"></div>
    <div class="panel-heading">Agitators(Store Platelets) </div>
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
            @foreach($agitators as $agitator)
            <tr>
                <td>{{ $agitator->id }}</td>
                <td>
                    <a style="text-decoration:underline;color:blue" href="{{ url('staff/agitator/show/'.$agitator->id) }}">{{ $agitator->name }}</a>
                </td>
                <td>{{ $agitator->capacity }}</td>
                @if ($agitator->platelets->count() < $agitator->capacity && $agitator->platelets->count() != $agitator->capacity)
                    <td>{{ $agitator->platelets->count() }}</td>
                @else
                 <td>Full</td>
                @endif
                <td>
                    <a href="{{ url('staff/agitator/'.$agitator->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Open</a></a>
                    <a href="{{ url('staff/agitator/edit/'.$agitator->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('staff/agitator/delete/'.$agitator->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
            {extend: 'copy', className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
            {extend: 'csv', title: 'Agitators', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', title: 'Agitators', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Agitators',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Agitators', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
