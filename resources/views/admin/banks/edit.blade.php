@extends('layouts.admin_dashboard')
@section('breadcrumb')
Edit Bank
@endsection
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-ticket"></i> Edit Bank
    </div>
    <div class="panel-body">
        <form action="{{ url('admin/bank/edit/'.$bank->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                Name
                <p class="hint--top" data-hint="Name" id="input-field">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $bank->name }}" placeholder="Name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Email
                <p class="hint--top" data-hint="Email" id="input-field">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $bank->email }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Phone
                <p class="hint--top" data-hint="Phpne" id="input-field">
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $bank->phone }}">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                County
                <p class="hint--top" data-hint="County" id="input-field">
                    <input type="text" name="county" class="form-control @error('county') is-invalid @enderror" value="{{ $bank->county }}">
                    @error('county')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('admin/all-banks') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
@stop
