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
                     <th>Requested Quantity</th>
                     <th>Requested At</th>
                     <th>Remaining Quantity</th>
                     <th>Satisfied At</th>
                     {{-- <th>Available</th> --}}
                     <th>Amount Issuable</th>
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
                <td>{{ $request->remaining }}</td>
                <td>{{ $request->satisfied_at }}</td>
                <td>
                    @if ($request->product == "whole blood")
                    {{-- <td>{{count($whole_blood->where('group_id', '=', $request->group_id)) }}</td> --}}
                    @if($request->remaining != '0')
                    @if (count($whole_blood->where('group_id', '=', $request->group_id)) >  0)
                    @if (count($whole_blood->where('group_id', '=', $request->group_id)) >  $request->remaining || count($rbc->where('group_id', '=', $request->group_id)) ==  $request->remaining)
                        {{-- <a class="btn btn-primary" href="{{ url('staff/requests/full/'.$request->id) }}">Full Quantity</a> --}}
                        <p>Full Quantity</p>
                    @else
                        {{-- <a class="btn btn-primary" href="{{ url('staff/requests/available-blood/'.$request->id) }}">The Available</a> --}}
                        <p>The Available</p>
                    @endif
                    @else
                    <p>Out of stock</p>
                    @endif
                    @else
                    <p>Satisfied</p>
                    @endif
                    @endif

                    @if ($request->product == "plasma")
                    {{-- <td>{{count($plasma->where('group_id', '=', $request->group_id)) }}</td> --}}
                    @if($request->remaining != '0')
                    @if (count($plasma->where('group_id', '=', $request->group_id)) >  0)
                    @if (count($plasma->where('group_id', '=', $request->group_id)) >  $request->remaining || count($plasma->where('group_id', '=', $request->group_id)) ==  $request->remaining)
                    {{-- <a class="btn btn-primary" href="{{ url('staff/requests/full/'.$request->id) }}">Full Quantity</a> --}}
                    <p>Full Quantity</p>
                    @else
                    {{-- <a class="btn btn-primary" href="{{ url('staff/requests/available-plasma/'.$request->id) }}">The Available</a> --}}
                    <p>The Available</p>
                    @endif
                    @else
                    <p>Out of stock</p>
                    @endif
                    @else
                    <p>Satisfied</p>
                    @endif
                    @endif

                    @if ($request->product == "platelets")
                    {{-- <td>{{count($platelets->where('group_id', '=', $request->group_id)) }}</td> --}}
                    @if($request->remaining != '0')
                    @if (count($platelets->where('group_id', '=', $request->group_id)) > 0)
                    @if (count($platelets->where('group_id', '=', $request->group_id)) >  $request->remaining || count($rbc->where('group_id', '=', $request->group_id)) ==  $request->remaining)
                    {{-- <a class="btn btn-primary" href="{{ url('staff/requests/full/'.$request->id) }}">Full Quantity</a> --}}
                    <p>Full Quantity</p>
                    @else
                    {{-- <a class="btn btn-primary" href="{{ url('staff/requests/available-platelets/'.$request->id) }}">The Available</a> --}}
                    <p>The Available</p>
                    @endif
                    @else
                    <p>Out of stock</p>
                    @endif
                    @else
                    <p>Satisfied</p>
                    @endif
                    @endif

                    @if ($request->product == "red blood cells")
                        {{-- <td>{{count($rbc->where('group_id', '=', $request->group_id)) }}</td> --}}
                    @if($request->remaining != 0)
                    @if (count($rbc->where('group_id', '=', $request->group_id)) >  0)
                    @if (count($rbc->where('group_id', '=', $request->group_id)) >  $request->remaining || count($rbc->where('group_id', '=', $request->group_id)) ==  $request->remaining)
                    {{-- <a class="btn btn-primary" href="{{ url('staff/requests/full/'.$request->id) }}">Full Quantity</a> --}}
                    <p>Full Quantity</p>
                    @else
                    {{-- <a class="btn btn-primary" href="{{ url('staff/requests/available-rbc/'.$request->id) }}">The Available</a> --}}
                    <p>The Available</p>
                    @endif
                    @else
                    <p>Out of stock</p>
                    @endif
                    @else
                    <p>Satisfied</p>
                    @endif
                    @endif
                </td>
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
        responsive:true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy', exportOptions: { columns: [0,1,2,3,4,5,6,7] },  className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
            {extend: 'csv', exportOptions: { columns: [0,1,2,3,4,5,6,7] }, title: 'Hospital Requests', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', exportOptions: { columns: [0,1,2,3,4,5,6,7] }, ttitle: 'Hospital Requests', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', exportOptions: { columns: [0,1,2,3,4,5,6,7] }, title: 'Hospital Requests',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', exportOptions: { columns: [0,1,2,3,4,5,6,7] }, title: 'Hospital Requests', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
