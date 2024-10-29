 {{-- ===============  new  =================== --}}




 @extends('layouts.app')


 @section('title', ' subDepartment')

 @section('content')
     <section class="section">
         <div class="section-body">
             <div class="row">


                 <div class="col-12">
                     <div class="card">
                         <div class="card-header d-flex align-items-center justify-content-between py-3 ">
                             <h4><i  data-feather="users" class=" h-i" ></i> Edit Sub Department</h4>
                             <a href="{{ route('subDepartments.index') }}" class="btn btn-primary">Back</a>
                         </div>
                     </div>
                 </div>


                 <div class="col-12">
                     <div class="card">

                         <div class="card-body">
                             <form action="{{ route('subDepartments.update', $subDepartment->id) }}" method="post">
                                 @csrf
                                 @method('PUT')
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label>Name</label>
                                             <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                 required id="name" name="name" value="{{ $subDepartment->name }}">
                                             @if ($errors->has('name'))
                                                 <span class="text-danger">{{ $errors->first('name') }}</span>
                                             @endif
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" required>
                                                <option value="" disabled>Select Department</option>
                                                @foreach ($departments as $depart)
                                                    <option value="{{ $depart->id }}" {{ $subDepartment->department_id == $depart->id ? 'selected' : '' }}>
                                                        {{ $depart->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('department_id'))
                                                <span class="text-danger">{{ $errors->first('department_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                 </div>
                                 <div class="card-footer text-left">
                                     <button id="btn" class="btn btn-primary " type="submit">Update</button>
                                 </div>
                             </form>

                         </div>
                     </div>
                 </div>
             </div>
     </section>
 @endsection
 @section('customJs')

 @endsection
