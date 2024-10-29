 
{{-- ===============  new  =================== --}}




@extends('layouts.app')


@section('title','  Role Information')

@section('content')
<section class="section">
    <div class="section-body">
      <div class="row">


        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3 ">
              <h4>  Role Information</h4>
              <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
            </div>
          </div>
        </div>


        <div class="col-12">
          <div class="card">

            <div class="card-body">


                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;font-weight:600">
                        {{ $role->name }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Permissions:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        @if ($role->name=='Super Admin')
                            <span class="badge bg-primary">All</span>
                        @else
                            @forelse ($rolePermissions as $permission)
                                <span class="badge badge-primary badge-shadow">{{ $permission->name }}</span>
                            @empty
                            @endforelse
                        @endif
                    </div>
                </div>

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('customJs')

@endsection



