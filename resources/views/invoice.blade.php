<html>
<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="{{ asset('css/invoice.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/cssku.css') }}">
</head>
<body>
<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        {{-- <button onclick="display()">Click to Print</button> --}}
        <div class="col-lg-8 col-xl-6">
          <div class="card border-top border-bottom border-3" style="border-color: #198754 !important;">
            <div class="card-body p-5">

              <p class="lead fw-bold mb-5" style="color: #198754;">Petclick Invoice</p>
              @foreach ($apps->where('id',$id) as $app)
              <div class="row">
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Date</p>
                  <p>{{ $app->created_at }}</p>
                </div>
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Appointment Number</p>
                  <p>{{ $app->id }}</p>
                </div>
              </div>

              <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                <div class="row">
                    <div class="row">
                        <div class="col"  style="font-weight: bold; color:#198754;">
                          <p>Customer</p>
                        </div>
                        <div class="col">
                          <p style="margin-left: 10px">{{ auth::user()->name }}</p>
                        </div>
                      </div>
                    <div class="row">
                        <div class="col"  style="font-weight: bold; color:#198754;">
                          <p>Pet</p>
                        </div>
                        <div class="col">
                          <p style="margin-left: 10px">{{ $app->pet['pet_name'] }}</p>
                        </div>
                      </div>
                  <div class="col"  style="font-weight: bold; color:#198754;">
                    <p>Service</p>
                  </div>
                  <div class="col">
                    <p>{{ $app->service['services_name'] }}</p>
                  </div>
                </div>
            </div>
              <div class="row my-4">
                <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                  <p class="mb-0" style="color: #198754;">Total Bill : ${{ $app->bill }}</p>
                </div>
              </div>

              <p class="lead fw-bold mb-4 pb-2 mt-3" style="color: #198754;">Status</p>

              <div class="row">
                <div class="col-lg-12">
                  @if($app->status==='Appointment Scheduled')
                  <div class="horizontal-timeline">

                    <ul class="list-inline items d-flex justify-content-between">
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color: #198754;">Scheduled</p
                          class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded " style="background-color:;">Ongoing</p
                          class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded " style="background-color:;">Waiting Payment                        </p>
                      </li>
                      <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                        <p style="margin-right: -8px;">Done</p>
                      </li>
                    </ul>

                  </div>
                  @elseif($app->status==='Appointment Ongoing')
                  <div class="horizontal-timeline">

                    <ul class="list-inline items d-flex justify-content-between">
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color: #198754;">Scheduled</p>
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color:#198754;">Ongoing</p>
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded" style="background-color:;">Waiting Payment
                        </p>
                      </li>
                      <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                        <p style="margin-right: -8px;">Done</p>
                      </li>
                    </ul>

                  </div>
                  @elseif($app->status==='Waiting Payment')
                  <div class="horizontal-timeline">

                    <ul class="list-inline items d-flex justify-content-between">
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color: #198754;">Scheduled</p>
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color:#198754;">Ongoing</p>
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color:#198754;">Waiting Payment
                        </p>
                      </li>
                      <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                        <p style="margin-right: -8px;">Done</p>
                      </li>
                    </ul>

                  </div>

                  @elseif($app->status==='Appointment Done')
                  <div class="horizontal-timeline">

                    <ul class="list-inline items d-flex justify-content-between">
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color: #198754;">Scheduled</p>
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color:#198754;">Ongoing</p>
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color:#198754;">Waiting Payment
                        </p>
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color:#198754;">Done
                        </p>
                      </li>
                    </ul>

                  </div>

                  @elseif($app->status==='Appointment Cancelled')
                  <div class="horizontal-timeline">

                    <ul class="list-inline items d-flex justify-content-between">
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color: #198754;">Scheduled</p>
                      </li>
                      <li class="list-inline-item items-list">
                        <p class="py-1 px-2 rounded text-white" style="background-color:#198754;">Cancelled</p>
                      </li>
                    </ul>

                  </div>
                  @endif
                  @endforeach
                </div>
              </div>

              {{-- <p class="mt-4 pt-2 mb-0">Want any help? <a href="#!" style="color: #f37a27;">Please contact
                  us</a></p> --}}

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- <script>
    function display() {
       window.print();
    }
 </script> --}}
</body>

</html>
