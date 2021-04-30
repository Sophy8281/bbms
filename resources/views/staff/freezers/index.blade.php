@extends('layouts.staff_dashboard')
@section('breadcrumb')
Freezers
@endsection
@section('content')
@include('flash-message')

<div>
    <a href="{{ URL::to('staff/add-freezer') }}" class="btn btn-success">
        <i class="fa fa-plus-circle"></i>   New Freezer</a>
    <a href="{{ URL::to('staff/plasma/add')  }}" class="btn btn-success float-right">
        <i class="fa fa-plus-circle"></i>   Add Plasma to Stock</a>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-group"></i> Freezers(Store Plasma) </div>
    <div class="panel-body">

        <table class="table">

            <tr>
                <th>#Id</th>
                <th>Name</th>
                <th>Capacity</th>
                <th>Bags Count</th>
                <th>Actions</th>
            </tr>

            @foreach($freezers as $freezer)
            <tr>
                <td>{{ $freezer->id }}</td>
                <td>
                     <a style="text-decoration:underline;color:blue" href="{{ url('staff/freezer/show/'.$freezer->id) }}">{{ $freezer->name }}</a>
                </td>
                <td>{{ $freezer->capacity }}</td>
                @if ($freezer->plasma->count() < $freezer->capacity && $freezer->plasma->count() != $freezer->capacity)
                    <td>{{ $freezer->plasma->count() }}</td>
                {{-- @if ($count < $freezer->capacity && $count != $freezer->capacity)
                <td>{{ $count }}</td> --}}
                @else
                 <td>Full</td>
                @endif
                <td>
                    <a href="{{ url('staff/freezer/'.$freezer->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Open</a>
                    <a href="{{ url('staff/freezer/edit/'.$freezer->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ url('staff/freezer/delete/'.$freezer->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach
        </table>

        {{-- {{ $freezers->render() }} --}}

        {{ $freezers->links() }}
    </div>

</div>

@stop
