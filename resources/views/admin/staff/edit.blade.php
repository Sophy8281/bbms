@extends('layouts.admin_dashboard')
@section('breadcrumb')
Edit Staff
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light" >{{ __('Edit Staff') }}</div>
                <div class="card-body">
                    <form action="{{ url('admin/staff/edit/'.$staff->id) }}" method="POST" aria-label="{{ __('Assign Blood Bank') }}"">
                        {{ csrf_field() }}

                        <div class="form-group">
                            Name
                            <p class="hint--top" data-hint="Name" id="input-field">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $staff->name }}" placeholder="Name">
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
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $staff->email }}" placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </p>
                        </div>

                        <div class="form-group">
                            Blood Banks
                            <p class="hint--top" data-hint="Blood Bank" id="input-field">

                                <select  id="bank_id" type="text" name="bank_id" class="form-control @error('bank_id') is-invalid @enderror">
                                    @if ($staff->bank_id)
                                    <option value="{{ $staff->bank->name }}">{{ $staff->bank->name }}</option>
                                    @endif
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                                @error('bank_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                          </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="{{ url('admin/all-staff') }}" class="btn btn-danger">Cancel</a>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
