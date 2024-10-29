@extends('layouts.app')

@section('title', 'Attendance')

@section('content')

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4> <i
                data-feather="check" class="h-i"></i>Attendences</h4>
             
        </div>
    </div>
</section>

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S#</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">In Time</th>
                                            <th class="text-center">Out Time</th>
                                            <th class="text-center">Work Time</th>
                                            <th class="text-center">Attendance Status</th>
                                            <th class="text-center">User IP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $attendance)
                                        <tr>
                                            <td class="text-center">{{ $attendance->id }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($attendance->date)->format('d-M-Y') }}</td>
                                            <td class="text-center">  {{ $attendance->user ? $attendance->user->name : 'N/A' }}</td>
                                            @if ($attendance->attendance_status == 'absent')
                                                <td class="text-center" style="color: red;">Absent</td>
                                                <td class="text-center" style="color: red;">Absent</td>
                                                <td class="text-center" style="color: red;">Absent</td>
                                                <td class="text-center" style="color: red;">Absent</td>
                                            @elseif ($attendance->attendance_status == 'holiday')
                                                <td class="text-center" style="color: green;">Holiday</td>
                                                <td class="text-center" style="color: green;">Holiday</td>
                                                <td class="text-center" style="color: green;">Holiday</td>
                                                <td class="text-center" style="color: green;">Holiday</td>
                                            @else
                                                <td class="text-center">
                                                    <span class="badge badge-shadow {{ $attendance->check_in_status == 'late' ? 'badge-danger' : 'badge-success' }}">
                                                        {{ $attendance->in_time }} ({{ $attendance->check_in_status }})</span>
                                                    {{-- {{ $attendance->in_time }} ({{ $attendance->check_in_status }}) --}}
                                                </td>

                                                <td class="text-center" style="color: {{ $attendance->check_out_status == 'late' ? 'red' : 'green' }}">
                                                    {{-- {{ $attendance->out_time }} ({{ $attendance->check_out_status }}) --}}

                                                    <span class="badge badge-shadow {{ $attendance->check_out_status == 'early_out' ? 'badge-danger' : 'badge-success' }}">
                                                        {{ $attendance->out_time }} ({{ $attendance->check_out_status }})
                                                    </span>
                                                </td>

                                                <td class="text-center">{{ $attendance->total_work_time }}</td>


                                                <td class="text-center">
                                                    <span class="badge badge-shadow
                                                    @if($attendance->attendance_status == 'absent')
                                                        badge-danger
                                                        @elseif($attendance->attendance_status == 'half_day')
                                                        badge-warning
                                                        @else
                                                        badge-success

                                                    @endif
                                                    ">
                                                        {{ ucfirst($attendance->attendance_status) }}
                                                    </span>
                                                </td>
                                            @endif
                                            <td class="text-center">{{ $attendance->user_ip }}</td>
                                            
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

