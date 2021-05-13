@extends('layouts.staff_dashboard')
@section('breadcrumb')
Show Agitator
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Agitator: {{ $agitator->name }}</h4>
                </div>

                <div class="card-body">
                     <div class="pull-right">
                          <a class="btn btn-primary" href="{{ route('agitators.index') }}" title="Go back"> <i
                        class="fas fa-backward"> Back</i> </a>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-12">
                         <div class="form-group">
                             <strong>Name:</strong>
                             {{ $agitator->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Capacity:</strong>
                                {{ $agitator->capacity }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                             <div class="form-group">
                                 <strong>Bank:</strong>
                                 {{ $agitator->bank->name }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Date Created:</strong>
                                    {{ date('F d, Y h:m A', strtotime($agitator->created_at)) }}
                                    {{-- {{ date_format($agitator->created_at, 'jS M Y') }} --}}
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>

@endsection
