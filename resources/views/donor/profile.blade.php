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
                                <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{ $user->name }}" placeholder="Name">
                            </p>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            Gender
                            <p class="hint--top" data-hint="Gender" id="input-field">
                                {{-- <input type="text" name="gender" class="form-control" value="{{ $user->gender }}" placeholder="Gender"> --}}
                                <select type="text" name="gender" class="form-control  @error('gender') is-invalid @enderror" value="{{ $user->gender }}" placeholder="Gender" aria-readonly="true">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </p>
                        </div>
                        <div class="form-group">
                            Date of Birth
                            <p class="hint--top" data-hint="Date of Birth" id="input-field">
                                <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ date('F d, Y', strtotime($user->birth_date)) }}" value="{{ old('birth_date') }}" required autocomplete="birth_date" autofocus>
                            </p>
                            @error('birth_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            Student Number/ID/Passport
                            <p class="hint--top" data-hint="unique_no" id="input-field">
                                <input type="text" name="unique_no" class="form-control  @error('unique_no') is-invalid @enderror" value="{{ $user->unique_no }}" value="{{ old('unique_no') }}" required autocomplete="unique_no" autofocus>
                            </p>
                            @error('unique_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            Postal Address
                            <p class="hint--top" data-hint="address" id="input-field">
                                <input type="text" name="address" class="form-control  @error('address') is-invalid @enderror" value="{{ $user->address }}">
                            </p>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            Phone
                            <p class="hint--top" data-hint="Phone" id="input-field">
                                <input type="tel" name="phone" class="form-control  @error('phone') is-invalid @enderror" value="{{ $user->phone }}" placeholder="Phone">
                            </p>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            County
                            <p class="hint--top" data-hint="County" id="input-field">
                                <input type="text" name="county" class="form-control  @error('county') is-invalid @enderror" value="{{ $user->county }}" placeholder="County">
                            </p>
                            @error('county')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
