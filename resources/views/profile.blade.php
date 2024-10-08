@extends('homeassets')

@section('content')
<div class="container-fluid px-5">
    <h1 class="mt-4">Manage Profile</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="/profileedit/{{ Auth::user()->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input class="form-control" name="name" value="{{ Auth::user()->name }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input class="form-control" name="number" value="{{ Auth::user()->notelp }}">
                </div>

                <div class="mb-3">
                    <label for="campus" class="form-label">Kampus</label>
                    <input class="form-control" name="petugas" value="{{ Auth::user()->petugas }}">
                </div>

                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input class="form-control" name="address" value="{{ Auth::user()->address }}">
                </div>

                <div class="mb-3">
                    <label for="pembina" class="form-label">Pembina</label>
                    <input class="form-control" name="city" value="{{ Auth::user()->city }}">
                </div>

                

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
