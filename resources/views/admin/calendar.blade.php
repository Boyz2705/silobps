@extends('admin.admin_assets')

@php
    use Carbon\Carbon;
@endphp

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Logbook Calendar</h1>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-calendar me-1"></i>
                Logbook Status
            </div>
            <form class="d-flex gap-2" method="GET" action="{{ route('calendar.view') }}">
                <select class="form-select form-select-sm" name="month" onchange="this.form.submit()">
                    @foreach($months as $index => $monthName)
                        <option value="{{ $index + 1 }}" {{ $currentMonth->month === ($index + 1) ? 'selected' : '' }}>
                            {{ $monthName }}
                        </option>
                    @endforeach
                </select>
                <select class="form-select form-select-sm" name="year" onchange="this.form.submit()">
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ $currentMonth->year === $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            @for($day = 1; $day <= $currentMonth->daysInMonth; $day++)
                                @php
                                    $date = Carbon::createFromDate($currentMonth->year, $currentMonth->month, $day);
                                    $isWeekend = $date->isWeekend();
                                @endphp
                                <th class="text-center {{ $isWeekend ? 'text-muted' : '' }}">
                                    {{ $day }}<br>
                                    <small>{{ $date->format('D') }}</small>
                                </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="fw-bold">{{ $user->name }}</td>
                                @for($day = 1; $day <= $currentMonth->daysInMonth; $day++)
                                    @php
                                        $date = Carbon::createFromDate($currentMonth->year, $currentMonth->month, $day);
                                        $isWeekend = $date->isWeekend();
                                        $hasLogbook = isset($appointments[$user->id][$day]);
                                    @endphp
                                    <td class="p-0">
                                        <div class="d-flex justify-content-center align-items-center"
                                             style="height: 40px;
                                                    background-color: {{ $isWeekend ? '#f8f9fa' : ($hasLogbook ? '#ef4444' : '#22c55e') }}"
                                             title="{{ $user->name }} - {{ $date->format('Y-m-d') }}">
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $currentMonth->daysInMonth + 1 }}" class="text-center">
                                    No customers found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .table th, .table td {
        padding: 0.5rem;
    }
    .table th {
        font-size: 0.875rem;
    }
    .table td > div {
        border-radius: 4px;
    }
</style>
@endsection
