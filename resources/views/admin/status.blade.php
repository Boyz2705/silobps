@extends('admin.admin_assets')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage User Status Table</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            User Table
        </div>
        <div class="card-body">
            <div class="pull-right mb-3">
                <a class="btn btn-success" href="/adm-usercreate"> Add to User<a>
            </div>
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}</div>
            @elseif(session('statusdel'))
            <div class="alert alert-danger mb-1 mt-1">
            {{ session('statusdel') }}</div>
            @endif
            <table class="table table-bordered" id="datatablesSimple" style="border-width: 3px; border-style: solid">
                <tr>
                    <th>User_ID</th>
                    <th>User Name</th>
                    <th>Kampus</th>
                    <th>Jurusan</th>
                    <th>Status</th>
                </tr>
                @foreach ($users as $user)
                @if ($user->role == 'customer')
                <tr class="{{ $user->status == 0 ? 'bg-success text-white' : 'bg-danger text-white' }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->petugas }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->status == 0 ? 'Available' : 'Unavailable' }}</td>
                </tr>
                @endif
                @endforeach
            </table>
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
          <form action="{{ route('user.destroy',$user->id) }}" method="Post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
