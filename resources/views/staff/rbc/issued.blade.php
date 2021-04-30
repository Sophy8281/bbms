@extends('layouts.staff_dashboard')
@section('breadcrumb')
Issued RBC
@endsection
@section('content')
@include('flash-message')

{{-- <div>
    <a href="{{ URL::to('staff/plasma/add')  }}" class="btn btn-success">
        <i class="fa fa-plus-square"></i>   Store Plasma</a>
</div> --}}
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Plasma Issued</div>
    <div class="panel-body">

        <div class="col-md">
           <table id="example" class="table table-responsive table-hover">
               <thead>
                   <tr>
                    <th>#Id</th>
                    <th>Rbc ID</th>
                    <th>Bank ID</th>
                    <th>Issued_By</th>
                    <th>Refrigerator</th>
                    <th>Bag Serial No.</th>
                    <th>Blood Group</th>
                    <th>Issued_To</th>

                    </tr>
               </thead>
               @forelse($rbcs as $rbc)
                <tr>
                    <td>{{ $rbc->id }}</td>
                    <td>{{ $rbc->rbc_id }}</td>
                    <td>{{ $rbc->bank_id }}</td>
                    <td>{{ $rbc->staff_id }}</td>
                    <td>{{ $rbc->refrigerator->name}}</td>
                    <td>{{ $rbc->bag_serial_number }}</td>
                    <td>{{ $rbc->group->name }}</td>
                    <td>{{ $rbc->hospital->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No Red Blood Cells Bags Issued.</td>
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
