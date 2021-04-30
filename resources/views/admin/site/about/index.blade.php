@extends('layouts.admin_dashboard')
@section('breadcrumb')
About
@endsection
@section('content')
@include('flash-message')

<div class="container">

    <form action="{{ url('admin/about') }}" method="POST" aria-label="{{ __('Update About') }}">
        {{ csrf_field() }}

        <div class="form-group">
            History
            <p class="hint--top" data-hint="History" id="input-field">
                <textarea name="history" class="form-control @error('history') is-invalid @enderror" rows="5" cols="50">
                    {{ $about->history }}
                </textarea>
                @error('history')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </p>
        </div>
        <div class="form-group">
            Vision
            <p class="hint--top" data-hint="Vision" id="input-field">
                <textarea type="text" name="vision" class="form-control @error('vision') is-invalid @enderror" rows="1">
                    {{ $about->vision }}
                </textarea>
                @error('vision')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </p>
        </div>
        <div class="form-group">
            Mission
            <p class="hint--top" data-hint="Mission" id="input-field">
                <textarea type="text" name="mission" class="form-control @error('mission') is-invalid @enderror" rows="1">
                    {{ $about->mission }}
                </textarea>
                @error('mission')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </p>
        </div>
        <div class="form-group">
            Values
            <p class="hint--top" data-hint="Values" id="input-field">
                <textarea type="text" name="values" class="form-control @error('values') is-invalid @enderror" rows="1">
                    {{ $about->values }}
                </textarea>
                @error('values')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </p>
        </div>
        <div class="form-group">
            Objectives
            <p class="hint--top" data-hint="Objectives" id="input-field">
                <textarea type="text" name="objectives" class="form-control @error('objectives') is-invalid @enderror" rows="1">
                    {{ $about->objectives }}
                </textarea>
                @error('objectives')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </p>
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
</div>
@endsection
