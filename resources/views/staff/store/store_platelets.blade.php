@extends('layouts.staff_dashboard')
@section('breadcrumb')
Store Platelets
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Platelets to Stock Form') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('staff/platelet/store/'.$processed_platelets->id) }}" aria-label="{{ __('Add Platelets to Stock') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="bag_serial_number" class="col-md-4 col-form-label text-md-right">{{ __('Bag Serial Number') }}</label>

                            <div class="col-md-6">
                                <input id="bag_serial_number" type="text" class="form-control @error('bag_serial_number') is-invalid @enderror" name="bag_serial_number" value="{{ $processed_platelets->platelet_bag_no}}" required autocomplete="bag_serial_number" readonly>

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
                                <input id="group_id" type="text" class="form-control @error('group_id') is-invalid @enderror" name="group_id" value="{{ $processed_platelets->group->name}}" required autocomplete="group_id" disabled>

                                @error('group_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agitator_id" class="col-md-4 col-form-label text-md-right">{{ __('Agitator Name') }}</label>

                            <div class="col-md-6">

                                <select  id="agitator_id" type="text" class="form-control @error('agitator_id') is-invalid @enderror" name="agitator_id">
                                    <option value="">Select Agitator to Store to</option>
                                    @foreach ($agitators as $agitator)
                                    @if ($agitator->platelets->count() < $agitator->capacity && $agitator->platelets->count() != $agitator->capacity)
                                        <option value="{{ $agitator->id }}">{{ $agitator->name }}</option>
                                    @endif
                                    @endforeach
                                    </select>
                                    @error('agitator_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="group_id" class="col-md-4 col-form-label text-md-right">{{ __('Blood Group') }}</label>

                            <div class="col-md-6">

                                <select  id="group_id" type="text"  name="group_id">
                                    @foreach ($blood_groups as $blood_group)
                                        <option value="{{ $blood_group->id }}">{{ $blood_group->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="donation_date" class="col-md-4 col-form-label text-md-right">{{ __('Date of Donation') }}</label>

                            <div class="col-md-6">
                                <input id="donation_date" type="date" class="form-control datepicker @error('donation_date') is-invalid @enderror" name="donation_date">
                                @error('donation_date')
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
                                <a href="{{ url('staff/platelets') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
