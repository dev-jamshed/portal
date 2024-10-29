@extends('layouts.app')

@section('title', 'Edit Work From Home Permission')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h4><i data-feather="clock" class="h-i" ></i> Edit Work From Home Permission</h4>
                        <a href="{{ route('work_from_home.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('work_from_home.update', ['work_from_home' => $permission->id]) }}" method="post">

                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                                            <option value="">Select Employee</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $permission->employee_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('employee_id'))
                                            <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror" required
                                        id="date" name="date" value="{{ old('date', $permission->date) }}">
                                        @if ($errors->has('date'))
                                            <span class="text-danger">{{ $errors->first('date') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-left">
                                <button id="btn" class="btn btn-primary" type="submit">Update Permission</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
