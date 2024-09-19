@extends('admin.admin_assets')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Services Table</h1>
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
            <form action="/clinicedit/{{ $clinic->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong >Clinic ID:</strong>
                                <input type="text" name="id" value="{{ $clinic->id }}" class="form-control mt-2" placeholder="Clinic ID" required>
                            @error('id')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Clinic Name:</strong>
                                <input type="text" name="name" value="{{ $clinic->clinic_name }}" class="form-control mt-2" placeholder="Clinic Name" required>
                            @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Clinic Address:</strong>
                                <input type="text" name="address" value="{{ $clinic->clinic_address }}" class="form-control mt-2" placeholder="Clinic Address" required>
                            @error('address')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Image Link:</strong>
                                <input type="text" name="img_link" value="{{ $clinic->img_link }}" class="form-control mt-2" placeholder="Image Link" required>
                            @error('img_link')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Map Link:</strong>
                                <input type="text" name="map_link" value="{{ $clinic->map_link }}" class="form-control mt-2" placeholder="Map Link" required>
                            @error('map_link')
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