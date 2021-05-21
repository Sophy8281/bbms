@extends('layouts.staff_dashboard')
@section('breadcrumb')
Processing
@endsection
@section('content')
@include('flash-message')

<div class="panel panel-default">
    <div class="panel-heading"><h5>Blood Processing</h5></div>
    <div class="panel-body">
        <form method="POST" action="{{ url('staff/process/'.$unprocessed->id) }}" aria-label="{{ __('Process Blood') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Bag Serial Number') }}</label>

                <div class="col-md-6">
                    <input type="text" name="bag_serial_number" class="form-control @error('bag_serial_number') is-invalid @enderror" value="{{ $unprocessed->bag_serial_number }}" disabled>
                    @error('bag_serial_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('plasma Bag SNo') }}</label>

                <div class="col-md-6">
                    <input type="text" name="plasma_bag_no" class="form-control @error('plasma_bag_no') is-invalid @enderror" value="{{ old('plasma_bag_no') }}" autofocus>
                    @error('plasma_bag_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Platelet Bag SNo') }}</label>

                <div class="col-md-6">
                    <input type="text" name="platelet_bag_no" class="form-control @error('platelet_bag_no') is-invalid @enderror" value="{{ old('platelet_bag_no') }}" autofocus>
                    @error('platelet_bag_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('RBC Bag SNo') }}</label>

                <div class="col-md-6">
                    <input type="text" name="rbc_bag_no" class="form-control @error('rbc_bag_no') is-invalid @enderror" value="{{ old('rbc_bag_no') }}" autofocus>
                    @error('rbc_bag_no')
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
                    <a href="{{ url('staff/process') }}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
