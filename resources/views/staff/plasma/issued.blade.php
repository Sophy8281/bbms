@extends('layouts.staff_dashboard')
@section('breadcrumb')
Issued Plasma
@endsection
@section('content')
@include('flash-message')

<div class="panel panel-default">
    <div class="panel-heading"><h5>List of Issued Plasma Bags</h5></div>
    <div class="panel-body">
        <div class="col-md">
           <table id="example" class="table table-responsive table-hoverr">
               <thead>
                   <tr>
                        <th>#Id</th>
                        <th>Plasma ID</th>
                        <th>Bank</th>
                        <th>Issued_By</th>
                        <th>Freezer</th>
                        <th>Bag SNo.</th>
                        <th>Blood Group</th>
                        <th>Issued_To</th>
                    </tr>
               </thead>
                @forelse($plasma as $plasma)
                <tr>
                    <td>{{ $plasma->id }}</td>
                    <td>{{ $plasma->plasma_id }}</td>
                    <td>{{ $plasma->bank->name }}</td>
                    <td>{{ $plasma->staff->name }}</td>
                    <td>{{ $plasma->freezer->name}}</td>
                    <td>{{ $plasma->bag_serial_number }}</td>
                    <td>{{ $plasma->group->name }}</td>
                    <td>{{ $plasma->hospital->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No Plasma bags Issued.</td>
                </tr>
                @endforelse
            </table>
        </div>
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
            {extend: 'csv', title: 'Issued Plasma', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', title: 'Issued Plasma', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Issued Plasma',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Issued Plasma', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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

