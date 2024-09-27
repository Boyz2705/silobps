@extends('admin.admin_assets')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Logbook Table</h1>
    <!-- Filter Tanggal -->
    <form method="GET" action="{{ route('logbook.date') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
                <a href="/adm-app" class="btn btn-secondary mt-2">Reset</a>
            </div>
        </div>
    </form>

    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}</div>
        @elseif(session('statusdel'))
        <div class="alert alert-danger mb-1 mt-1">
        {{ session('statusdel') }}</div>
        @endif
        <div class="card-body">
          {{-- <a href="/app-recap" target="_blank" class="btn btn-success mb-3">Recap all data</a> --}}
          <table class="table table-bordered" id="datatablesSimple">
            <thead>
                <tr>
                    <th>Log_ID</th>
                    <th>User</th>
                    <th>Pembina</th>
                    <th>Date</th>
                    <th>Petugas</th>
                    <th>Kampus</th>
                    <th>Detail</th>
                    <th style="width: 150px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apps as $app)
                <tr>
                    <td>{{ $app->id }}</td>
                    <td>{{ $app->user['name'] }}</td>
                    <td>{{ $app->service['services_name'] }}</td>
                    <td>{{ $app->app_date }}</td>
                    <td>{{ $app->pet['pet_name'] }}</td>
                    <td>{{ $app->clinic['clinic_name'] }}</td>
                    <td>{{ $app->detail }}</td>
                    <td>
                        <a class="btn btn-primary mt-1" href="appedit/{{ $app->id }}">Edit</a>
                        <button type="button" class="btn btn-danger mt-1" data-bs-toggle="modal" data-bs-target="#delmodal">Delete</button>
                        {{-- Jika Anda tidak menggunakan receipt, bisa dihapus --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

          {{-- <button type="submit" class="btn btn-success">Save</button>
          </form> --}}
                  </div>
              </div>
          </div>

{{-- modal --}}
<div class="modal fade" id="delmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="del">Data Will be Permanently Deleted</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer centering">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="{{ route('appointment.destroy',$app->id) }}" method="Post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@if(session('alert'))
    <script>
        alert("{{ session('alert') }}");
    </script>
@endif

