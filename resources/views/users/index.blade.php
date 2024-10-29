 {{-- ================== new ====================== --}}

 @extends('layouts.app')

 @section('title', 'Manage Users')

 @section('content')


     <section class="section">
         <div class="card">
             <div class="card-header">
                 <h4><i class="fa-regular fa-user h-i"></i> Manage Users</h4>
                 @can('create-user')
                     <a class="btn btn-primary" href="{{ route('users.create') }}"> Add New
                         User</a>
                 @endcan
             </div>
         </div>
     </section>


     <section class="section">
         <div class="section-body">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-striped" id="table-1">
                                     <thead>
                                         <tr>
                                             <th class="text-center">
                                                 S#
                                             </th>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Deparment</th>
                                             <th>Roles</th>

                                             <th class="text-center">Actions</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($users as $user)
                                             <tr>
                                                 <td>{{ $user->id }}</td>
                                                 <td>{{ $user->name }}</td>
                                                 <td>{{ $user->email }}</td>
                                                 <td>

                                                    <span class="badge badge-primary badge-shadow"> {{ $user->department?->name ?? 'N/A' }}</span>

                                                   
                                                
                                                </td>

                                                 <td>
                                                   @foreach ($user->getRoleNames() as $role)
    <span class="badge badge-primary badge-shadow">{{ $role }}</span>
@endforeach

                                                 </td>
                                                 <td>
                                                     <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                         <table>
                                                             <tr>
                                                                 @csrf
                                                                 @method('DELETE')
                                                                 @if (in_array('super-admin', $user->getRoleNames()->toArray() ?? []))
                                                                     @if (Auth::user()->hasRole('super-admin'))
                                                                         <td>

                                                                             <a href="{{ route('users.edit', $user->id) }}"
                                                                                 class="btn btn-primary btn-sm"><i
                                                                                     class="fa-regular fa-pen-to-square"></i></a>
                                                                         </td>
                                                                     @endif
                                                                 @else
                                                                     @can('edit-user')
                                                                         <td>
                                                                             <a href="{{ route('users.edit', $user->id) }}"
                                                                                 class="btn btn-primary btn-sm"><i
                                                                                     class="fa-regular fa-pen-to-square"></i></a>
                                                                         </td>
                                                                     @endcan

                                                                     @can('delete-user')
                                                                         @if (Auth::user()->id != $user->id)
                                                                             <td>
                                                                                 <button type="submit"
                                                                                     class="btn btn-danger btn-sm  "
                                                                                     onclick="return confirm('Do you want to delete this user?');"><i
                                                                                         class="fa-regular fa-trash"></i></button>
                                                                             </td>
                                                                         @endif
                                                                     @endcan
                                                                 @endif
                                                             </tr>
                                                         </table>
                                                     </form>
                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
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
