@extends('layouts.admin_dashboard')
@section('breadcrumb')
Discarded Platelets
@endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Platelets Discarded</div>
    <div class="panel-body">

        <div class="col-md">
           <table id="example" class="table table-responsive table-hover">
               <thead>
                <tr>
                    <th>#Id</th>
                    <th>Bank</th>
                    <th>Discarded By</th>
                    <th>Agitator</th>
                    <th>Bag SNo.</th>
                    <th>Blood Group</th>
                    <th>Donation</th>
                    <th>Expiry</th>
                </tr>
               </thead>

                @forelse($platelets as $platelet)
                <tr>
                    <td>{{ $platelet->id }}</td>
                    <td>{{ $platelet->bank->name }}</td>
                    <td>{{ $platelet->staff->name }}</td>
                    <td>{{ $platelet->agitator->name}}</td>
                    <td>{{ $platelet->bag_serial_number }}</td>
                    <td>{{ $platelet->group->name }}</td>
                    <td>{{ $platelet->donation_date }}</td>
                    <td>{{ $platelet->expiry_date }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No Platelets Discarded.</td>
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
            {extend: 'csv', title: 'Discarded Platelets', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', title: 'Discarded Platelets', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Discarded Platelets', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Discarded Platelets', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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

