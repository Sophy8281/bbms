@extends('layouts.admin_dashboard')
@section('breadcrumb')
Donations
@endsection
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Donations </div>
    <div class="panel-body">
        <form  action="{{ url('admin/donations') }}" method ="POST">
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
            </div>
        </form>
        <div class="col-md">
            <table id="example" class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Donor</th>
                        <th>Bank</th>
                        <th>Bag SNo.</th>
                        <th>BGroup</th>
                        <th>status</th>
                        <th>Donated_At</th>
                        <th>Processed_At</th>
                        <th>Stored_At</th>
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
                        <td>{{ $donation->group->name }}</a>
                        </td>
                        @else
                        <td>Pending</td>
                        @endif
                        @if ( $donation->status)
                            @if ( $donation->status  == "Safe")
                            <td><p class="btn btn-success">{{ $donation->status  }}
                                <i class="fas fa-thumbs-up"></i>
                                </p>
                            </td>
                            @else
                            <td><p class="btn btn-danger">{{ $donation->status  }}
                                <i class="fas fa-thumbs-down"></i>
                                </p>
                            </td>
                            @endif
                        @else
                        <td>Pending</td>
                        @endif
                        <td>{{ $donation->created_at }}</td>
                        <td>{{ $donation->processed_at }}</td>
                        <td>{{ $donation->stored_at }}</td>
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
            paging:true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy', className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
                {extend: 'csv',  title: 'Donations', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
                {extend: 'excel', title: 'Donations', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
                {extend: 'pdf', title: 'Donations',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
                {extend: 'print', title: 'Donations', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
