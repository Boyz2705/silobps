@extends('admin.admin_assets')
@section('content')
                {{-- {{ $pet }} --}}
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Petugas</h1>
                    {{-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> --}}
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
                            <form action="/petedit_create" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong > ID Petugas:</strong>
                                                <input type="text" name="id" class="form-control mt-2" placeholder="1" required>
                                            @error('id')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <strong >Nama Petugas:</strong>
                                                <input type="text" name="name" class="form-control mt-2" placeholder="Fulan" required>
                                            @error('name')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <strong>Nomor Telepon:</strong>
                                            <input type="text" name="phone" class="form-control mt-2" placeholder="0895383119600" required>
                                            @error('phone')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
@endsection