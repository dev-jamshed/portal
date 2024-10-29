@extends('layouts.app')

@section('title', 'Manage Schedules')

@section('content')

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4><i data-feather="calendar" class=" h-i"></i> Manage Schedules</h4>
                <a class="btn btn-primary" href="{{ route('schedules.create') }}">  Add New Schedule</a>
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
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Start DateTime</th>
                                            <th class="text-center">End DateTime</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($schedules as $schedule)
                                        <tr>
                                            <td class="text-center">{{ $schedule->id }}</td>
                                            <td class="text-center">{{ $schedule->title }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($schedule->start_datetime)->format('h:i A') }}</td>
<td class="text-center">{{ \Carbon\Carbon::parse($schedule->end_datetime)->format('h:i A') }}</td>

                                            <td class="just-flex">
                                                <form class="my-0-mx-auto" action="{{ route('schedules.destroy', $schedule->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <table>
                                                        <tr>
                                                            {{-- @can('update schedule') --}}
                                                            <td>
                                                                <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                                            </td>
                                                            {{-- @endcan --}}

                                                            {{-- @can('delete schedule') --}}
                                                            <td>
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Record?');"><i class="fa-regular fa-trash"></i></button>
                                                            </td>
                                                            {{-- @endcan --}}
                                                        </tr>
                                                    </table>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No Schedules Found</td>
                                            </tr>
                                        @endforelse
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
