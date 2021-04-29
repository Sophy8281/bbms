@extends('layouts.admin_dashboard')
@section('breadcrumb')
Edit Blood Group
@endsection
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-ticket"></i> Edit Blood Group
    </div>
    <div class="panel-body">
        <form action="{{ url('admin/group/edit/'.$blood_group->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                Name
                <p class="hint--top" data-hint="Name" id="input-field">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $blood_group->name }}" placeholder="Name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('admin/all-blood-groups') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
@stop
