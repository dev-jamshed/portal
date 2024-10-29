 {{-- ===============  new  =================== --}}




 @extends('layouts.app')


 @section('title', ' Department')

 @section('content')
     <section class="section">
         <div class="section-body">
             <div class="row">


                 <div class="col-12">
                     <div class="card">
                         <div class="card-header d-flex align-items-center justify-content-between py-3 ">
                             <h4> Edit Department</h4>
                             <a href="{{ route('departments.index') }}" class="btn btn-primary">Back</a>
                         </div>
                     </div>
                 </div>


                 <div class="col-12">
                     <div class="card">

                         <div class="card-body">
                             <form action="{{ route('departments.update', $department->id) }}" method="post">
                                 @csrf
                                 @method('PUT')
                                 <div class="row">


                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <label>Name</label>
                                             <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                 required id="name" name="name" value="{{ $department->name }}">
                                             @if ($errors->has('name'))
                                                 <span class="text-danger">{{ $errors->first('name') }}</span>
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
