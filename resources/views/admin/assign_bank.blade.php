@extends('layouts.admin_dashboard')
@section('breadcrumb')
Assign Staff
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-light" >{{ __('Assign Blood Bank') }}</div>

                <div class="card-body">

                    <form action="{{ url('admin/staff/assign/'.$staff->id) }}" method="POST" aria-label="{{ __('Assign Blood Bank') }}"">
                        {{ csrf_field() }}

                        <div class="form-group">
                            Name
                            <p class="hint--top" data-hint="Name" id="input-field">
                                <input type="text" name="name" class="form-control" value="{{ $staff->name }}" placeholder="Name">
                            </p>
                        </div>
                        <div class="form-group">
                            Email
                            <p class="hint--top" data-hint="Email" id="input-field">
                                <input type="text" name="email" class="form-control" value="{{ $staff->email }}" placeholder="Email">
                            </p>
                        </div>

                        <div class="form-group">
                            Blood Banks
                            <p class="hint--top" data-hint="Blood Bank" id="input-field">

                                <select  id="bank_id" type="text"  name="bank_id">
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                    </select>

                          </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="{{ url('admin/unassigned-staff') }}" class="btn btn-danger">Cancel</a>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
