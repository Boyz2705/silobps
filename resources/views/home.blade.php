<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/assets/sibook_fav.png">
    <title>Sibook</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cssku.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top p-3">
    <div class="container">
        <a href="/"><img class="img-fluid" src="{{ URL::to('/assets/sibooklogo.png') }}" style="width: 100px"></a>
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
          @guest
          @else
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/myapp">Logbookku</a>
          </li>
          @endguest
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

  <div id="banner" class="parallax d-flex justify-content-center align-items-center">
    <div class="container banner-content col-lg-6 position-absolute top-50 start-50 translate-middle">
      <div class="text-center">
        <a><button type="button" class="btn btn-success rounded" data-bs-toggle="modal" data-bs-target="#appointmentModal">Buat Logbook</button></a>

        <!-- Kotak status hanya muncul jika pengguna login -->
        @auth
        <div class="mt-3 mb-3">
          <label for="status" class="form-label">Status</label>
          <input type="text" class="form-control
            {{ Auth::user()->status == 0 ? 'bg-success' :
               (Auth::user()->status == 1 ? 'bg-danger' :
               (Auth::user()->status == 2 ? 'bg-warning' :
               (Auth::user()->status == 3 ? 'bg-secondary' : '')))}}
            text-white"
          value="{{
            Auth::user()->status == 0 ? 'Sedia' :
            (Auth::user()->status == 1 ? 'Sibuk' :
            (Auth::user()->status == 2 ? 'Sakit' :
            'Izin'))
          }}" readonly>
        </div>
        @endauth
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
            <label class="form-label">Select Pembina</label>
            <select name="service" class="form-select" aria-label="Default select example">
            @foreach($services as $service)
            <option value="{{ $service->id }}">{{ $service->services_name }}</option>
            @endforeach
            </select>
          </div>
            <div class="mb-3">
              <label class="form-label">Logbook Date</label>
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
              <label class="form-label">Select Kampus</label>
              <select name="branch" class="form-select" aria-label="Default select example">
                @foreach($clinics as $clinic)
              <option value="{{ $clinic->id }}">{{ $clinic->clinic_name }}</option>
              @endforeach
            </select>
            </div>
            <div class="mb-3">
            <label class="form-label">Select Petugas</label>
            <select name="pet_id" class="form-select" aria-label="Default select example">
              @foreach($pets as $pet)
            <option value="{{ $pet->id }}">{{ $pet->pet_name }}</option>
              @endforeach
          </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Kegiatan</label>
              <textarea name="detail" type="text" class="form-control" maxlength="55" required></textarea>
              <div class="form-text">Deskripsikan kegiatanmu</div>
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
    <p class="fs-1 fw-bolder centering" style="color: #f4a700;">ABOUT US</p>
    <div class="container p-4" style="font-size: 20px;text-align: center;">
        <p>SIBook BPS adalah sebuah sistem logbook inovatif yang dikembangkan oleh Mahasiswa Magang Badan Pusat Statistik Surabaya untuk memudahkan proses pencatatan dan pengelolaan logbook. Sistem ini dirancang untuk memfasilitasi pencatatan kegiatan harian secara digital, sehingga meminimalisir penggunaan kertas dan meningkatkan efisiensi serta akurasi dalam pelaporan kegiatan.</p>
    </div>
  </div>
<div class="marquee">
    <span class="marquee-text">Selamat datang pada Sistem Logbook BPS Surabaya </span>
</div>
<div style="text-align: center; font-size: 12px; margin-top: 20px;">
    © 2024 by Pram, Rifky , Febry.
</div>
  <script src="js/bootstrap.bundle.min.js"></script>
  {{-- <script src="js/bootstrap.js"></script> --}}
  <script src="js/jsku.js"></script>
  <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
</body>
</html>
