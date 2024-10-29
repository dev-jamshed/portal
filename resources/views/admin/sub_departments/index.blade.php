@extends('layouts.app')

@section('title', 'Manage Departments')

@section('content')

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4><i  data-feather="users" class=" h-i" ></i> Manage Sub Departments</h4>
                <a class="btn btn-primary" href="{{ route('subDepartments.create') }}">  Add New Sub Departments</a>
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
                                            <th class="text-center">Sub Department</th>
                                            <th class="text-center">Department</th>

                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subDepartments as $department)
                                        <tr>
                                            <td class="text-center">{{ $department->id }}</td>
                                            <td class="text-center">{{ $department->name }}</td>
                                            <td class="text-center">{{ optional($department->department)->name ?? 'N/A' }}</td>


                                            <td class="just-flex">

                                                <form class="my-0-mx-auto" action="{{ route('subDepartments.destroy', $department->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <table>
                                                        <tr>

                                                       
                                                  
                                                        {{-- @can('update deparment') --}}
                                                        <td>

                                                            <a href="{{ route('subDepartments.edit', $department->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                                        </td>
                                                        {{-- @endcan --}}

                                                        {{-- @can('delete deparmente') --}}
                                                           
                                                            <td>
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Departments?');"><i class="fa-regular fa-trash"></i></button>
                                                            </td>
                                                         
                                                        {{-- @endcan  --}}
                                                  
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
