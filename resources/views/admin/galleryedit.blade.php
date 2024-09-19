@extends('admin.admin_assets')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Gallery Table</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Table Example
        </div>
        <div class="card-body">
            <form action="/galleryedit/{{ $gallery->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong >Image ID:</strong>
                                <input type="text" name="id" value="{{ $gallery->id }}" class="form-control mt-2" placeholder="Services ID" required>
                            @error('id')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Image Title:</strong>
                                <input type="text" name="title" value="{{ $gallery->image_title }}" class="form-control mt-2" placeholder="Image Title" required>
                            @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <strong >Image Link:</strong>
                                <input type="text" name="img_link" value="{{ $gallery->img_link }}" class="form-control mt-2" placeholder="Image Link" required>
                            @error('img_link')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <img class="img-fluid" style="width: 20%" src="{{ $gallery->img_link }}" alt="">
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