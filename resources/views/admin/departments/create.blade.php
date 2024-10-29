 @extends('layouts.app')
@section('title',' Add New Ddepartments')

@section('content')
<section class="section">
    <div class="section-body">
      <div class="row">


        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3 ">
              <h4><i  data-feather="package" class=" h-i" ></i>  Add New Departments</h4>
              <a href="{{ route('departments.index') }}" class="btn btn-primary">Back</a>
            </div>
          </div>
        </div>


        <div class="col-md-12">
          <div class="card">

            <div class="card-body">
                <form  action="{{ route('departments.store') }}" method="post">
                    @csrf
                    <div class="row">


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"  class="form-control @error('name') is-invalid @enderror" required
                                id="name" name="name" value="{{ old('name') }}" >
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                                
                        </div>





                    </div>
                    <div class="card-footer text-left">
                        <button id="btn" class="btn btn-primary " type="submit">Add Department</button>
                    </div>
                </form>

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection




