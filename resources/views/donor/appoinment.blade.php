@extends('layouts.donor-app')

@section('content')
@include('flash-message')

<!-- ======= Appointment Section ======= -->
<section id="appointment" class="appointment section-bg">
    <div class="container">

      <div class="section-title">
        <h2>Make an Appointment</h2>
        <p>You can also make an appointment to come and donate at your preferred day and time. Don't hesitate to donate just because of your busy schedule, we have this better option for you. See you!</p>
      </div>

      <form action="{{ url('appointment/') }}" method="POST">
        @csrf
        <div class="form-row">
          <div class="col-md-4 form-group">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
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
          <div class="col-md-4 form-group">
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Your Phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-4 form-group">
            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" id="date" value="{{ old('date') }}" required autocomplete="date" autofocus>
            @error('date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-md-4 form-group">
            <select  id="bank_id" type="text" name="bank_id" class="form-control">
                <option value="">Select Bank</option>
                @foreach ($banks as $bank)
                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                @endforeach
                </select>
          </div>
          <div class="col-md-4 form-group">
            <select  id="group_id" type="text" name="group_id" class="form-control">
                <option value="">Select Blood Group</option>
                @foreach ($blood_groups as $blood_group)
                    <option value="{{ $blood_group->id }}">{{ $blood_group->name }}</option>
                @endforeach
                </select>

        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{ __('Make an Appointment') }}</button>
        </div>
      </form>
    </div>
</section>

@endsection
