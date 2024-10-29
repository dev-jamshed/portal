@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <h4><i   data-feather="message-square" class="  h-i"></i> Create Ticket</h4>
                            <a href="{{ route('tickets.index') }}" class="btn btn-primary">Back</a>
                        </div>

                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                
                            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    
                                      <div class="form-group col-md-4">
                                            <label>Company Name</label>
                                            <input type="text" required id="c_company_name" name="c_company_name"
                                                class="form-control" value="">
                                        </div>
                                    
                                    <!-- Common fields -->
                                    <div class="form-group col-md-4">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" value="{{ old('subject') }}"
                                            required>
                                    </div>
                                    
                                    
                                    
                                      
                                        
                                        
                                          <div class="form-group col-md-4">
                                            <label>Deadline</label>
                                            <input type="date" name="project_deadline" class="form-control"
                                                value="{{ old('project_deadline') }}" required>
                                        </div>
                                        
                                        
                                    
                                  

                                    <!-- Multiple Department Selection -->
                                    <div class="form-group col-md-4">
                                        <label>Departments</label>
                                        <select id="department_id" name="department_ids[]" class="form-control"
                                            >
                                    
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ in_array($department->id, old('department_ids', [])) ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Multiple Sub Department Selection -->
                                    @if (in_array('sub_department_id', $fields))
                                    <div class="form-group col-md-4">
                                        <label>Sub Departments</label>
                                        <select id="sub_department_id" name="sub_department_ids[]"
                                            class="form-control " >
                                            @foreach ($subDepartments as $subDepartment)
                                                <option value="{{ $subDepartment->id }}"
                                                    {{ in_array($subDepartment->id, old('sub_department_ids', [])) ? 'selected' : '' }}>
                                                    {{ $subDepartment->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    
                                      <div class="form-group col-md-4">
                                        <label>Priority</label>
                                        
                                        <select name="priority" class="form-control" required>
                                            <option value="low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low
                                            </option>
                                            <option value="medium" {{ old('priority') == 'Medium' ? 'selected' : '' }}>Medium
                                            </option>
                                            <option value="high" {{ old('priority') == 'High' ? 'selected' : '' }}>High
                                            </option>
                                        </select>
                                    </div>
                                    
                                     

                                    
                                        

                                    <div class="form-group col-md-12">
                                        <label>Message</label>
                                        <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>

                                    <!-- Multiple Employee Selection -->
                                    @if (in_array('employee_id', $fields))
                                    <div class="form-group col-md-6">
                                        <label>CC</label>
                                        <select id="employee_id" name="employee_ids[]" class="form-control select2"
                                            multiple>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ in_array($employee->id, old('employee_ids', [])) ? 'selected' : '' }}>
                                                    {{ $employee->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif


                                    {{-- ================================================ --}}

                                    <!-- Conditional fields for Sales department -->
                                    @if ($user->department && $user->department->name === 'Sales')


                                        <div class="form-group col-md-6">
                                            <label>Client</label>
                                            <select name="client_id" id="clients" class="form-control">
                                                <option value="">Select Client</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Client Name</label>
                                            <input type="text" required id="c_name" name="c_name" class="form-control"
                                                value="">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Client Address</label>
                                            <input type="text" required id="c_address" name="c_address" class="form-control"
                                                value="">
                                        </div>



                                        <!--<div class="form-group col-md-6">-->
                                        <!--    <label>Client Company Name</label>-->
                                        <!--    <input type="text" required id="c_company_name" name="c_company_name"-->
                                        <!--        class="form-control" value="">-->
                                        <!--</div>-->

                                        <div class="form-group col-md-6">
                                            <label>Client Phone no</label>
                                            <input type="tel" required id="c_mobile_number" name="c_mobile_number"
                                                class="form-control" value="">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Client Email</label>
                                            <input type="email" required id="c_email" name="c_email" class="form-control"
                                                value="">
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label>Country:</label>
                                            <select required id="country" name="c_country" class="selectpicker form-control"
                                                data-style="py-0">
                                                <option value="">Select Country</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="India">India</option>
                                                <option value="USA">USA</option>
                                                <option value="Uk">Uk</option>
                                                <option value="Africa">Africa</option>
                                            </select>
                                        </div>
                                    @endif

                                    @if ($showProjectFields)
                                        <div class="form-group col-md-6">
                                            <label>Project Name</label>
                                            <input type="text" name="project_name" class="form-control"
                                                value="{{ old('project_name') }}" required>
                                        </div>

                                        <!--<div class="form-group col-md-6">-->
                                        <!--    <label>Project Deadline</label>-->
                                        <!--    <input type="date" name="project_deadline" class="form-control"-->
                                        <!--        value="{{ old('project_deadline') }}" required>-->
                                        <!--</div>-->
                                    @endif
    
                                    @if ($showProjectFields)
                                        <div class="form-group col-md-6">
                                            <label>Price</label>
                                            <input type="text" name="price" class="form-control"
                                                value="{{ old('price') }}">
                                        </div>
                                    @endif

                                
                                    <!-- File Attachments -->
                                    <div class="form-group col-md-6">
                                        <label>Attachments</label>
                                        <input type="file" name="attachments[]" class="form-control" multiple>
                                    </div>


                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Create Ticket</button>
                                    </div>


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
            const departmentDropdown = document.getElementById('department_id');
            const subDepartmentDropdown = document.getElementById('sub_department_id');
            const employeeDropdown = document.getElementById('employee_id');

            // Fetch sub-departments based on selected department
            departmentDropdown.addEventListener('change', function() {
                const departmentId = this.value;
                if (departmentId) {
                    fetch(`/get-sub-departments/${departmentId}`)
                        .then(response => response.json())
                        .then(data => {
                            subDepartmentDropdown.innerHTML =
                                '<option value="">Select a Sub Department</option>';
                            data.forEach(subDept => {
                                subDepartmentDropdown.innerHTML +=
                                    `<option value="${subDept.id}">${subDept.name}</option>`;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
            $(document).ready(function() {
                $('#clients').select2({
                    placeholder: "Select clients", // Placeholder text
                    allowClear: true, // Option to clear the selection
                    
                });
                // $('#department_id').select2({
                //     placeholder: "Select departments", // Placeholder text
                //     allowClear: true // Option to clear the selection
                // });
                // $('#sub_department_id').select2({
                //     placeholder: "Select Sub departments", // Placeholder text
                //     allowClear: true // Option to clear the selection
                // });
                $('#employee_id').select2({
                    placeholder: "Select CC", // Placeholder text
                    allowClear: true // Option to clear the selection
                });
            });
            
            $('#clients').on('select2:select', function(e) {
                var selectedOption = $(e.currentTarget).find("option:selected");
                var clientId = selectedOption.val();
                // Fetch client record using AJAX
                $.ajax({
                    url: '{{ route('client.fetch') }}',
                    type: 'GET',
                    data: {
                        clientId: clientId
                    },
                    success: function(response) {
                        console.log(response);
                        // Populate input fields with fetched data
                        $('#c_name').val(response.name);
                        // $('#lname').val(response.last_name);
                        $('#c_address').val(response.address);
                        $('#c_company_name').val(response.company_name);
                        $('#c_mobile_number').val(response.mobile_number);
                        $('#c_email').val(response.email);
                        // Auto-fill client's country
                        $('[name="c_country"]').val(response.country).trigger('change');

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            tinymce.init({
                selector: '#description',
            });


        });
    </script>
@endsection
