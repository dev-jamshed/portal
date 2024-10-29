 
{{-- ===============  new  =================== --}}




@extends('layouts.app')


@section('title',' Add New Role')

@section('content')
<section class="section">
    <div class="section-body">
      <div class="row">


        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3 ">
              <h4><i data-feather="settings" class="h-i" ></i> Add New Role</h4>
              <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
            </div>
          </div>
        </div>


        <div class="col-md-12">
          <div class="card">

            <div class="card-body">
                <form  action="{{ route('roles.store') }}" method="post">
                    @csrf
                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"  class="form-control @error('name') is-invalid @enderror" required
                                id="name" name="name" value="{{ old('name') }}" >
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                                
                        </div>



<div class="col-md-12">
    <div class="form-group">
        <label>Permissions</label>
        <div>
            @forelse ($permissions as $permission)
                <div class="u-cheque-btns">
                    <input type="checkbox" 
                           id="permission_{{ $permission->id }}" 
                           name="permissions[]" 
                           value="{{ $permission->id }}" 
                           {{ in_array($permission->id, old('permissions') ?? []) ? 'checked' : '' }}>
                     
                        <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                    
                </div>
            @empty
                <p>No permissions available.</p>
            @endforelse
        </div>
        @if ($errors->has('permissions'))
            <span class="text-danger">{{ $errors->first('permissions') }}</span>
        @endif
    </div>
</div>



                    </div>
                    <div class="card-footer text-left">
                        <button id="btn" class="btn btn-primary " type="submit">Add Role</button>
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



