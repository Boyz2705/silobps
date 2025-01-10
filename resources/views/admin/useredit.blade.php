@extends('admin.admin_assets')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage User Table</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Table Example
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="/useredit/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group mt-2">
                            <strong>User Name:</strong>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control mt-2" placeholder="User  Name" required>
                            @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong>User Email:</strong>
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control mt-2" placeholder="User  Email" required>
                            @error('email')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong>User Phone Number:</strong>
                            <input type="text" name="number" value="{{ $user->notelp }}" class="form-control mt-2" placeholder="User  Phone Number">
                            @error('number')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong>User Address:</strong>
                            <input type="text" name="address" value="{{ $user->address }}" class="form-control mt-2" placeholder="User  Address">
                            @error('address')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong>Pembina:</strong>
                            <input type="text" name="city" value="{{ $user->city }}" class="form-control mt-2" placeholder="Pembina">
                            @error('city')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong>User Role:</strong>
                            <select name="role" class="form-select mt-2">
                                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="TidakAktif" {{ $user->role == 'TidakAktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('role')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Input untuk ganti password --}}
                        <div class="form-group mt-2">
                            <strong>New Password:</strong>
                            <input type="password" name="password" class="form-control mt-2" placeholder="New Password">
                            @error('password')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong>Confirm Password:</strong>
                            <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                @error('general')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>
</div 

@endsection

