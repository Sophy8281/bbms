@extends('layouts.staff_dashboard')
@section('breadcrumb')
New Donor
@endsection
@section('content')
<div>
    <a href="{{ URL::to('staff/all-users')  }}" class="btn btn-success">
        <i class="fa fa-users"></i>
        All Donors
    </a>
</div>
<hr>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{ __('Add New Donor Form') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('staff/add-user') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="email" class="col-md col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unique_no" class="col-md col-form-label text-md-right">{{ __('Student Number/ ID/Passport') }}</label>
                            <div class="col-md-4">
                                <input id="unique_no" type="text" class="form-control @error('unique_no') is-invalid @enderror" name="unique_no" value="{{ old('unique_no') }}" required autocomplete="unique_no">
                                @error('unique_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="phone" class="col-md col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-4">
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birth_date" class="col-md col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                            <div class="col-md-4">
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date">
                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="gender" class="col-md col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="col-md-4">
                                <select type="text" name="gender" class="form-control" placeholder="Gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md col-form-label text-md-right">{{ __('Postal Address') }}</label>
                            <div class="col-md-4">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="county" class="col-md col-form-label text-md-right">{{ __('County of Residence') }}</label>
                            <div class="col-md-4">
                                <input id="county" type="text" class="form-control @error('county') is-invalid @enderror" name="county" value="{{ old('county') }}" required autocomplete="county">
                                @error('county')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
