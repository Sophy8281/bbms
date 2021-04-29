@extends('layouts.staff_dashboard')
@section('breadcrumb')
New Refrigerator
@endsection
@section('content')
<div>
    <a href="{{ URL::to('staff/all-refrigerators')  }}" class="btn btn-success">
        <i class=""></i>   All Refrigerators</a>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Refrigerator') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('staff/add-refrigerator') }}" aria-label="{{ __('Add New Donation') }}">
                        @csrf

                        {{-- <div class="form-group row">
                            <label for="blood_group" class="col-md-4 col-form-label text-md-right">{{ __('Blood Group') }}</label>

                            <div class="col-md-6">

                                <select  id="blood_group" type="text"  name="blood_group">
                                    @foreach ($blood_groups as $blood_group)
                                        <option value="{{ $blood_group->name }}">{{ $blood_group->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('Capacity') }}</label>

                            <div class="col-md-6">
                                <input id="capacity" type="text" class="form-control @error('capacity') is-invalid @enderror" name="capacity">

                                @error('capacity')
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
