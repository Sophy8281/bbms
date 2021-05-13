@extends('layouts.staff_dashboard')

@section('breadcrumb')
Hospital Requests
@endsection

@section('content')
@include('flash-message')
<div class="panel panel-default">
    <div class="panel-heading"><h5>Hospital Requests</h5></div>
    <div class="panel-body">
        <table id="example" class="table table-responsive table-hover">
            <thead>
                <tr>
                     <th>#Id</th>
                     <th>Hospital</th>
                     <th>Product</th>
                     <th>Blood Group</th>
                     <th>Quantity</th>
                     <th>Requested At</th>
                     {{-- <th>Request Satisfied At</th> --}}
                     {{-- <th>Request Satisfied By</th> --}}
                 </tr>
            </thead>
            @forelse($requests as $request)
            <tr>
                 <td>{{ $request->id }}</td>
                 <td>{{ $request->hospital->name }}</td>
                 <td>{{ $request->product }}</td>
                 <td>{{ $request->group->name }}</td>
                 <td>{{ $request->quantity}}</td>
                 <td>{{ $request->created_at }}</td>
                 {{-- <td>{{ $request->approved_at }}</td> --}}
                 {{-- <td>{{ $request->bank_id }}</td> --}}
             </tr>
             @empty
             <tr>
                 <td colspan="4">No hospital requests yet.</td>
             </tr>
             @endforelse
         </table>
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
            {extend: 'copy', exportOptions: { columns: [0,1,2,3,4,5] },  className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
            {extend: 'csv', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Hospital Requests', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', exportOptions: { columns: [0,1,2,3,4,5] }, ttitle: 'Hospital Requests', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Hospital Requests',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', exportOptions: { columns: [0,1,2,3,4,5] }, title: 'Hospital Requests', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
