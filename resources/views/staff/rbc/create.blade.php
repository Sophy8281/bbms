@extends('layouts.staff_dashboard')
@section('breadcrumb')
Store RBC
@endsection
@section('content')
{{-- <div>
    <a href="{{ URL::to('staff/all-refrigerators')  }}" class="btn btn-success">
        <i class=""></i>   All Refrigerators</a>
</div> --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Red Blood Cells to Stock') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('staff/rbc/add') }}" aria-label="{{ __('Add Red Blood Cells to Stock') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="refrigerator_id" class="col-md-4 col-form-label text-md-right">{{ __('Refrigerator Name') }}</label>

                            <div class="col-md-6">

                                <select  id="refrigerator_id" type="text"  name="refrigerator_id">
                                    @foreach ($refrigerators as $refrigerator)
                                    @if ($refrigerator->rbc->count() < $refrigerator->capacity && $refrigerator->rbc->count() != $refrigerator->capacity)
                                        <option value="{{ $refrigerator->id }}">{{ $refrigerator->name }}</option>
                                    @endif
                                    @endforeach
                                    </select>
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

                        <div class="form-group row">
                            <label for="group_id" class="col-md-4 col-form-label text-md-right">{{ __('Blood Group') }}</label>

                            <div class="col-md-6">

                                <select  id="group_id" type="text"  name="group_id">
                                    @foreach ($blood_groups as $blood_group)
                                        <option value="{{ $blood_group->id }}">{{ $blood_group->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="donation_date" class="col-md-4 col-form-label text-md-right">{{ __('Date of Donation') }}</label>

                            <div class="col-md-6">
                                <input id="donation_date" type="date" class="form-control datepicker @error('donation_date') is-invalid @enderror" name="donation_date">
                                @error('donation_date')
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
                                <a href="{{ url('staff/all-refrigerators') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
