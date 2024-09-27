@extends('admin.admin_assets')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Kampus</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabel Kampus
        </div>
        <div class="card-body">
            <div class="pull-right mb-3">
                <a class="btn btn-success" href="/adm-cliniccreate">Tambah Kampus</a>
            </div>
            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @elseif(session('statusdel'))
                <div class="alert alert-danger mb-1 mt-1">
                    {{ session('statusdel') }}
                </div>
            @endif

            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clinics as $clinic)
                        <tr>
                            <td>{{ $clinic->id }}</td>
                            <td>{{ $clinic->clinic_name }}</td>
                            <td>{{ $clinic->clinic_address }}</td>
                            <td><img style="height: 100px" src="{{ $clinic->img_link }}" alt="{{ $clinic->clinic_name }}"></td>
                            <td>
                                <a class="btn btn-primary" href="clinicedit/{{ $clinic->id }}">Edit</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delmodal-{{ $clinic->id }}">Delete</button>
                            </td>
                        </tr>

                        {{-- Modal for Delete Confirmation --}}
                        <div class="modal fade" id="delmodal-{{ $clinic->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="del">Data Will be Permanently Deleted</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer centering">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('clinic.destroy', $clinic->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
