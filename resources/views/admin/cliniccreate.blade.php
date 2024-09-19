@extends('admin.admin_assets')
@section('content')
 <div class="container-fluid px-4">
    <h1 class="mt-4">Manage Clinic Table</h1>
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
            <form action="/clinic_create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong >Clinic ID:</strong>
                                <input type="text" name="id" class="form-control mt-2" placeholder="Image ID" required>
                            @error('id')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Clinic Name:</strong>
                                <input type="text" name="clinic_name" class="form-control mt-2" placeholder="Clinic Name" required>
                            @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Clinic Address:</strong>
                                <input type="text" name="clinic_address" class="form-control mt-2" placeholder="Clinic Address" required>
                            @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Image Link:</strong>
                                <input type="text" name="img_link" class="form-control mt-2" placeholder="Image Link" required>
                            @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Map Link:</strong>
                                <input type="text" name="map_link" class="form-control mt-2" placeholder="Map Link" required>
                            @error('name')
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