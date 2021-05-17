@extends('layouts.staff_dashboard')
@section('breadcrumb')
Add Results
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Test Results Form') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('staff/add-blood-results/'.$donations->id) }}" aria-label="{{ __('Add Blood Results') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="blood_group" class="col-md-4 col-form-label text-md-right">{{ __('Blood Group') }}</label>
                            <div class="col-md-6">
                                <select  id="blood_group" type="text"  name="group_id">
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
                                <a href="{{ URL::to('staff/unscreened-donations')  }}" class="btn btn-danger">
                                    <i class=""></i>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
