@extends('layouts.app')

@section('title', 'Manage work_from_home')

@section('content')


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4><i data-feather="clock" class="h-i" ></i> Manage WFH</h4>
                <a class="btn btn-primary" href="{{ route('work_from_home.create') }}">  Add New Departments</a>
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

                                            <th class="text-center">Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($permissions as $permission)
                                        <tr>
                                            <td class="text-center">{{ $permission->id }}</td>
                                            <td class="text-center">{{ $permission->employee->name }}</td>
                                            <td class="text-center">{{ $permission->date }}</td>
                                            <td class="just-flex">

                                                <form class="my-0-mx-auto" action="{{ route('work_from_home.destroy', $permission->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <table>
                                                        <tr>

                                                       
                                                  
                                                        @can('update deparment')
                                                        <td>

                                                            <a href="{{ route('work_from_home.edit', $permission->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                                        </td>
                                                        @endcan

                                                        @can('delete deparment')
                                                          
                                                            <td>
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this Record?');"><i class="fa-regular fa-trash"></i></button>
                                                            </td>
                                                          
                                                        @endcan 
                                                  
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
