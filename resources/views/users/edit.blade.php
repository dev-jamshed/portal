@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h4><i class="fa-regular fa-user h-i"></i> Edit User</h4>
                            <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('users.update', $user->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <!-- Name Field -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                required id="name" name="name"
                                                value="{{ old('name', $user->name) }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Email Field -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                required id="email" name="email"
                                                value="{{ old('email', $user->email) }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Profile Picture Field -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Profile Picture</label>
                                            <input type="file"
                                                class="form-control @error('picture') is-invalid @enderror" id="picture"
                                                name="picture">
                                            @if ($errors->has('picture'))
                                                <span class="text-danger">{{ $errors->first('picture') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Phone Number Field -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                required id="phone" name="phone"
                                                value="{{ old('phone', $user->phone) }}">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Color Field -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Color</label>
                                            <input type="color" class="form-control @error('color') is-invalid @enderror"
                                                id="color" name="color_code" value="{{ old('color', $user->color_code) }}">
                                            @if ($errors->has('color'))
                                                <span class="text-danger">{{ $errors->first('color') }}</span>
                                            @endif
                                        </div>
                                    </div>



                                    <!-- Password Field -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Confirm Password Field -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation" name="password_confirmation">
                                            @if ($errors->has('password_confirmation'))
                                                <span
                                                    class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Department Dropdown -->
                                    <div class="col-md-6" id="department-dropdown"
                                        style="{{ $user->roles->contains('Employee') ? 'display: block;' : 'display: none;' }}">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select class="form-control" name="department_id">
                                                <option value="">Select a Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- SubDepartment Dropdown -->
                                    <div class="col-md-6" id="subdepartment-dropdown"
                                        style="{{ $user->sub_department_id ? 'display: block;' : 'display: none;' }}">
                                        <div class="form-group">
                                            <label>Sub Department</label>
                                            <select class="form-control" name="sub_department_id">
                                                <option value="">Select a Sub Department</option>
                                                @foreach ($subDepartment as $subdepartment)
                                                    <option value="{{ $subdepartment->id }}"
                                                        {{ old('sub_department_id', $user->sub_department_id) == $subdepartment->id ? 'selected' : '' }}>
                                                        {{ $subdepartment->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Position Dropdown -->
                                    <div class="col-md-6" id="position-dropdown" style="display: none;">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <select class="form-control" name="position">
                                                <option value="">Select a Position</option>
                                                <option value="Junior"
                                                    {{ old('position', $user->position) == 'Junior' ? 'selected' : '' }}>
                                                    Junior</option>
                                                <option value="Senior"
                                                    {{ old('position', $user->position) == 'Senior' ? 'selected' : '' }}>
                                                    Senior</option>
                                            </select>
                                        </div>
                                    </div>



                                    <!-- Schedule Dropdown -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Schedule</label>
                                            <select class="form-control @error('schedule_id') is-invalid @enderror"
                                                id="schedule_id" name="schedule_id" required>
                                                <option value="">Select a Schedule</option>
                                                @foreach ($schedules as $schedule)
                                                    <option value="{{ $schedule->id }}"
                                                        {{ old('schedule_id', $user->schedule_id) == $schedule->id ? 'selected' : '' }}>
                                                        {{ $schedule->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('schedule_id'))
                                                <span class="text-danger">{{ $errors->first('schedule_id') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Role Checkboxes -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <div>
                                                @forelse ($roles as $role)
                                                    @if ($role != 'Super Admin')
                                                        <div class="u-cheque-btns">
                                                            <input type="checkbox" id="role_{{ $role }}"
                                                                name="roles[]" value="{{ $role }}"
                                                                {{ in_array($role, old('roles', $user->roles->pluck('name')->toArray())) ? 'checked' : '' }}>
                                                            <label
                                                                for="role_{{ $role }}">{{ $role }}</label>
                                                        </div>
                                                    @else
                                                        @if (Auth::user()->hasRole('Super Admin'))
                                                            <div class="u-cheque-btns">
                                                                <input type="checkbox" id="role_{{ $role }}"
                                                                    name="roles[]" value="{{ $role }}"
                                                                    {{ in_array($role, old('roles', $user->roles->pluck('name')->toArray())) ? 'checked' : '' }}>
                                                                <label
                                                                    for="role_{{ $role }}">{{ $role }}</label>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @empty
                                                    <p>No roles available.</p>
                                                @endforelse
                                            </div>
                                            @if ($errors->has('roles'))
                                                <span class="text-danger">{{ $errors->first('roles') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-left">
                                    <button id="btn" class="btn btn-primary" type="submit">Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleCheckboxes = document.querySelectorAll('input[name="roles[]"]');
            const departmentDropdown = document.getElementById('department-dropdown');
            const subDepartmentDropdown = document.getElementById('subdepartment-dropdown');
            const positionDropdown = document.getElementById('position-dropdown');

            roleCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked && this.value === 'Employee') {
                        departmentDropdown.style.display = 'block';
                        subDepartmentDropdown.style.display = 'block';
                        positionDropdown.style.display = 'block';
                    } else if (!this.checked && this.value === 'Employee') {
                        departmentDropdown.style.display = 'none';
                        subDepartmentDropdown.style.display = 'none';
                        positionDropdown.style.display = 'none';
                    }
                });

                // If the page loads with "Employee" role already selected
                if (checkbox.checked && checkbox.value === 'Employee') {
                    departmentDropdown.style.display = 'block';
                    subDepartmentDropdown.style.display = 'block';
                    positionDropdown.style.display = 'block';
                }
            });

            // AJAX request to fetch sub-departments based on selected department
            document.querySelector('select[name="department_id"]').addEventListener('change', function() {
                const departmentId = this.value;
                fetch(`/subdepartments/${departmentId}`)
                    .then(response => response.json())
                    .then(data => {
                        const subDepartmentSelect = document.querySelector(
                            'select[name="sub_department_id"]');
                        subDepartmentSelect.innerHTML =
                            '<option value="">Select a Sub Department</option>';
                        data.forEach(subDepartment => {
                            subDepartmentSelect.innerHTML +=
                                `<option value="${subDepartment.id}">${subDepartment.name}</option>`;
                        });
                    });
            });
        });
    </script>
@endsection
