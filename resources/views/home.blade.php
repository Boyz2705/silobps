<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sibook</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cssku.css">
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top p-3">
    <div class="container">
        <a href="/"><img class="img-fluid" src="{{ URL::to('/assets/bpslogo.png') }}" style="width: 100px"></a>
        {{-- <a class="navbar-brand" href="#">PetClick</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse righting" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/myapp">Logbookku</a>
          </li>
          <li class="nav-item">
            @if (Route::has('login'))
                  <div class="hidden fixed top-0 right-0 sm:block">
                      @auth
                          <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }}
                          </a>

                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="/myapp">My Logbook</a>
                              <a class="dropdown-item" href="/myprofile">My Profile</a>
                              <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                               {{ __('Logout') }}
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </li>
                      @else
                          <li class="nav-item ms-2">
                            <a href="{{ route('login') }}" ><button type="button" class="btn btn-success rounded-pill">Login / Register</button></a>
                          </li>
                      @endauth
                  </div>
              @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- banner --}}
  <div id="banner" class="parallax d-flex justify-content-center align-items-center">
    <div class="container banner-content col-lg-6 position-absolute top-50 start-50 translate-middle">
      <div class="text-center">
        <p class="fs-1 fw-semibold">
          SiBook BPS SURABAYA
        </p>
        <p class="d-none d-md-block fw-normal">
          Mari kita catat logbookmu
        </p>
        <a><button type="button" class="btn btn-success rounded" data-bs-toggle="modal" data-bs-target="#appointmentModal">Buat Logbook</button></a>
        </div>
      </div>
    </div>
  </div>

  {{-- modal --}}
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      @auth
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logbook Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div  class="modal-body p-4">
        <form method="post" class="row g-3" action="/create1">
          @csrf
          <div class="row">
            <form class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Email</label>
              {{-- <input name="email" type="text" class="form-control" readonly placeholder=" {{ Auth::user()->email }}"> --}}
              <select name="email" type="text" class="form-select" readonly aria-label="Default select example">
                <option value="{{ Auth::user()->email }}" readonly>{{ Auth::user()->email }}</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Username</label>
              {{-- <input name="user_id" type="text" class="form-control" readonly value="{{ Auth::user()->id }}" placeholder="{{ Auth::user()->name}}"> --}}
              <select name="user_id" type="text" class="form-select" readonly aria-label="Default select example" required>
                <option value="{{ Auth::user()->id }}" readonly>{{ Auth::user()->name }}</option>
              </select>
            </div>
            <div class="mb-3 mt-3" hidden>
              <label class="form-label">Phone Number</label>
              <select name="notelp" type="text" class="form-select" readonly aria-label="Default select example">
                <option value="{{ Auth::user()->notelp }}" readonly>{{ Auth::user()->notelp }}</option>
              </select>
              <div class="form-text">Input Your Phone Number</div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Select Services</label>
            <select name="service" class="form-select" aria-label="Default select example">
            @foreach($services as $service)
            <option value="{{ $service->id }}">{{ $service->services_name }}</option>
            @endforeach
            </select>
          </div>
            <div class="mb-3">
              <label class="form-label">Appointment Date</label>
              <input name="app_date" type="date" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Select Session</label>
            <select name="session" class="form-select" aria-label="Default select example">
              @foreach($sessions as $session)
            <option value="{{ $session->id }}">{{ $session->time }}</option>
            @endforeach
          </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Select Branch</label>
              <select name="branch" class="form-select" aria-label="Default select example">
                @foreach($clinics as $clinic)
              <option value="{{ $clinic->id }}">{{ $clinic->clinic_name }}</option>
              @endforeach
            </select>
            </div>
            <div class="mb-3">
            <label class="form-label">Pet</label>
            <select name="pet_id" class="form-select" aria-label="Default select example">
              @foreach($pets as $pet)
            <option value="{{ $pet->id }}">{{ $pet->pet_name }}</option>
              @endforeach
          </select>
            </div>
            <div class="mb-3">
            <label class="form-label">Current Complaint</label>
              <textarea name="detail" type="text" class="form-control" cols="30" rows="10" required></textarea>
              {{-- <input name="detail" type="text" class="form-control"> --}}
              <div class="form-text">Describe Your Pet's Complaint</div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
      @else
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">You Need to Login First</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="centering p-4">
        <a href="{{ route('login') }}"><button type="submit" class="btn btn-success">Login</button></a>
      </div>
      @endauth
    </div>
  </div>
