@extends('layouts.staff_dashboard')
@section('breadcrumb')
Store Plasma
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Plasma to Stock') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('staff/plasma/store/'.$processed_plasma->id) }}" aria-label="{{ __('Add Plasma to Stock') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="bag_serial_number" class="col-md-4 col-form-label text-md-right">{{ __('Bag Serial Number') }}</label>

                            <div class="col-md-6">
                                <input id="bag_serial_number" type="text" class="form-control @error('bag_serial_number') is-invalid @enderror" name="bag_serial_number" value="{{ $processed_plasma->plasma_bag_no}}" required autocomplete="bag_serial_number" readonly>

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
                                <input id="group_id" type="text" class="form-control @error('group_id') is-invalid @enderror" name="group_id" value="{{ $processed_plasma->group->name}}" required autocomplete="group_id" disabled>

                                @error('group_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="freezer_id" class="col-md-4 col-form-label text-md-right">{{ __('Freezer Name') }}</label>

                            <div class="col-md-6">

                                <select  id="freezer_id" type="text" class="form-control @error('freezer_id') is-invalid @enderror" name="freezer_id">
                                    <option value="">Select Freezer to Store to</option>
                                    @foreach ($freezers as $freezer)
                                    @if ($freezer->plasma->count() < $freezer->capacity && $freezer->plasma->count() != $freezer->capacity)
                                        <option value="{{ $freezer->id }}">{{ $freezer->name }}</option>
                                    @endif
                                    @endforeach
                                    </select>
                                    @error('freezer_id')
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
                                <a href="{{ url('staff/plasma') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
