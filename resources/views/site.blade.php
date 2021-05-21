<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>BBMS | Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicons -->
    <link href="{{ asset('site/img/logo.png') }}" rel="icon">
    {{-- <!-- CSS -->
    <link rel="stylesheet" href="css/all.css" />
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" /> --}}
    <!-- Icons -->
    <link href="{{ asset('site/icofont/icofont.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('site/boxicons/css/boxicons.min.css') }}" rel="stylesheet"/>

    <!-- Scripts -->
    <script src="{{ asset('site/js/main.js') }}" defer></script>
    <script src="{{ asset('site/js/jquery.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('site/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>

<!-- ======= Start Body ======= -->
<body>

    <!-- ======= Start Top Bar ======= -->
    {{-- Display control on different screens, transform direct children elements into
        flex items on large screens, align items at the center and  have it fixed on top--}}
    <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="icofont-clock-time"></i> Monday - Saturday, 7AM to 10PM
            </div>
            <div class="d-flex align-items-center">
                <i class="icofont-phone"></i> Call us now +254 299-999-999
            </div>
        </div>
    </div>
    <!-- ======= End Top Bar ======= -->

    <!-- ======= Start Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <a href="{{ url('/')}}" class="logo mr-auto"><img src="{{ asset('site/img/logo.jpg') }}" alt="Logo"></a>
            <!-- Using an image logo -->
            <!-- <h1 class="logo mr-auto"><a href="index.html">Donate Blood</a></h1> -->

            <!--  Start nav-menu -->
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="active"><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#why">Why Donate</a></li>
                    <li><a href="#donation">Donation Process</a></li>
                    <li><a href="#departments">Departments</a></li>
                    <li><a href="#drives">Blood Drives</a></li>
                    {{-- <li><a href="#contact">Contact</a></li> --}}

                    <li><a href="{{ url('appointment/') }}" class="" target="_blank">Book an Appointment</a></li>
                    <li><a href="{{ route('register')}}" target="_blank">Become a Donor</a></li>
                    <li><a href="{{ url('host/') }}" class="" target="_blank">Host a Drive</a></li>

                </ul>
            </nav>
            <!--  End nav-menu -->
        </div>
    </header>
    <!-- ======= End Header ======= -->

    <!-- ======= Start Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url('{{ asset('site/img/slide/images3.jpg') }}')">
                    <div class="container">
                        <h2>Welcome to <span>Donate Blood</span></h2>
                        <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
                        <a href="#about" class="btn-get-started scrollto">Read More</a>
                        <a href="#appointment" class="btn-get-started scrollto">Book Appointment</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url('{{ asset('site/img/slide/images2.jpg') }}')">
                    <div class="container">
                        <h2>Donate Today</h2>
                        <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
                        <a href="#about" class="btn-get-started scrollto">Read More</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url('{{ asset('site/img/slide/slide-2.jpg') }}')">
                    <div class="container">
                        <h2>Save Lives</h2>
                        <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel.</p>
                        <a href="#about" class="btn-get-started scrollto">Read More</a>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </section>
    <!-- ======= End Hero Section ======= -->

    <main id="main">

        <!-- ======= Start About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>About Us</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row">
                    <div class="col-lg-6" data-aos="fade-right">
                        <img src="{{asset('site/img/about-us.jpg')}}" class="img-fluid" alt="about us">
                            <h4>Our Objectives</h4>
                            {{ $about->objectives}}
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
                        <h3>History & Background</h3>
                        <p class="font-italic">We exist to serve the community </p>
                        <p>{{ $about->history}}</p>

                        <h4>Our Vision</h4>
                        {{ $about->vision}}

                        <h4>Our Mission</h4>
                        {{ $about->mission}}

                        <h4>Our Core Values</h4>
                        {{ $about->values}}
                    </div>
                </div>

            </div>
        </section>
        <!-- ======= End About Us Section ======= -->

        <!-- ======= Start Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Accomplishments</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row no-gutters">

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="icofont-users"></i>
                            <span data-toggle="counter-up">{{ $donors->count() }}</span>
                            <p><strong>Happy Donors</strong></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="icofont-institution"></i>
                            <span>{{ $banks->count() }}</span>
                            <p><strong>Blood Banks</strong></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="icofont-laboratory"></i>
                            <span>{{ $banks->count() }}</span>
                            <p><strong>Test Labs</strong></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="icofont-award"></i>
                            <span>150</span>
                            <p><strong>Awards</strong></p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- ======= End Counts Section ======= -->

        <!-- ======= Start Why Section ======= -->
    <section id="why" class="why section-bg">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>Why Donate</h2>
            <p>You might be asking why you need to donate. Here we have all the reasons why your action of kindness is needed.</p>
          </div>
          <div class="row">

              <div class="col-md-6">
                <p>We need to make sure that we have enough supplies of all blood groups and blood products to treat all types of conditions in health facilities.</p>
                <p>By giving blood, every donor helps us meet the challenge of providing life-saving products whenever and wherever they are needed in Health facilities.</p>
                <h4>Maintaining the blood supply</h4>
                <p>We need to maintain a regular supply of all blood groups and products so we can provide it to the hospitals and patients who need it.</p>
                <p>We sometimes need to target specific blood types to increase stock levels. That's why we sometimes contact regular donors with the particular blood type we need, and ask them to give blood. We are indebted to our regular blood donors for their role in helping us to save lives.</p>
            </div>
              <div class="col-md-6">
                <h4>Rare blood types</h4>
                <p>O Rh negative blood is rare but essential because it is the only blood type that can be given to anyone, regardless of their blood type.</p>
                <h4>Blood components</h4>
                <p>Your blood's main components are red cells, plasma and platelets. These are used to treat many different illnesses and conditions.</p>
                <p>They have a short shelf life, so we always need to top up the supply:</p>
                <li><i class="icofont-check-circled text-danger"></i>red blood cells can be stored for up to 35 days</li>
                <li><i class="icofont-check-circled text-danger"></i>plasma can be stored for up to a year</li>
                <li><i class="icofont-check-circled text-danger"></i>platelets can be stored for up to 7 days</li>
              </div>
            </div>
        </div>



        </div>
      </section>
      <!-- ======= Start Why Section ======= -->

        {{-- <!-- ======= Appointment Section ======= -->
    <section id="appointment" class="appointment section-bg">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>Make an Appointment</h2>
            <p>You can also make an appointment to come and donate at your preferred day and time. Don't hesitate to donate just because of your busy schedule, we have this better option for you. See you!</p>
          </div>

          <form action="{{ url('/test') }}" method="post" role="form">
            @csrf
        <div class="form-row">
          <div class="col-md-4 form-group">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Your Name" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-md-4 form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Your Email" required>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-md-4 form-group">
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Your Phone" required>
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-4 form-group">
            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" id="date" placeholder="Appointment Date" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
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
      </section><!-- End Appointment Section --> --}}

      <!-- ======= Start Drives Section ======= -->
    <section id="drives" class="drives section-bg">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>Blood Drives</h2>
            <p>You can also visit us at our drives organized at different places on set days and time.</p>
          </div>
          <div class="row">
            <table class="table">
                <tr>
                    <th>Organized By</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                @forelse ($drives as $drive)
                    <tr>
                        <td>{{ $drive->bank->name }} Blood Bank</td>
                        <td>{{ $drive->location }}</td>
                        <td>{{ date('F d, Y', strtotime($drive->date)) }}</td>
                        <td>{{ $drive->time }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No Scheduled drives.</td>
                    </tr>
                @endforelse
            </table>
          </div>



        </div>
      </section>
      <!-- ======= Start Drives Section ======= -->

        <!-- ======= Start Donation Process ======= -->
        <section id="donation" class="donation donation">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Blood Donation Process</h2>
                    <p>The blood donation process from the time you arrive until the time you leave takes about an hour. The donation itself is only about 8-10 minutes on average.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon"><i class="icofont-ui-add"></i></div>
                        <h4 class="title"><a href="">Registration</a></h4>
                        <p class="description">You need to complete a very simple registration online which contains all required contact information needed to begin the donation process.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon"><i class="icofont-thermometer"></i></div>
                        <h4 class="title"><a href="">Screening</a></h4>
                        <p class="description">A drop of blood from your finger will be taken for a simple test to ensure that your blood iron levels are suitable for donating blood.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon"><i class="icofont-blood"></i></div>
                        <h4 class="title"><a href="">Donation</a></h4>
                        <p class="description">After passing the screening test successfully, you will be directed to a donor bed for donation. This takes between 6-10 minutes only.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon"><i class="icofont-cola"></i></div>
                        <h4 class="title"><a href="">Refreshment</a></h4>
                        <p class="description">You will receive some refreshments from us in donation zone.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon"><i class="icofont-simple-smile"></i></div>
                        <h4 class="title"><a href="">Recovery</a></h4>
                        <p class="description">You can stay in the waiting area until you feel strong enough to leave our center.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon"><i class="icofont-laboratory"></i></div>
                        <h4 class="title"><a href="">Testing</a></h4>
                        <p class="description">Blood is tested for HIV, Hepatitis A & B among other infections.</p>
                    </div>
                </div>

            </div>
        </section>
         <!-- ======= End Donation Process ======= -->

        <!-- ======= Start Departments Section ======= -->
        <section id="departments" class="departments">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Departments</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#tab-1">
                                    <h4>Donation</h4>
                                    <p>Blood is collected from the donor at the donation centers.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-toggle="tab" href="#tab-2">
                                    <h4>Screening</h4>
                                    <p>Blood banks type and perform tests on the blood.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-toggle="tab" href="#tab-3">
                                    <h4>Processing</h4>
                                    <p>Blood banks breakdown blood into different blood components.</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-toggle="tab" href="#tab-4">
                                    <h4>Storage</h4>
                                    <p>The different blood components are stored in the blood banks storage facilities.</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1">
                                <h3>Donation</h3>
                                <p class="font-italic">Donation is a blood bank facet that takes place in the donation centers.</p>
                                <img src="{{asset('site/img/blood-donation.jpg')}}" alt="" class="img-fluid">
                                <p>We recruit and mobilize blood donors to ensure sufficient safe blood for needy Kenyans by holding blood campaigns. Blood events are scheduled regulary when blood levels in our banks run low. At the donation centers, about 1 pint of blood is collected; several small test tubes of blood are also collected for testing. The blood bag and the test tube are then labeled with the same label and kept on ice for transportation to the center for processing.</p>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <h3>Screening</h3>
                                <p class="font-italic">Blood screening is a blood bank facet that takes place in our laboratories.</p>
                                <img src="{{asset('site/img/blood-screening.jpg')}}" alt="" class="img-fluid">
                                <p>The test tubes are taken to the lab.A dozen tests are performed on samples in the test tubes to establish the blood type and test for infectious diseases to ensure patients receive non-reactive blood.</p>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <h3>Processing</h3>
                                <p class="font-italic">Blood processing is a blood bank facet that takes place in our bank centrifuges.</p>
                                <img src="{{asset('site/img/blood-processing.gif')}}" alt="" class="img-fluid">
                                <p>Most whole blood donations are filtered to remove white blood cells and then spun in centrifuges to separate it into transfusable components: red cells, platelets, and plasma.</p>
                            </div>
                            <div class="tab-pane" id="tab-4">
                                <h3>Storage</h3>
                                <p class="font-italic">Blood Storage is a blood bank facet that takes place in the blood banks storage facilities.</p>
                                <img src="{{asset('site/img/blood-storage.jpg')}}" alt="" class="img-fluid">
                                <p>Different blood components are stored in different storage facilities: refrigerators, agitators, freezers and cold rooms.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- ======= End Departments Section ======= -->

        <!-- Testimonials Start -->
        {{-- <section class="testimonials" id="testimonials">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Testimonials</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>
                <div class="row">
                    <div class="col-md-9 col-center m-auto">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Carousel indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for carousel items -->
                            <div class="carousel-inner">
                                <div class="item carousel-item active">
                                    <div class="img-box"><img src="{{ asset('site/img/testimonials/testimonials-1.jpg') }}" alt=""></div>
                                    <p class="testimonial">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet."</p>
                                    <p class="overview"><b>Kit Johnson</b>, Account Analyst</p>
                                </div>
                                <div class="item carousel-item">
                                    <div class="img-box"><img src="{{ asset('site/img/testimonials/testimonials-2.jpg') }}" alt=""></div>
                                    <p class="testimonial">"Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi a mi suscipit tincidunt. Utmtc tempus dictum risus. Pellentesque viverra sagittis quam at mattis. Suspendisse potenti. Aliquam sit amet gravida nibh, facilisis gravida odio."</p>
                                    <p class="overview"><b>Rick Gomez</b>, App Developer</p>
                                </div>
                                <div class="item carousel-item">
                                    <div class="img-box"><img src="{{ asset('site/img/testimonials/testimonials-3.jpg') }}" alt=""></div>
                                    <p class="testimonial">"Phasellus vitae suscipit justo. Mauris pharetra feugiat ante id lacinia. Etiam faucibus mauris id tempor egestas. Duis luctus turpis at accumsan tincidunt. Phasellus risus risus, volutpat vel tellus ac, tincidunt fringilla massa. Etiam hendrerit dolor eget rutrum."</p>
                                    <p class="overview"><b>Chris Smith</b>, CEO, ProTools</p>
                                </div>
                            </div>
                            <!-- Carousel controls -->
                            <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Testimonials End -->

        <!-- ======= Start FAQ's  Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Frequently Asked Questioins</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <ul>
                @foreach ($faqs as $faq)
                <button class="accordion">{{ $faq->question }}</button>
                <div class="panel">
                <p>{{ $faq->answer }}</p>
                </div>
                @endforeach


            </ul>

            </div>
        </section>
        <!-- ======= End FAQ's Section ======= -->

        <!-- ======= Start Contact Section ======= -->
        {{-- <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

            </div>
            <div class="container">

                <div class="row mt-5">

                    <div class="col-lg-6">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <i class="bx bx-map"></i>
                                    <h3>Our Address</h3>
                                    <p>232 Adam Street, Nairobi, N 00001</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <i class="bx bx-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>info@donateblood.com<br>contact@donateblood.com</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <i class="bx bx-phone-call"></i>
                                    <h3>Call Us</h3>
                                    <p>+254 718875113<br>+254 7397094371</p>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="col form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" />

                                </div>
                                <div class="col form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" />

                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" />

                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" data-rule="required" placeholder="Message"></textarea>

                            </div>

                            <div class="text-center"><button class="btn btn-danger" type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section> --}}
        <!-- ======= Start Contact Section ======= -->
    </main>

    <!-- ======= Start Footer ======= -->
    <section class="footer">
        <div class="section-title">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center white">2021 © BBMS. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= End Footer ======= -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    <!-- JS -->
    {{-- <script src="{{ asset('site/js/main.js') }}"></script>
    <script src="{{ asset('site/js/jquery.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.easing.min.js') }}"></script> --}}
    {{-- <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/js/jquery.easing.min.js"></script>
    <script src="js/main.js"></script>
    <script src="venobox/venobox.min.js"></script>
    <script src="aos/aos.js"></script> --}}
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            }
          });
        }
        </script>

</body>
<!-- ======= Start Body ======= -->

</html>
