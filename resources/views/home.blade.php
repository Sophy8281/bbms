@extends('layouts.app')

@section('content')
@include('flash-message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-danger text-light">{{ __('Donor Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    Hi there, Donor

                    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2>Profile</h2>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> --}}

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  {{-- <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('frontend/dist/img/user4-128x128.jpg')}}"
                       alt="User profile picture"> --}}
                </div>
                {{-- <a href="{{ url('profile/'.$user->id) }}"class="btn btn-info"><i class="fa fa-edit"></i> Edit Profile</i></a> --}}

                <h5 class="profile-username text-center">Name: {{ Auth::user()->name }}</h5>

                <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">{{ Auth::user()->gender }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Born</b>
                    @if ( Auth::user()->birth_date )
                    <a class="float-right">{{ date('F d, Y', strtotime(Auth::user()->birth_date)) }}</a>
                    @endif
                  </li>
                  <li class="list-group-item">
                    <b>Phone</b> <a class="float-right">{{ Auth::user()->phone }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Blood Group</b> <a class="float-right">{{ Auth::user()->blood_group }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>County of Residence</b> <a class="float-right">{{ Auth::user()->county }}</a>
                  </li>
                </ul>
                <a href="{{ url('profile/'.$user->id) }}" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Edit Profile</a>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> --}}
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="activity">

                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-group"></i> Donation History </div>
                        <div class="panel-body">

                            <table class="table">

                                <tr>
                                    <th>Bag Serial No.</th>
                                    <th>Blood Group</th>
                                    <th>status</th>
                                </tr>

                                @forelse($donations as $donation)
                                <tr>
                                    <td>{{ $donation->bag_serial_number }}</td>
                                    <td> <a class="btn btn-success" href="">{{ $donation->status  }}
                                        <i class="fas fa-thumbs-up"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No donations found.</td>
                                </tr>
                                @endforelse


                            </table>

                            {{ $donations->render() }}

                            {{-- <p>Next donation date: </p> --}}

                        </div>

                    </div>

                  </div>
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                 </div>
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="settings">

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
