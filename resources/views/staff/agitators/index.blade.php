@extends('layouts.staff_dashboard')
@section('breadcrumb')
Agitators
@endsection
@section('content')
@include('flash-message')

<div>
    <a href="{{ URL::to('staff/platelets/add')  }}" class="btn btn-success float-right">
        <i class="fa fa-plus-circle"></i>   Add Platelets to Stock</a>
    <a href="{{ URL::to('staff/add-agitator')  }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>   New Agitator</a>
</div>
<div class="panel panel-default"></div>
    <div class="panel-heading"><i class="fa fa-group"></i> Agitators(Store Platelets) </div>
    <div class="panel-body">

        <table class="table">

            <tr>
                <th>#Id</th>
                {{-- <th>Bank</th>
                <th>Staff</th> --}}
                <th>Name</th>
                <th>Capacity</th>
                <th>Bags Count</th>
                <th>Actions</th>
            </tr>

            @foreach($agitators as $agitator)
            <tr>
                <td>{{ $agitator->id }}</td>
                <td>
                    <a style="text-decoration:underline;color:blue" href="{{ url('staff/agitator/show/'.$agitator->id) }}">{{ $agitator->name }}</a>
                </td>
                <td>{{ $agitator->capacity }}</td>
                @if ($agitator->platelets->count() < $agitator->capacity && $agitator->platelets->count() != $agitator->capacity)
                    <td>{{ $agitator->platelets->count() }}</td>
                @else
                 <td>Full</td>
                @endif

                <td>
                    <a href="{{ url('staff/agitator/'.$agitator->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Open</a></a>
                    {{-- <a href="{{ url('staff/agitator/show/'.$agitator->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Show</a> --}}
                    <a href="{{ url('staff/agitator/edit/'.$agitator->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('staff/agitator/delete/'.$agitator->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach
        </table>

        {{-- {{ $agitators->render() }} --}}

    </div>

</div>

@stop
