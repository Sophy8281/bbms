@extends('layouts.staff_dashboard')
@section('content')
@include('flash-message')
<div class="panel panel-default">
    <div class="panel-heading"><h5>Safe Blood </h5></div>
    <div class="panel-body">
        <div class="col-md">
            <table id="example" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#Id</th>
                        <th>Donor</th>
                        <th>Bank</th>
                        <th>Bag Serial No.</th>
                        <th>Blood Group</th>
                        <th>status</th>
                        <th>Created_on</th>
                        <th>Store/ Process</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($safe_blood as $safe_blood)
                    <tr>
                        <td>{{ $safe_blood->id }}</td>
                        <td>{{ $safe_blood->donor->name }}</td>
                        <td>{{ $safe_blood->bank->name }}</td>
                        <td>{{ $safe_blood->bag_serial_number }}</td>
                        <td>{{ $safe_blood->group->name }}</td>
                        <td>{{ $safe_blood->status  }}</td>
                        <td>{{ date('F d, Y', strtotime($safe_blood->created_at)) }}</td>
                        <td>
                            <a href="{{ url('staff/process/process/'.$safe_blood->id) }}" class="btn btn-info"> Process</a>
                            <a href="{{ url('staff/process/store/'.$safe_blood->id) }}" class="btn btn-info"> Store</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">No unprocessed/unstored blood.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
