@extends('layouts.admin_dashboard')
@section('breadcrumb')
Discarded RBC
@endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">RBC Discarded</div>
    <div class="panel-body">

        <div class="col-md">
           <table id="example" class="table table-responsive table-hover">
               <thead>
                <tr>
                    <th>#Id</th>
                    <th>Bank</th>
                    <th>Discarded By</th>
                    <th>Refrigerator</th>
                    <th>Bag SNo.</th>
                    <th>Blood Group</th>
                    <th>Donation</th>
                    <th>Expiry</th>
                </tr>
               </thead>

                @forelse($rbc as $rbc)
                <tr>
                    <td>{{ $rbc->id }}</td>
                    <td>{{ $rbc->bank->name }}</td>
                    <td>{{ $rbc->staff->name }}</td>
                    <td>{{ $rbc->refrigerator->name}}</td>
                    <td>{{ $rbc->bag_serial_number }}</td>
                    <td>{{ $rbc->group->name }}</td>
                    <td>{{ $rbc->donation_date }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No RBC Discarded.</td>
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
            {extend: 'csv', title: 'Discarded RBC', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', title: 'Discarded RBC', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Discarded RBC',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Discarded RBC', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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

