@extends('layouts.staff_dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Donation') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('staff/donation/edit/'.$donation->id) }}" aria-label="{{ __('Add Blood Results') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="donor_id" class="col-md-4 col-form-label text-md-right">{{ __('Donor ID') }}</label>

                            <div class="col-md-6">
                                <select  id="donor_id" type="text"  name="donor_id">
                                    @foreach ($donors as $donor)
                                        <option>{{ $donor->id }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bag_serial_number" class="col-md-4 col-form-label text-md-right">{{ __('Bag Serial Number') }}</label>
                            <div class="col-md-6">
                                <input id="bag_serial_number" type="text" class="form-control @error('bag_serial_number') is-invalid @enderror " name="bag_serial_number" value="{{ $donation->bag_serial_number }}" required>
                                @error('bag_serial_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="blood_group" class="col-md-4 col-form-label text-md-right">{{ __('Blood Group') }}</label>

                            <div class="col-md-6">
                                <select  id="blood_group" type="text"  name="blood_group">
                                    @foreach ($blood_groups as $blood_group)
                                        <option>{{ $blood_group->name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Blood Status') }}</label>

                            <div class="col-md-6">
                                <select name="status" id="status" class="form-control">
                                    <option>Safe</option>
                                    <option>Unsafe</option>
                                </select>
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
