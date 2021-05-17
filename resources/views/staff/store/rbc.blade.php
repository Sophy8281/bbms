@extends('layouts.staff_dashboard')
@section('breadcrumb')
Storage
@endsection
@section('content')
@include('flash-message')
<div class="panel panel-default">
    <div class="panel-heading"><h5>Store RBC</h5></div>
    <div class="panel-body">
        <div class="col-md">
            <table id="example" class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Bank</th>
                        <th>Bag SNo.</th>
                        <th>Blood Group</th>
                        <th>Created_On</th>
                        <th>Processed_At</th>
                        <th>RBC Bag No</th>
                        <th>Store</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($processed_rbc as $processed_rbc)
                    <tr>
                        <td>{{ $processed_rbc->id }}</td>
                        <td>{{ $processed_rbc->bank->name }}</td>
                        <td>{{ $processed_rbc->bag_serial_number }}</td>
                        <td>{{ $processed_rbc->group->name }}</td>
                        <td>{{ date('F d, Y', strtotime($processed_rbc->created_at)) }}</td>
                        <td>{{ date('F d, Y', strtotime($processed_rbc->processed_at)) }}</td>
                        <td>{{ $processed_rbc->rbc_bag_no }}</td>
                        <td>
                            <a href="{{ url('staff/rbc/store/'.$processed_rbc->id) }}" class="btn btn-info"> Store</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">There are no processed rbc bags that have not yet been stored.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
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
            {extend: 'csv', title: 'Processed RBC', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', ttitle: 'Processed RBC', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Processed RBC',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Processed RBC', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
