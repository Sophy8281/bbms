<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Staff | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicons -->
  <link href="{{ asset('site/img/logo.png') }}" rel="icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- for export -->
  <link href="{{asset('frontend/assets/css/datatables.min.css')}}" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('frontend/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Chart Scripts -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('staff/') }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      {{-- <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('frontend/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('frontend/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('frontend/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> --}}
      {{-- <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }}<span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('staff.logout') }}" onclick="event.preventDefault();
                                 document.getElementById('staff-logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="staff-logout-form" action="{{ route('staff.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('frontend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Staff Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block">User: {{ Auth::user()->name }}</a>
          </div>
        </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
            <a href="{{ URL::to('staff/') }}" class="nav-link">
                <i class="fa fa-home"></i>
                <p>
                Home
                </p>
            </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa fa-calendar"></i>
                  <p>
                    Appointments
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ URL::to('/staff/appointments') }}" class="nav-link">
                      <i class="fa fa-calendar"></i>
                      <p>Appointments</p>
                    </a>
                </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa fa-ambulance"></i>
                  <p>
                    Drives
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ URL::to('staff/drives')  }}" class="nav-link">
                      <i class="fa fa-ambulance"></i>
                      <p>Drives</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ URL::to('staff/hosted')  }}" class="nav-link">
                      <i class="fa fa-ambulance"></i>
                      <p>Hosting Requests</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa fa-users"></i>
                  <p>
                    Donors
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ URL::to('/staff/all-users') }}" class="nav-link">
                      <i class="fa fa-users"></i>
                      <p>Donors</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('/staff/add-user') }}" class="nav-link">
                      <i class="fa fa-user-plus"></i>
                      <p>New Donor</p>
                    </a>
                </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa fa-handshake"></i>
                  <p>
                    Donation
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ URL::to('/staff/all-donations') }}" class="nav-link">
                      <i class="fa fa-handshake"></i>
                      <p>Donations</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ URL::to('/staff/add-donation') }}" class="nav-link">
                      <i class="fa fa-plus-circle"></i>
                      <p>New Donation</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa fa-flask"></i>
                  <p>
                    Screening
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ URL::to('/staff/unscreened-donations') }}" class="nav-link">
                      <i class="fa fa-plus-circle"></i>
                      <p>Add Test Results</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa fa-hourglass"></i>
                  <p>
                    Processing
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ URL::to('/staff/process') }}" class="nav-link">
                      <i class="fa fa-hourglass"></i>
                      <p>Process</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ URL::to('/staff/processed') }}" class="nav-link">
                      <i class="fa fa-hourglass"></i>
                      <p>All Processed</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa fa-archive"></i>
                  <p>
                   Storage
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ URL::to('staff/blood')  }}" class="nav-link">
                      <i class="fa fa-archive"></i>
                      <p>Store Blood</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ URL::to('staff/plasma')  }}" class="nav-link">
                      <i class="fa fa-archive"></i>
                      <p>Store Plasma</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ URL::to('staff/platelets')  }}" class="nav-link">
                      <i class="fa fa-archive"></i>
                      <p>Store Platelets</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ URL::to('staff/rbc')  }}" class="nav-link">
                      <i class="fa fa-archive"></i>
                      <p>Store RBC</p>
                    </a>
                  </li>
                  </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa fa-minus-circle"></i>
                  <p>
                   Issuance/Disposal
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ URL::to('/staff/requests') }}" class="nav-link">
                          <i class="fa fa-calendar"></i>
                          <p>Hospital Requests</p>
                        </a>
                    </li>
                  <li class="nav-item">
                    <a href="{{ URL::to('staff/all-agitators')  }}" class="nav-link">
                      <i class="fa fa-archive"></i>
                      <p>Agitators</p>
                    </a>
                  </li>
                    <li class="nav-item">
                      <a href="{{ URL::to('staff/all-freezers')  }}" class="nav-link">
                        <i class="fa fa-archive"></i>
                        <p>Freezers</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ URL::to('staff/all-refrigerators')  }}" class="nav-link">
                        <i class="fa fa-archive"></i>
                        <p>Refrigerators</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ URL::to('staff/cold-room')  }}" class="nav-link">
                        <i class="fa fa-archive"></i>
                        <p>Cold Room</p>
                      </a>
                    </li>
                  </ul>
              </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-minus-circle"></i>
              <p>
                Issued
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ URL::to('staff/blood/issued')  }}" class="nav-link">
                      <i class="fa fa-minus-circle"></i>
                      <p>Issued Blood</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a href="{{ URL::to('staff/plasma/issued')  }}" class="nav-link">
                    <i class="fa fa-minus-circle"></i>
                    <p>Issued Plasma</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('staff/platelets/issued')  }}" class="nav-link">
                    <i class="fa fa-minus-circle"></i>
                    <p>Issued platelets</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('staff/rbc/issued')  }}" class="nav-link">
                    <i class="fa fa-minus-circle"></i>
                    <p>Issued RBCs</p>
                    </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-trash"></i>
              <p>
                Discarded
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ URL::to('staff/blood/discarded')  }}" class="nav-link">
                      <i class="fa fa-trash"></i>
                      <p>Discarded Blood</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a href="{{ URL::to('staff/plasma/discarded')  }}" class="nav-link">
                    <i class="fa fa-trash"></i>
                    <p>Discarded Plasma</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('staff/platelets/discarded')  }}" class="nav-link">
                    <i class="fa fa-trash"></i>
                    <p>Discarded platelets</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('staff/rbc/discarded')  }}" class="nav-link">
                    <i class="fa fa-trash"></i>
                    <p>Discarded RBCs</p>
                    </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-book"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('staff/reports/donors') }}" class="nav-link" target="_blank">
                  <i class="fa fa-book"></i>
                  <p>Donors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('staff/reports/blood') }}" class="nav-link" target="_blank">
                  <i class="fa fa-book"></i>
                  <p>Whole Blood</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('staff/reports/plasma') }}" class="nav-link" target="_blank">
                  <i class="fa fa-book"></i>
                  <p>Plasma</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('staff/reports/platelets') }}" class="nav-link" target="_blank">
                  <i class="fa fa-book"></i>
                  <p>Platelets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('staff/reports/rbc') }}" class="nav-link" target="_blank">
                  <i class="fa fa-book"></i>
                  <p>Red Blood Cells</p>
                </a>
              </li>

            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Blood Bank Management System({{ Auth::user()->bank->name }} Branch)</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ URL::to('staff/') }}">Staff Dashboard</a></li>
              <li class="breadcrumb-item active">@yield('breadcrumb')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        {{-- <div class="row mb-2">
            <div class="col-sm">
              <h1 class="m-0 text-dark">This Is The Admin Dashboard For Blood Bank Management System. Feel Most Welcome!</h1>
              <main class="py-4">
                 @yield('content')
              </main>

            </div><!-- /.col -->
        </div><!-- /.row --> --}}
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <main class="">

                    <div class="">
                        @yield('content')
                    </div>

                {{-- @yield('content') --}}
             </main>
        </div>
    </section>
  </div>

  <!-- /.content-wrapper -->
  <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid"> --}}
        {{-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ URL::to('staff/') }}">Home</a></li>
              <li class="breadcrumb-item active">Staff Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row --> --}}
        {{-- <div class="row mb-2">
            <div class="col-sm">
              <h1 class="m-0 text-dark">Blood Bank Management System({{ Auth::user()->bank->name }} Branch)</h1>
              <main class="py-4">
                 @yield('content')
              </main>

            </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div> --}}

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">BBMS</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('frontend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('frontend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('frontend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('frontend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('frontend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('frontend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('frontend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('frontend/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('frontend/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('frontend/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('frontend/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('frontend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('frontend/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('frontend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('frontend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('frontend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('frontend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('frontend/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('frontend/dist/js/demo.js')}}"></script>
<!-- for export all -->
<script src="{{asset('frontend/assets/js/datatables.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $('.nav-item').click(function(event){
        event.preventDefault();
        $('.content').load($this).attr('href'));
    });
</script>
<script>
    const url = window.location;
    /*find active element add active class ,if it is inside treeview element, expand its elements and select treeview*/
    $('ul.nav-sidebar a').filter(function () {
        return this.href == url;
    }).addClass('active').closest(".has-treeview").addClass('menu-open').find("> a").addClass('active');
</script>
@yield('javascript')
</body>
</html>
