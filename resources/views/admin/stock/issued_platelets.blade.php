@extends('layouts.admin_dashboard')
@section('breadcrumb')
Issued Platelets
@endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Platelets Issued</div>
    <div class="panel-body">

        <div class="col-md">
           <table id="example" class="table table-responsive table-hover">
               <thead>
                   <tr>
                        <th>#Id</th>
                        <th>Platelet ID</th>
                        <th>Bank</th>
                        <th>Issued_By</th>
                        <th>Agitator</th>
                        <th>Bag Serial No.</th>
                        <th>Blood Group</th>
                        <th>Issued_To</th>

                    </tr>
               </thead>
               @forelse($platelets as $platelet)
               <tr>
                    <td>{{ $platelet->id }}</td>
                    <td>{{ $platelet->platelet_id }}</td>
                    <td>{{ $platelet->bank->name }}</td>
                    <td>{{ $platelet->staff->name }}</td>
                    <td>{{ $platelet->agitator->name}}</td>
                    <td>{{ $platelet->bag_serial_number }}</td>
                    <td>{{ $platelet->group->name }}</td>
                    <td>{{ $platelet->hospital->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No Platelet Bags Issued.</td>
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
            {extend: 'csv', title: 'Issued Platelets', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', title: 'Issued Platelets', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Issued Platelets',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print',  title: 'Issued Platelets', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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

