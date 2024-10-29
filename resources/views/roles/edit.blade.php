 {{-- ===============  new  =================== --}}




 @extends('layouts.app')


 @section('title', ' Edit Role')

 @section('content')
     <section class="section">
         <div class="section-body">
             <div class="row">


                 <div class="col-12">
                     <div class="card">
                         <div class="card-header d-flex align-items-center justify-content-between py-3 ">
                             <h4><i data-feather="settings" class="h-i"></i> Edit Role</h4>
                             <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
                         </div>
                     </div>
                 </div>


                 <div class="col-12">
                     <div class="card">

                         <div class="card-body">
                             <form action="{{ route('roles.update', $role->id) }}" method="post">
                                 @csrf
                                 @method('PUT')
                                 <div class="row">


                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label>Name</label>
                                             <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                 required id="name" name="name" value="{{ $role->name }}">
                                             @if ($errors->has('name'))
                                                 <span class="text-danger">{{ $errors->first('name') }}</span>
                                             @endif
                                         </div>
                                     </div>



                                     <!--<div class="col-md-6">-->
                                     <!--    <div class="form-group">-->
                                     <!--        <label>Permissions</label>-->
                                     <!--        <select  style="height: 100%;min-height:200px" class="form-control @error('status') is-invalid @enderror" multiple aria-label="permissions" id="permissions" name="permissions[]" >-->
                                     <!--            @forelse ($permissions as $permission)
    -->
                                     <!--            <option value="{{ $permission->id }}" {{ in_array($permission->id, $rolePermissions ?? []) ? 'selected' : '' }}>-->
                                     <!--                {{ $permission->name }}-->
                                     <!--            </option>-->
                                 <!--        @empty-->

                                     <!--
    @endforelse-->
                                     <!--        </select>-->
                                     <!--        @if ($errors->has('permissions'))
    -->
                                     <!--        <span class="text-danger">{{ $errors->first('permissions') }}</span>-->
                                     <!--
    @endif-->
                                     <!--    </div>-->
                                     <!--</div>-->

                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <label>Permissions</label>
                                             <div>
                                                 @forelse ($permissions as $permission)
                                                     <div class="u-cheque-btns">
                                                         <input type="checkbox" id="permission_{{ $permission->id }}"
                                                             name="permissions[]" value="{{ $permission->id }}"
                                                             {{ in_array($permission->id, $rolePermissions ?? []) ? 'checked' : '' }}>

                                                         <label
                                                             for="permission_{{ $permission->id }}">{{ $permission->name }}</label>

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
