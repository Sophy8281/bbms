@extends('layouts.staff_dashboard')

@section('content')
@include('flash-message')

<div>
    <a href="{{ URL::to('staff/add-refrigerator')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>   New Refrigerator</a>
        <a href="{{ URL::to('staff/rbc/add')  }}" class="btn btn-success float-right">
            <i class="fa fa-plus-circle"></i>   Add RBC to Stock</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Refrigerators </div>
    <div class="panel-body">

        <table class="table">

            <tr>
                <th>#Id</th>
                <th>Name</th>
                <th>Capacity</th>
                <th>Bags Count</th>
                <th>Actions</th>
            </tr>

            @foreach($refrigerators as $refrigerator)
            <tr>
                <td>{{ $refrigerator->id }}</td>
                <td>
                    <a style="text-decoration:underline;color:blue" href="{{ url('staff/refrigerator/show/'.$refrigerator->id) }}">{{ $refrigerator->name }}</a></td>
                <td>{{ $refrigerator->capacity }}</td>
                @if ($refrigerator->rbc->count() < $refrigerator->capacity && $refrigerator->rbc->count() != $refrigerator->capacity)
                    <td>{{ $refrigerator->rbc->count() }}</td>
                @else
                 <td>Full</td>
                @endif
                <td>
                    <a href="{{ url('staff/refrigerator/'.$refrigerator->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Open</a>
                    <a href="{{ url('staff/refrigerator/edit/'.$refrigerator->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('staff/refrigerator/delete/'.$refrigerator->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach
        </table>

        {{-- {{ $refrigerators->render() }} --}}

    </div>

</div>

@stop
