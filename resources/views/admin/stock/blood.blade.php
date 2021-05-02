@extends('layouts.admin_dashboard')
@section('breadcrumb')
Blood
@endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading"><h5>Whole Blood in Stock </h5></div>
    <div class="panel-body">
        <div class="col-md">
            <table id="example" class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Donation ID</th>
                        <th>Bank</th>
                        <th>Staff</th>
                        <th>Bag Serial No.</th>
                        <th>B.Group</th>
                        <th>Donation Date</th>
                        <th>Expiry</th>
                        <th>Days Remaining</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($bloods as $blood)
                    <tr>
                        <td>{{ $blood->id }}</td>
                        <td>{{ $blood->donation_id }}</td>
                        <td>{{ $blood->bank->name }}</td>
                        <td>{{ $blood->staff->name }}</td>
                        <td>{{ $blood->bag_serial_number }}</td>
                        <td>{{ $blood->group->name }}</td>
                        <td>{{ date('F d, Y', strtotime($blood->donation_date)) }}</td>
                        <td>{{ date('F d, Y', strtotime($blood->expiry_date)) }}</td>
                        @if ($blood->expiry_date == Carbon\Carbon::today()|$blood->expiry_date < Carbon\Carbon::today())
                        <td>
                            <a href="" class="btn btn-warning"> EXPIRED</a>
                        </td>
                        {{-- <td>
                            <a href="{{ url('staff/blood/discard/'.$blood->id) }}" class="btn btn-danger"> Discard</a>
                        </td> --}}
                    @else
                        <td>{{ Carbon\Carbon::create($blood->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>
                        {{-- <td>
                            <a href="{{ url('staff/blood/issue/'.$blood->id) }}" class="btn btn-success"> Issue</a>
                        </td> --}}
                    @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">No blood in cold rooms.</td>
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
            {extend: 'copy', title: 'Available Blood', className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
            {extend: 'csv', title: 'Available Blood', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', title: 'Available Blood', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Available Blood',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Available Blood', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
