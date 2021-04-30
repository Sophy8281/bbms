@extends('layouts.staff_dashboard')
@section('breadcrumb')
RBC
@endsection
@section('content')
@include('flash-message')

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Red Blood Cells</div>
    <div class="panel-body">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('staff/all-refrigerators') }}" title="Go back"> <i
          class="fas fa-backward"> Back</i> </a>
       </div>
       <div class="col-md">
            <table id="example" class="table table-bordered table-hover">
                <hr>
                <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Bank</th>
                        <th>Staff</th>
                        <th>Refrigerator</th>
                        <th>Bag Serial No.</th>
                        <th>Blood Group</th>
                        <th>Donation Date</th>
                        <th>Expiry Date</th>
                        <th>Days Remaining</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                @forelse($rbcs as $rbc)
                <tr>
                    <td>{{ $rbc->id }}</td>
                    <td>{{ $rbc->bank->name }}</td>
                    <td>{{ $rbc->staff->name }}</td>
                    <td>{{ $rbc->refrigerator->name}}</td>
                    <td>{{ $rbc->bag_serial_number }}</td>
                    <td>{{ $rbc->group->name }}</td>
                    <td>{{ $rbc->donation_date }}</td>
                    <td>{{ $rbc->expiry_date }}</td>
                    @if ($rbc->expiry_date == Carbon\Carbon::today()|$rbc->expiry_date < Carbon\Carbon::today())
                        <td>
                            <a href="" class="btn btn-warning">EXPIRED</a>
                        </td>
                        <td>
                            <a href="{{ url('staff/rbc/discard/'.$rbc->id) }}" class="btn btn-warning">Discard</a>
                        </td>
                    @else
                        <td>{{ Carbon\Carbon::create($rbc->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>
                        <td>
                            <a href="{{ url('staff/rbc/issue/'.$rbc->id) }}" class="btn btn-success">Issue</a>
                        </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="4">There are no red blood cells bags in this regrigerator.</td>
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
            responsive: true,
            paging:true,
            // searching:false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy', className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
                {extend: 'csv', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
                {extend: 'excel', title: 'Donors', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
                {extend: 'pdf', title: 'Donors',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
                {extend: 'print', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
