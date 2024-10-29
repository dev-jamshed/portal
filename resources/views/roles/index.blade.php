 
{{-- ================== new ====================== --}}

@extends('layouts.app')

@section('title', 'Manage Roles')

@section('content')


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4><i data-feather="settings" class="h-i" ></i> Manage Roles</h4>

                <a class="btn btn-primary" href="{{ route('roles.create') }}">  Add New Role</a>

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
                                            <th class="text-center">Name</th>

                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td class="text-center">{{ $role->id }}</td>
                                            <td class="text-center">{{ $role->name }}</td>





                                            <td class="just-flex">

                                                <form class="my-0-mx-auto" action="{{ route('roles.destroy', $role->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <table>
                                                        <tr>

                                                        <td>

                                                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-secondary btn-sm"><i class="fa-regular fa-eye h-i-2"></i></a>
                                                        </td>

                                                    {{-- @if ($role->name!='super-admin') --}}
                                                        {{-- @can('edit-role') --}}
                                                        <td>

                                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                                        </td>
                                                        {{-- @endcan --}}

                                                        @can('delete-role')
                                                            @if ($role->name!=Auth::user()->hasRole($role->name))
                                                            <td>
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this role?');"><i class="fa-regular fa-trash"></i></button>
                                                            </td>
                                                            @endif
                                                        @endcan
                                                    {{-- @endif --}}
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
