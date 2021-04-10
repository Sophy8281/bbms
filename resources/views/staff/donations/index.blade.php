@extends('layouts.staff_dashboard')

@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('staff/add-donation')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>   New Donation</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Donations </div>
    <div class="panel-body">

        <table class="table">

            <tr>
                <th>#Id</th>
                <th>Donor</th>
                <th>Bank</th>
                <th>Bag Serial No.</th>
                <th>Blood Group</th>
                <th>status</th>
                <th>Created_on</th>
                <th>Actions</th>
            </tr>

            @foreach($donations as $donation)
            <tr>
                <td>{{ $donation->id }}</td>
                <td>{{ $donation->donor->name }}</td>
                <td>{{ $donation->bank->name }}</td>
                <td>{{ $donation->bag_serial_number }}</td>
                <td> <a class="btn btn-success" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">{{ $donation->blood_group }}
                    <i class="fas fa-heart"></i>
                    </a>
                </td>
                <td> <a class="btn btn-success" href="{{ URL::to('staff/add-blood-results/'.$donation->id) }}">{{ $donation->status  }}
                    <i class="fas fa-thumbs-up"></i>
                    </a>
                </td>
                <td>{{ date('F d, Y', strtotime($donation->created_at)) }}</td>
                <td>
                    <a href="{{ url('staff/donation/edit/'.$donation->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('staff/donation/delete/'.$donation->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach




        </table>


        {{ $donations->render() }}

    </div>

</div>

@stop
