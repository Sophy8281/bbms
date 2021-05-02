@extends('layouts.staff_dashboard')
@section('breadcrumb')
Show Freezer
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Freezer: {{ $freezer->name }}</h4>
                </div>

                <div class="card-body">
                     <div class="pull-right">
                          <a class="btn btn-primary" href="{{ route('freezers.index') }}" title="Go back"> <i
                        class="fas fa-backward"> Back</i> </a>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-12">
                         <div class="form-group">
                             <strong>Name:</strong>
                             {{ $freezer->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Capacity:</strong>
                                {{ $freezer->capacity }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                             <div class="form-group">
                                 <strong>Bank:</strong>
                                 {{ $freezer->bank->name }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Added by:</strong>
                                    {{ $freezer->staff->name }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Date Created:</strong>
                                    {{ date('F d, Y h:m A', strtotime($freezer->created_at)) }}
                                    {{-- {{ date_format($refrigerator->created_at, 'jS M Y') }} --}}
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>

@endsection
