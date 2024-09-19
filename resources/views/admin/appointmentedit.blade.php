@extends('admin.admin_assets')
@section('content')
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manage Appointement Table</h1>
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
                            <form action="/appedit/{{ $appointment->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col">
                                    <select name="status" type="text" class="form-select" readonly aria-label="Default select example">
                                        {{-- <option value="{{ $appointment->status }}">{{ $appointment->status }}</option> --}}
                                        <option value="Appointment Cancelled">Appointment Cancelled</option>
                                        <option value="Appointment Scheduled">Appointment Scheduled</option>
                                        <option value="Appointment Ongoing">Appointment Ongoing</option>
                                        <option value="Waiting Payment">Waiting for Payment</option>
                                        <option value="Appointment Done">Appointment Done</option>
                                    </select>
                                    <label class="p-1 mt-2" for="">Current status : {{ $appointment->status}}</label>

                                    <div class="form-group mt-2">
                                        <strong >Bill</strong>
                                            <input type="text" name="bill" value="{{ $appointment->bill }}" class="form-control mt-2" placeholder="Bill" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </main>
    @endsection