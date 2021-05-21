@extends('layouts.staff_dashboard')
@section('breadcrumb')
New Donation
@endsection
@section('content')
@include('flash-message')
<div>
    <a href="{{ URL::to('staff/all-donations')  }}" class="btn btn-success">
        <i class="fa fa-handshake"></i>
        All Donations
    </a>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Donation Form') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('staff/add-donation') }}" aria-label="{{ __('Add New Donation') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="donor_id" class="col-md-4 col-form-label text-md-right">{{ __('Donor') }}</label>
                            <div class="col-md-6">
                                <select  id="donor_id" type="text"  class="form-control @error('donor_id') is-invalid @enderror" name="donor_id" value="{{ old('donor_id') }}" required>
                                    <option value="">Select Donor Number</option>
                                    @foreach ($donors as $donors)
                                    <option value="{{ $donors->id }}">{{ $donors->id }}</option>
                                    @endforeach
                                </select>
                                @error('donor_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bag_serial_number" class="col-md-4 col-form-label text-md-right">{{ __('Bag Serial Number') }}</label>
                            <div class="col-md-6">
                                <input id="bag_serial_number" type="text" class="form-control @error('bag_serial_number') is-invalid @enderror" name="bag_serial_number" value="{{ old('bag_serial_number') }}" required autocomplete="bag_serial_number">
                                @error('bag_serial_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="blood_group" class="col-md-4 col-form-label text-md-right">{{ __('Blood Group') }}</label>

                            <div class="col-md-6">
                                <input id="blood_group" type="text" class="form-control @error('blood_group') is-invalid @enderror" name="blood_group" autocomplete="blood_group">

                                @error('blood_group')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Blood Status') }}</label>

                            <div class="col-md-6">
                                <input id="status" type="status" class="form-control @error('status') is-invalid @enderror" name="status" autocomplete="status">
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ url('staff/all-donations') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
