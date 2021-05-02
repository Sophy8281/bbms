@extends('layouts.admin_dashboard')
@section('breadcrumb')
Issued Blood
@endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Whole-Blood Issued</div>
    <div class="panel-body">

        <div class="col-md">
           <table id="example" class="table table-responsive table-hover">
               <thead>
                   <tr>
                         <th>#Id</th>
                        <th>Donation Id</th>
                        <th>Bank</th>
                        <th>Issued_By</th>
                        <th>Bag Serial No.</th>
                        <th>B_Group</th>
                        <th>Issued_To</th>

                    </tr>
               </thead>
               @forelse($blood as $blood)
               <tr>
                    <td>{{ $blood->id }}</td>
                    <td>{{ $blood->donation_id }}</td>
                    <td>{{ $blood->bank->name }}</td>
                    <td>{{ $blood->staff->name }}</td>
                    <td>{{ $blood->bag_serial_number }}</td>
                    <td>{{ $blood->group->name }}</td>
                    <td>{{ $blood->hospital->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No Whole-Blood Bags Issued.</td>
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
            {extend: 'csv', title: 'Issued Blood', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', title: 'Issued Blood', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Issued Blood', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Issued Blood', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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