</div>

  {{-- content 1 --}}
  <div id="about" class="p-5"></div>
  <div class="container-fluid">
    <p class="fs-1 fw-bolder centering" style="color: #016734;">ABOUT US</p>
    <div class="container p-4" style="font-size: 20px;text-align: center;">
        <p>We provide good service to your pets and provide excellent facilities, we also have experienced veterinarians who are ready to heal your animals safely and well and are ready to serve consultations on your animal problems. We also provide good and very soft grooming facilities for your animals and uses very sterile tools and uses excellent grooming materials for groom your pets with love and care.</p>
    </div>
  </div>

  {{-- content 2 --}}
  <div id="services" class="mt-5 p-3"></div>
  <div class="container-fluid fb-parallax centering">
    <div class="container m-5">
        <p class="fs-1 fw-bolder centering" style="color: white;">OUR SERVICES</p>
        <div class="row m-5 centering">
          @foreach($services as $service)
          <div class="col-sm-3 centering mt-2 mb-3" style="width: 18rem;">
            <div class="card shadow" style="width: 18rem; border-radius: 17px;">
                <img src="{{ $service->img_link }}" class="card-img-top" alt="grooming" style="border-radius: 17px;">
                <div class="card-body">
                  <h5 class="card-title" style="color: #323D51">{{ $service->services_name }}</h5>
                </div>
                <a href="{{ $service->srv_routes }}"><button class="btn btn-success ms-3 mb-3">See details</button></a>
              </div>
        </div>
        @endforeach
        </div>
    </div>
  </div>

  {{-- content 3 --}}
  <div id="gallery" class="container mt-5">
    <h1 class="centering fs-1 fw-bolder" style="color: #016734;">GALLERY</h1>
    <div class="container p-5">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1632236542159-809925d85fc0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" class="d-block w-100" alt="img_1" style="border-radius: 20px">
              </div>
              @foreach($galleries as $gallery)
              <div class="carousel-item">
                <img src="{{ $gallery->img_link }}" class="d-block w-100" alt="{{ $gallery->img_title }}" style="border-radius: 20px">
              </div>
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
  </div>

  {{-- location --}}

  <div id="location" class="container">
    <h1 class="centering fs-1 fw-bolder" style="color: #016734;">LOCATIONS</h1>
    <div class="row m-5 centering">
      @foreach($clinics as $clinic)
        <div class="col-sm-3 centering mt-2 mb-3" style="width: 18rem">
          <div class="card shadow" style="width: 18rem; border-radius: 17px;">
              <img style="height: 200px; border-radius:15px;" src="{{ $clinic->img_link }}" class="img-fluid card-img-top" alt="grooming" style="border-radius: 17px;">
              <div class="card-body">
                <h5 class="card-title">{{ $clinic->clinic_name }}</h5>
                <p class="card-text">{{ $clinic->clinic_address }}</p>
              </div>
              <a href="{{ $clinic->map_link }}" target="_blank"><button class="btn btn-success ms-3 mb-3">View Location</button></a>
            </div>
      </div>
        @endforeach
    </div>
  </div>

  <!-- contact -->
  <div id="contact" class="bg-contact mt-5">
    <div class="container">
        <h2 class="text-center fs-1 text-black-75 fw-bolder pt-4  " style="color: white;">CONTACT</h2>
        <div class="row mt-4">

          <div class="col-lg-4" style="color: white;">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt" ></i>
                <a href="https://goo.gl/maps/" target="_blank" style="color: white;"><h4><span class="iconify me-1" data-icon="fa6-solid:location-dot" data-width="20" data-height="20"></span>Location:</h4>
                <p>Surabaya, Indonesia - 36743</p></a>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <a href="mailto::" target="_blank" style="color: white;"><h4><span class="iconify me-1" data-icon="ic:round-email" data-width="20" data-height="20"></span>Email:</h4>
                <p>petclick@gmail.com</p></a>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <a href="http://wa.me/" target="_blank" style="color:white;">
                <h4><span class="iconify me-1" data-icon="fluent:call-24-filled" data-width="20" data-height="20"></span>Call:</h4>
                <p>+62 81000000000</p></a>
              </div>

              <div>
                <a href="#"><button class="btn btn-success">Back to Top</button></a>
              </div>

            </div>

          </div>
          <div class="col-lg-8 p-3">
          <div class="mt-5 mt-lg-0 shadow p-3 mb-5 bg-body rounded">
            <form action="phpmail.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="container centering">
                <button class="btn btn-success text-center mt-3" type="submit" name="submit"> Send Message</button>
              </div>
            </form>
          </div>
        </div>
        </div>
      </div>
  </div>
  <!-- footer -->
    <footer class="container-fluid pt-4 pb-4" style="background: #212529;">
      <div class="container">
        <h4 class="fs-2 fw-semibold centering" style="color: WHITE;">CONNECT WITH US</h4>
        <div class="centering">
          <a href="http://instagram.com/" target="_blank"><span class="iconify" data-icon="fa-brands:instagram-square" style="color: white;" data-width="37" data-height="37"></span></a>
          <a href="http://linkedin.com" target="_blank"><span class="iconify" data-icon="fa-brands:linkedin" style="color: white;" data-width="37" data-height="37 "></span></a>
          <a href="http://twitter.com" target="_blank"><span class="iconify" data-icon="fa-brands:twitter-square" style="color: white;" data-width="37" data-height="37"></span></a>
          <a href="https://github.com/" target="_blank"><span class="iconify" data-icon="fa-brands:github-square" style="color: white;" data-width="37" data-height="37"></span></a>
        </div>
        </div>
    </footer>
  <script src="js/bootstrap.bundle.min.js"></script>
  {{-- <script src="js/bootstrap.js"></script> --}}
  <script src="js/jsku.js"></script>
  <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
</body>
</html>
