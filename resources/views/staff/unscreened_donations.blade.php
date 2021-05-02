@extends('layouts.staff_dashboard')
@section('breadcrumb')
Screening
@endsection
@section('content')
@include('flash-message')
@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Unscreened  Donations</div>
        <div class="panel-body">
            <div class="col-md">
                <table id="example" class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>#Id</th>
                            <th>Donor</th>
                            <th>Bank</th>
                            <th>Bag SNo.</th>
                            <th>Blood Group</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    @forelse ($donations as $donation)
                    <tr>
                        <td>{{ $donation->id }}</td>
                        <td>{{ $donation->donor->name }}</td>
                        <td>{{ $donation->bank->name }}</td>
                        <td>{{ $donation->bag_serial_number }}</td>
                        <td> <a class="btn btn-success" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">{{ $donation->blood_group }}
                            <i class="fas fa-heart">Pending</i>
                            </a>
                        </td>
                        <td> <a class="btn btn-success" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">{{ $donation->status }}
                            <i class="fas fa-thumbs-up">Pending</i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No Unscreened Donations found.</td>
                    </tr>
                    @endforelse
                </table>
            </div>
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
            {extend: 'copy', exportOptions: { columns: [0,1,2,3,4,5] }, className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
            {extend: 'csv', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Unscreened Donations', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Unscreened Donations', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Unscreened Donations',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Unscreened Donations', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
