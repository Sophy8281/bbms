@extends('layouts.staff_dashboard')
@section('breadcrumb')
Storage
@endsection
@section('content')
@include('flash-message')
<div class="panel panel-default">
    <div class="panel-heading"><h5>Store Plasma</h5></div>
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
                        <th>Plasma Bag No</th>
                        <th>Store</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($processed_plasma as $processed_plasma)
                    <tr>
                        <td>{{ $processed_plasma->id }}</td>
                        <td>{{ $processed_plasma->bank->name }}</td>
                        <td>{{ $processed_plasma->bag_serial_number }}</td>
                        <td>{{ $processed_plasma->group->name }}</td>
                        <td>{{ date('F d, Y', strtotime($processed_plasma->created_at)) }}</td>
                        <td>{{ date('F d, Y', strtotime($processed_plasma->processed_at)) }}</td>
                        <td>{{ $processed_plasma->plasma_bag_no }}</td>
                        <td>
                            <a href="{{ url('staff/plasma/store/'.$processed_plasma->id) }}" class="btn btn-info"> Store</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">There are no processed plasma bags that have not yet been stored.</td>
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
            {extend: 'csv', title: 'Processed Plasma', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', ttitle: 'Processed Plasma', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Processed Plasma',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Processed Plasma', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
