@extends('admin.admin_assets')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage User Status Table</h1>
    <!-- Tombol untuk mereset status semua user -->
    <form action="{{ route('user.resetStatus') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <button type="submit" class="btn btn-danger">Hanya Pencet ini di Pagi Hari !!</button>
    </form>
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Status Table
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @elseif(session('statusdel'))
                <div class="alert alert-danger mb-1 mt-1">
                    {{ session('statusdel') }}
                </div>
            @endif

            <table class="table table-bordered" id="datatablesSimple" style="border-width: 3px; border-style: solid">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Kampus</th>
                        <th>Jurusan</th>
                        <th>No Telp</th>
                        <th>Status</th>
                        <th>Aksi</th> <!-- Tambahkan kolom aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @if ($user->role == 'customer')
                            <tr class="
                                {{ $user->status == 0 ? 'bg-success text-white' : '' }}
                                {{ $user->status == 1 ? 'bg-danger text-white' : '' }}
                                {{ $user->status == 2 ? 'bg-warning text-dark' : '' }}
                                {{ $user->status == 3 ? 'bg-info text-white' : '' }}">

                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->petugas }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->notelp }}</td>
                                <td>
                                    {{ $user->status == 0 ? 'Sedia' : '' }}
                                    {{ $user->status == 1 ? 'Sibuk' : '' }}
                                    {{ $user->status == 2 ? 'Sakit' : '' }}
                                    {{ $user->status == 3 ? 'Izin' : '' }}
                                </td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editmodal-{{ $user->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal for Edit User Status --}}
                            <div class="modal fade" id="editmodal-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit User Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('user.update-status', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select">
                                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Sedia</option>
                                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Sibuk</option>
                                                    <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Sakit</option>
                                                    <option value="3" {{ $user->status == 3 ? 'selected' : '' }}>Izin</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Update Status</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal for Delete Confirmation --}}
                            <div class="modal fade" id="delmodal-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="del">Data Will be Permanently Deleted</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
