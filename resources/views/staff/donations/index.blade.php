@extends('layouts.staff_dashboard')
@section('breadcrumb')
Donations
@endsection
@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('staff/add-donation')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>   New Donation</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Donations </div>
    <div class="panel-body">
        <form  action="{{ url('staff/all-donations') }}" method ="POST">
            @csrf
            <div class="form-group row">
                <label for="date" class="col-form-label">Created At From</label>
                <div class="col-sm-3 col-md-3">
                    <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" required/>
                </div>
                <label for="date" class="col-form-label">Created At To</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control input-sm" id="toDate" name="toDate" required/>
                </div>
                <div class="col-sm">
                    <button type="submit" class="btn btn-primary" name="search" title="Search">Filter Range</button>
                </div>
                {{-- <div class="col-sm">
                    <a class="btn btn-primary" href="{{ url('staff/reports/donations') }}" target="_blank">Export All</a>
                </div> --}}
            </div>
        </form>
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
                        {{-- <th>Store/ Process/ Discard</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($donations as $donation)
                    <tr>
                        <td>{{ $donation->id }}</td>
                        <td>{{ $donation->donor->name }}</td>
                        <td>{{ $donation->bank->name }}</td>
                        <td>{{ $donation->bag_serial_number }}</td>
                        @if ($donation->group_id)
                        <td> <a class="btn btn-success" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">{{ $donation->group->name }}
                            <i class="fas fa-heart"></i>
                            </a>
                        </td>
                        @else
                        <td> <a class="btn btn-success" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">
                            <i class="fas fa-heart"></i>
                            </a>
                        </td>
                        @endif
                        @if ( $donation->status  == "Safe")
                        <td> <a class="btn btn-success" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">{{ $donation->status  }}
                            <i class="fas fa-thumbs-up"></i>
                            </a>
                        </td>
                        @else
                        <td> <a class="btn btn-danger" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">{{ $donation->status  }}
                            <i class="fas fa-thumbs-down"></i>
                            </a>
                        </td>
                        @endif
                        <td>{{ date('F d, Y', strtotime($donation->created_at)) }}</td>
                        <td>
                            <a href="{{ url('staff/donation/edit/'.$donation->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                            @if ($donation->status  == "Unsafe")
                            <a href="{{ url('staff/donation/delete/'.$donation->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Discard</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No donations.</td>
                    </tr>
                    @endforelse
                </tbody>
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
