@extends('layouts.admin_dashboard')
@section('breadcrumb')
Donors
@endsection
@section('content')
@include('flash-message')
<form  action="{{ url('admin/all-donors') }}" method ="POST">
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
        <div class="col-sm">
            <button type="submit" class="btn btn-primary" name="search" title="Search">Filter Range</button>
        </div>
        {{-- <div class="col-sm">
            <a class="btn btn-primary" href="{{ url('admin/reports/donors') }}" target="_blank">Export All</a>
        </div> --}}
    </div>
</form>

<table id="example" class="table table-responsive table-hover">
    <thead>
        <tr>
            <th>#Id</th>
            {{-- <th>@sortablelink('name','Name')</th>
            <th>@sortablelink('email','Email')</th> --}}
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>DoB</th>
            <th>Phone</th>
            <th>B_Group</th>
            <th>Residence</th>
            <th>Created_on</th>
            <th>Actions</th>
        </tr>
    </thead>
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
        <td>
            <a href="{{ url('admin/donor/edit/'.$user->id) }}" class="bg-info" ><i class="fa fa-edit"></i> Edit</a><br>
            <a href="{{ url('admin/donor/delete/'.$user->id) }}" class="bg-danger" onclick="return confirm('Are you sure you want to delete {{ $user->name }}?')"><i class="fa fa-trash"></i> Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@stop

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
                {extend: 'copy', exportOptions: { columns: [0,1,2,3,4,5,6,7,8] }, title: 'Donors', className: 'btn btn-outline-primary btn-lg', text:'<i class="fa fa-copy"></i>' },
                {extend: 'csv', exportOptions: { columns: [0,1,2,3,4,5,6,7,8] }, title: 'Donors', className: 'btn btn-primary btn-outline btn-lg',text:'<i class="fa fa-file-csv"></i>'},
                {extend: 'excel', exportOptions: { columns: [0,1,2,3,4,5,6,7,8] }, title: 'Donors', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-excel"></i>'},
                {extend: 'pdf', exportOptions: { columns: [0,1,2,3,4,5,6,7,8] }, title: 'Donors',  className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-file-pdf"></i>'},
                {extend: 'print', exportOptions: { columns: [0,1,2,3,4,5,6,7,8] }, title: 'Donors', className: 'btn btn-primary btn-outline btn-lg', text:'<i class="fa fa-print"></i>',
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
