<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/assets/slogo_fav.jpg">
    <title>Sibook</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cssku.css') }}">
    <link rel="stylesheet" href="{{ asset('css2/styles-admin.css') }}">
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top p-3">
    <div class="container">
        <a href="/"><img class="img-fluid" src="{{ URL::to('/assets/sibooklogo.png') }}" style="width: 100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse righting" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/#about">About Us</a>
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
                              <a class="dropdown-item" href="{{ route('user.edit', Auth::user()->id) }}">My Profile</a>
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
<main>
    @yield('content')
{{-- </main>
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
    </footer> --}}
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('https://code.iconify.design/2/2.2.1/iconify.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatables-simple-demo.js') }}"></script>
  <script src="{{ asset('https://cdn.jsdelivr.net/npm/simple-datatables@latest') }}" crossorigin="anonymous"></script>
  <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js') }}" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/demo/chart-bar-demo.js') }}assets/demo/chart-area-demo.js"></script>
  <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
</body>
</html>
