@extends('layouts.admin_dashboard')
@section('breadcrumb')
Edit Donor
@endsection
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-ticket"></i> Edit Donor
    </div>
    <div class="panel-body">

        <form action="{{ url('admin/donor/edit/'.$user->id) }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                Name
                <p class="hint--top" data-hint="Name" id="input-field">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" placeholder="Name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Email
                <p class="hint--top" data-hint="Email" id="input-field">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" placeholder="Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Gender
                <p class="hint--top" data-hint="Gender" id="input-field">
                    <select type="text" name="gender" class="form-control  @error('gender') is-invalid @enderror" required autofocus aria-readonly="true">
                        <option value="{{ $user->gender }}" >{{ $user->gender }}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Student Number/ID/Passport
                <p class="hint--top" data-hint="unique_no" id="input-field">
                    <input type="text" name="unique_no" class="form-control @error('unique_no') is-invalid @enderror" value="{{ $user->unique_no }}">
                    @error('unique_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Date of Birth
                <p class="hint--top" data-hint="Date of Birth" id="input-field">
                    <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ $user->birth_date }}">
                    @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Postal Address
                <p class="hint--top" data-hint="address" id="input-field">
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $user->address }}">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Phone
                <p class="hint--top" data-hint="Phone" id="input-field">
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" placeholder="Phone">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                Blood Group
                <p class="hint--top" data-hint="Blood Group" id="input-field">
                    <select class="form-control @error('blood_group') is-invalid @enderror" id="blood_group" type="text"  name="blood_group" required>
                        @if ($user->blood_group )
                        <option value="{{ $user->blood_group }}">{{ $user->blood_group }}</option>
                        @endif
                        @foreach ($blood_groups as $blood_group)
                            <option value="{{ $blood_group->name }}">{{ $blood_group->name }}</option>
                        @endforeach
                    </select>
                    @error('blood_group')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <div class="form-group">
                County
                <p class="hint--top" data-hint="County" id="input-field">
                    <input type="text" name="county" class="form-control @error('county') is-invalid @enderror" value="{{ $user->county }}" placeholder="County">
                    @error('county')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </p>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('admin/all-donors') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
<br>
@stop
