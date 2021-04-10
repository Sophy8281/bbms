@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-danger text-light" >{{ __('Edit Profile') }}</div>

                <div class="card-body">

                    <form action="{{ url('profile/'.$user->id) }}" method="POST" aria-label="{{ __('Profile') }}"">
                        {{ csrf_field() }}

                        <div class="form-group">
                            Name
                            <p class="hint--top" data-hint="Name" id="input-field">
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Name">
                            </p>
                        </div>
                        <div class="form-group">
                            Gender
                            <p class="hint--top" data-hint="Gender" id="input-field">
                                {{-- <input type="text" name="gender" class="form-control" value="{{ $user->gender }}" placeholder="Gender"> --}}
                                <select type="text" name="gender" class="form-control" value="{{ $user->gender }}" placeholder="Gender" aria-readonly="true">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </p>
                        </div>
                        <div class="form-group">
                            Date of Birth
                            <p class="hint--top" data-hint="Date of Birth" id="input-field">
                                <input type="date" name="birth_date" class="form-control" value="{{ date('F d, Y', strtotime($user->birth_date)) }}">
                            </p>
                        </div>
                        <div class="form-group">
                            Student Number/ID/Passport
                            <p class="hint--top" data-hint="unique_no" id="input-field">
                                <input type="text" name="unique_no" class="form-control" value="{{ $user->unique_no }}">
                            </p>
                        </div>
                        <div class="form-group">
                            Postal Address
                            <p class="hint--top" data-hint="address" id="input-field">
                                <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                            </p>
                        </div>
                        <div class="form-group">
                            Phone
                            <p class="hint--top" data-hint="Phone" id="input-field">
                                <input type="tel" name="phone" class="form-control" value="{{ $user->phone }}" placeholder="Phone">
                            </p>
                        </div>
                        <div class="form-group">
                            County
                            <p class="hint--top" data-hint="County" id="input-field">
                                <input type="text" name="county" class="form-control" value="{{ $user->county }}" placeholder="County">
                            </p>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="{{ url('home/') }}" class="btn btn-primary"><i class=""></i> Back</a>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
