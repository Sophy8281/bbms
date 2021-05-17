@extends('layouts.staff_dashboard')
@section('breadcrumb')
Edit Donation
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Donation') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('staff/donation/edit/'.$donation->id) }}" aria-label="{{ __('Add Blood Results') }}">
                        @csrf


                        {{-- <div class="form-group row">
                            <label for="donor_id" class="col-md-4 col-form-label text-md-right">{{ __('Donor ID') }}</label>

                            <div class="col-md-6">
                                <select  id="donor_id" type="text"  name="donor_id">
                                    @foreach ($donors as $donor)
                                        <option value="{{ $donor->id }}">{{ $donor->name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="bag_serial_number" class="col-md-4 col-form-label text-md-right">{{ __('Bag Serial Number') }}</label>
                            <div class="col-md-6">
                                <input id="bag_serial_number" type="text" class="form-control @error('bag_serial_number') is-invalid @enderror " name="bag_serial_number" value="{{ $donation->bag_serial_number }}" required>
                                @error('bag_serial_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="blood_group" class="col-md-4 col-form-label text-md-right">{{ __('Blood Group') }}</label>

                            <div class="col-md-6">
                                <select  id="blood_group" type="text"  name="group_id">
                                    @if($donation->group_id )
                                    <option value="{{ $donation->group_id }}">{{ $donation->group->name }}</option>
                                    @endif
                                    @foreach ($blood_groups as $blood_group)
                                        <option value="{{ $blood_group->id }}">{{ $blood_group->name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Blood Status') }}</label>

                            <div class="col-md-6">
                                <select name="status" id="status" class="form-control">
                                    @if($donation->status )
                                    <option value="{{ $donation->status }}">{{ $donation->status }}</option>
                                    @endif
                                    <option value="Safe">Safe</option>
                                    <option value="Unsafe">Unsafe</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ URL::to('staff/unscreened-donations')  }}" class="btn btn-danger">
                                    <i class=""></i>   Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
