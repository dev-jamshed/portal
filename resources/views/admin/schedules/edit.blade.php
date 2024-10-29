@extends('layouts.app')

@section('title', 'Edit Schedule')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4><i data-feather="calendar" class=" h-i"></i> Edit Schedule</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('schedules.update', $schedule->id) }}" method="post">
                @csrf
                @method('PUT')


                <div class="row">
                    
                    
                    <div class="col-md-6">    
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $schedule->title }}" required>
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_datetime">Start DateTime</label>
                        <input type="time" name="start_datetime" class="form-control" value="{{ $schedule->start_datetime }}" required>
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="end_datetime">End DateTime</label>
                        <input type="time" name="end_datetime" class="form-control" value="{{ $schedule->end_datetime }}" required>
                    </div>
                    </div>

                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="late_time">Late Time</label>
                        <input type="time" name="late_time" class="form-control" value="{{ $schedule->late_time }}" required>
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="half_day_time">Half Day Time</label>
                        <input type="time" name="half_day_time" class="form-control" value="{{ $schedule->half_day_time }}" required>
                    </div>
                    </div>
                    
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
