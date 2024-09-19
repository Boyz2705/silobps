@extends('admin.admin_assets')

@section('content')
<div class="container-fluid px-4">
                    <h1 class="mt-4">Admin Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">{{  $date }}</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Total Customer</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    @foreach($users as $user) @endforeach
                                    <a class="small text-white stretched-link" href="/adm-user">{{ $user->where('role','customer')->count() }}</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Total Appointments</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    @foreach($apps as $app) @endforeach
                                    <a class="small text-white stretched-link" href="/adm-app">{{ $app->count() }}</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                         <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Today's Appointments</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    @foreach($apps as $app) @endforeach
                                    <a class="small text-white stretched-link" href="/adm-app">{{ $app->where('app_date',$currdate)->count() }}</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header" style="background-color: #ffc107; color:#fff;">
                            <i class="fas fa-table me-1"></i>
                            Today's Appointment
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>App _ID</th>
                                        <th>User</th>
                                        <th>Services</th>
                                        <th>Date</th>
                                        <th>Session</th>
                                        <th>Pet</th>
                                        <th>Clinic</th>
                                        <th>Detail</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($apps->where('app_date', $currdate) as $app)
                                    <tr>
                                        <td>{{ $app->id }}</td>
                                        <td>{{ $app->user['name'] }}</td>
                                        <td>{{ $app->service['services_name'] }}</td>
                                        <td>{{ $app->app_date }}</td>
                                        <td>{{ $app->session['time'] }}</td>
                                        <td>{{ $app->pet['pet_name'] }}</td>
                                        <td>{{ $app->clinic['clinic_name'] }}</td>
                                        <td>{{ $app->detail }}</td>
                                        <td>{{ $app->status }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @foreach($clinics as $clinic)
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            {{ $clinic->clinic_name }}
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>App _ID</th>
                                        <th>User</th>
                                        <th>Services</th>
                                        <th>Date</th>
                                        <th>Session</th>
                                        <th>Pet</th>
                                        <th>Clinic</th>
                                        <th>Detail</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($apps->where('clinic_id', $clinic->id) as $app)
                                    <tr>
                                        <td>{{ $app->id }}</td>
                                        <td>{{ $app->user['name'] }}</td>
                                        <td>{{ $app->service['services_name'] }}</td>
                                        <td>{{ $app->app_date }}</td>
                                        <td>{{ $app->session['time'] }}</td>
                                        <td>{{ $app->pet['pet_name'] }}</td>
                                        <td>{{ $app->clinic['clinic_name'] }}</td>
                                        <td>{{ $app->detail }}</td>
                                        <td>{{ $app->status }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
@endsection