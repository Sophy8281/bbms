@extends('layouts.staff_dashboard')
@section('breadcrumb')
Processing
@endsection
@section('content')
@include('flash-message')
<div class="panel panel-default">
    <div class="panel-heading"><h5>Processed Blood </h5></div>
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
                        <th>Created_On</th>
                        <th>Processed_At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($processed_blood as $processed_blood)
                    <tr>
                        <td>{{ $processed_blood->id }}</td>
                        <td>{{ $processed_blood->donor->name }}</td>
                        <td>{{ $processed_blood->bank->name }}</td>
                        <td>{{ $processed_blood->bag_serial_number }}</td>
                        <td>{{ $processed_blood->group->name }}</td>
                        <td>{{ date('F d, Y', strtotime($processed_blood->created_at)) }}</td>
                        <td>{{ date('F d, Y', strtotime($processed_blood->processed_at)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">No processed blood at the moment.</td>
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
            {extend: 'csv', title: 'Processed Donations', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', ttitle: 'Processed Donations', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Processed Donations',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Processed Donations', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
