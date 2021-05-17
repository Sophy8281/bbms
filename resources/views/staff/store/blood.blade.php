@extends('layouts.staff_dashboard')
@section('breadcrumb')
Storage
@endsection
@section('content')
@include('flash-message')
<div class="panel panel-default">
    <div class="panel-heading"><h5>Store Blood</h5></div>
    <div class="panel-body">
        <div class="col-md">
            <table id="example" class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Donor</th>
                        <th>Bank</th>
                        <th>Bag Serial No.</th>
                        <th>Blood Group</th>
                        <th>status</th>
                        <th>Created_on</th>
                        <th>Store</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($safe_blood as $safe_blood)
                    <tr>
                        <td>{{ $safe_blood->id }}</td>
                        <td>{{ $safe_blood->donor->name }}</td>
                        <td>{{ $safe_blood->bank->name }}</td>
                        <td>{{ $safe_blood->bag_serial_number }}</td>
                        <td>{{ $safe_blood->group->name }}</td>
                        <td>{{ $safe_blood->status  }}</td>
                        <td>{{ date('F d, Y', strtotime($safe_blood->created_at)) }}</td>
                        <td>
                            <a href="{{ url('staff/blood/store/'.$safe_blood->id) }}" class="btn btn-info"> Store</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">There are no unprocessed and unstored blood bags that have not yet been stored.</td>
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
            {extend: 'csv', title: 'Safe Donations', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', ttitle: 'Safe Donations', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Safe Donations',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Safe Donations', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
