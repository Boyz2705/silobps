@php
use Illuminate\Support\Facades\Auth;
@endphp

@extends('homeassets')

@section('content')

<div class="container" style="margin-top: 50px">
    <h1 class="mt-4">My Logbook</h1> <!-- Memastikan tag h1 tertutup dengan benar -->
    <div class="card mt-4 mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> My Logbook Table
        </div>
        <div>
            <form method="GET" action="{{ route('logbook.date2') }}" class="mb-4" style="margin-left: 20px">
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 align-self-end">
                        <button type="submit" class="btn btn-primary mt-2">Filter</button>
                        <a href="/myapp" class="btn btn-secondary mt-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success mb-3 mt-1">
                    {{ session('status') }}
                </div>
            @endif
            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Session</th>
                        <th>Kampus</th>
                        <th>Pembina</th>
                        <th>Petugas</th>
                        <th>Detail</th>
                        <th>Waktu Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->app_date }}</td>
                        <td>{{ $appointment->session->time ?? 'Tidak ada' }}</td>
                        <td>{{ $appointment->clinic->clinic_name ?? 'Tidak ada' }}</td>
                        <td>{{ $appointment->service->services_name ?? 'Tidak ada' }}</td>
                        <td>{{ $appointment->pet->pet_name ?? 'Tidak ada' }}</td>
                        <td>{{ $appointment->detail }}</td>
                        <td>{{ $appointment->waktuselesai ?? 'Belum diisi' }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateWaktuSelesaiModal{{ $appointment->id }}">
                                Update Waktu Selesai
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Update Waktu Selesai -->
                    <div class="modal fade" id="updateWaktuSelesaiModal{{ $appointment->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Waktu Selesai</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('appointments.update.waktuselesai', $appointment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="waktuselesai">Waktu Selesai</label>
                                            <select name="waktuselesai" class="form-control" required>
                                                <option value="">Pilih Waktu Selesai</option>
                                                @for ($hour = 7; $hour <= 22; $hour++)
                                                    @php
                                                        $time = sprintf('%02d:00', $hour);
                                                    @endphp
                                                    <option value="{{ $time }}">{{ $time }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div style="text-align: center; font-size: 12px; margin-top: 20px;">
        © 2024 by Pram, Rifky, Febry.
    </div>
</div>

<!-- Marquee Section -->
<div>
    <div class="marquee">
        <span class="marquee-text"></span>
        <div id="pixel-character"></div>
    </div>
    <div class="marquee">
        <span class="marquee-text"></span>
        <div id="pixel-character2"></div>
    </div>
    <div class="marquee">
        <span class="marquee-text"></span>
        <div id="pixel-character3"></div>
    </div>
</div>

@endsection

@if(session('alert'))
    <script>
        alert("{{ session('alert') }}");
    </script>
@endif

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "pagingType": "full_numbers", // Jenis pagination yang lengkap
            "lengthMenu": [5, 10, 25, 50], // Pilihan jumlah tampilan per halaman
            "language": {
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    });
</script>
@endpush
