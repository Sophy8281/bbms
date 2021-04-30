@extends('layouts.app')
@section('breadcrumb')
Home
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-light">Bank Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Staff logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
