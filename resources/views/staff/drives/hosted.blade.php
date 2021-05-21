@extends('layouts.staff_dashboard')
@section('breadcrumb')
Drives
@endsection
@section('content')
@include('flash-message')
<div class="panel panel-default">
    <div class="panel-heading"><h5>Hosting Requests</h5></div>
    <div class="panel-body">
        <table id="example" class="table table-responsive table-hover">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Name</th>
                    <th>Organization</th>
                    <th>Population</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Bank</th>
                    <th>Comment</th>
                    <th>Requested_At</th>
                    <th>Accepted_At</th>
                    <th>Accepted_By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @forelse ($hosted_drives as $hosted_drive)
            <tr>
                <td>{{ $hosted_drive->id }}</td>
                <td>{{ $hosted_drive->name }}</td>
                <td>{{ $hosted_drive->organization }}</td>
                <td>{{ $hosted_drive->population }}</td>
                <td>{{ $hosted_drive->email }}</td>
                <td>{{ $hosted_drive->phone }}</td>
                <td>{{ $hosted_drive->location }}</td>
                <td>{{ $hosted_drive->date }}</td>
                <td>{{ $hosted_drive->bank->name }}</td>
                <td>{{ $hosted_drive->comment }}</td>
                <td>{{ $hosted_drive->created_at }}</td>
                <td>
                @if ($hosted_drive->accepted_at)
                {{ $hosted_drive->accepted_at }}
                @endif
                </td>
                <td>
                @if ($hosted_drive->staff_id)
                {{ $hosted_drive->staff->name }}
                @endif
                </td>
                @if ($hosted_drive->accepted_at)
                <td></td>
                @else
                <td>
                    <a href="{{ url('staff/hosted/accept/'.$hosted_drive->id) }}" class="btn btn-success"  onclick="return confirm('Are you sure you want to accept drive hosted by {{ $hosted_drive->organization }}?')">ACCEPT</a>
                </td>
                @endif

            </tr>
            @empty
                <tr>
                    <td colspan="4">No request for hosting drives.</td>
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
        // responsive:true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy',  exportOptions: { columns: [0,1,2,3,4,5,6,7,8] },className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
            {extend: 'csv', exportOptions: { columns: [0,1,2,3,4,5,6,7,8] }, className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', exportOptions: { columns: [0,1,2,3,4,5,6,7,8] }, title: 'Drive Hosting Requests', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', exportOptions: { columns: [0,1,2,3,4,5,6,7,8] }, title: 'Drive Hosting Requests',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', exportOptions: { columns: [0,1,2,3,4,5,6,7,8] }, title: 'Drive Hosting Requests', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
