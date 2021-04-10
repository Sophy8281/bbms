@extends('layouts.admin_dashboard')

@section('content')
<form  action="{{ url('/test_table') }}" method ="POST">
    @csrf
    <div class="form-group row">
        <label for="date" class="col-form-label">Created At From</label>
        <div class="col-sm-3">
            <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" required/>
        </div>
        <label for="date" class="col-form-label">Created At To</label>
        <div class="col-sm-3">
            <input type="date" class="form-control input-sm" id="toDate" name="toDate" required/>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary" name="search" title="Search">Filter</button>
        </div>
    </div>
</form>
<table id="example" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>#Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>DoB</th>
        <th>Phone</th>
        <th>B_Group</th>
        <th>Residence</th>
        <th>Created_on</th>

    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->gender }}</td>
        <td>{{ date('F d, Y', strtotime($user->birth_date)) }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{ $user->blood_group }}</td>
        <td>{{ $user->county }}</td>
        <td>{{ date('F d, Y h:m A', strtotime($user->created_at)) }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
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
