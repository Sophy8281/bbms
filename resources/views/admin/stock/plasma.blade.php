@extends('layouts.admin_dashboard')
@section('breadcrumb')
Plasma
@endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Plasma in Stock</div>
    <div class="panel-body">
        <div class="col-md">
           <table id="example" class="table table-responsive table-hover">
               <thead>

                    <tr>
                        <th>#Id</th>
                        <th>Bank</th>
                        <th>Staff</th>
                        <th>Freezer</th>
                        <th>Bag Serial No.</th>
                        <th>Blood Group</th>
                        <th>Donation Date</th>
                        <th>Expiry Date</th>
                        <th>Days Remaining</th>
                        {{-- <th>Actions</th> --}}

                    </tr>
               </thead>
               @forelse($plasma as $plasma)
               <tr>
                    <td>{{ $plasma->id }}</td>
                    <td>{{ $plasma->bank->name }}</td>
                    <td>{{ $plasma->staff->name }}</td>
                    <td>{{ $plasma->freezer->name}}</td>
                    <td>{{ $plasma->bag_serial_number }}</td>
                    <td>{{ $plasma->group->name }}</td>
                    <td>{{ $plasma->donation_date }}</td>
                    <td>{{ $plasma->expiry_date }}</td>
                    @if ($plasma->expiry_date == Carbon\Carbon::today()|$plasma->expiry_date < Carbon\Carbon::today())
                        <td>
                            <a href="" class="btn btn-warning"> EXPIRED</a>
                        </td>
                        {{-- <td>
                            <a href="{{ url('staff/plasma/discard/'.$plasma->id) }}" class="btn btn-danger"> Discard</a>
                        </td> --}}
                    @else
                        <td>{{ Carbon\Carbon::create($plasma->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>
                        {{-- <td>
                            <a href="{{ url('staff/plasma/issue/'.$plasma->id) }}" class="btn btn-success"> Issue</a>
                        </td> --}}
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="4">There are no plasma bags.</td>
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
        paging:true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy', className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
            {extend: 'csv', title: 'Available Plasma', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
            {extend: 'excel', title: 'Available Plasma', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
            {extend: 'pdf', title: 'Available Plasma',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
            {extend: 'print', title: 'Available Plasma', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
