@extends('layouts.app')

@section('content')
@include('flash-message')

<!-- ======= Start Host a Blood Drive Section ======= -->
<section id="appointment" class="appointment section-bg">
    <div class="container">

        <div class="section-title">
            <h2>Host a Blood Drive </h2>
            <p>You can also host a blood drive at your organization/community. Don't hesitate to donate just because of your busy schedule, we have this better option for you. See you!</p>
        </div>

        <form action="{{ url('host/') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="col-md-4 form-group">
                    <input type="text" name="organization" class="form-control @error('organization') is-invalid @enderror" id="organization" placeholder="Your Organization" value="{{ old('organization') }}" required autocomplete="organization" autofocus>
                    @error('organization')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" id="location" placeholder="Your Location" value="{{ old('location') }}" required autocomplete="location" autofocus>
                    @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 form-group">
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Your Phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" id="date" value="{{ old('date') }}" required autocomplete="date" autofocus>
                    @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-4 form-group">
                    <input type="text" name="population" class="form-control @error('population') is-invalid @enderror" id="name" placeholder="Your Population" value="{{ old('population') }}" required autocomplete="population" autofocus>
                    @error('population')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 form-group">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Contact Person" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <select  id="bank_id" type="text" name="bank_id" class="form-control @error('bank_id') is-invalid @enderror" required autofocus>
                        <option value="">Select Bank to Host</option>
                        @foreach ($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                        @endforeach
                    </select>
                    @error('bank_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <textarea type="text" name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" value="{{ old('comment') }}" placeholder="Additional comments"  autocomplete="comment" autofocus></textarea>
                    @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">{{ __('Send Request') }}</button>
            </div>
        </form>
    </div>
</section>

@endsection
