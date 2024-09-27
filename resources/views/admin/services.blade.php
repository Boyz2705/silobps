@extends('admin.admin_assets')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pembina</h1>
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Table Example
        </div>
        <div class="card-body">
            <div class="pull-right mb-3">
                <a class="btn btn-success" href="/adm-servicescreate">Create New Pembina</a>
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
                        <th>Pembina ID</th>
                        <th>Pembina Name</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->services_name }}</td>
                            <td>
                                <a class="btn btn-primary" href="servicesedit/{{ $service->id }}">Edit</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delmodal-{{ $service->id }}">Delete</button>
                            </td>
                        </tr>

                        {{-- Modal for Delete Confirmation --}}
                        <div class="modal fade" id="delmodal-{{ $service->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="del">Data Will be Permanently Deleted</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('services.destroy', $service->id) }}" method="POST">
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
