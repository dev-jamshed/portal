@extends('layouts.app')

@section('title', 'Manage Logo Requirements')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4><i data-feather="figma" class=" h-i"></i> Manage Logo Requirements</h4>
                @can('create-logo-requirement')
                    <a class="btn btn-primary" href="{{ route('logo_requirements.create') }}">   Add New Requirement</a>
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
                                            <th class="text-center">S#</th>
                                            <th>Company Name</th>
                                            <th>Products</th>
                                            <th>Logo Name</th>
                                            <th>Tagline</th>
                                            {{-- <th>Website</th> --}}
                                            {{-- <th>Company Address</th> --}}
                                            {{-- <th>Other Requirements</th> --}}
                                            <th>Logo Type</th>
                                            <th>Reference File</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logoRequirements as $requirement)
                                            <tr>
                                                <td>{{ $requirement->id }}</td>
                                                <td>{{ $requirement->company_name }}</td>
                                                <td>{{ $requirement->products }}</td>
                                                <td>{{ $requirement->logo_name }}</td>
                                                <td>{{ $requirement->tagline }}</td>
                                                {{-- <td>{{ $requirement->website }}</td> --}}
                                                {{-- <td>{{ $requirement->company_address }}</td> --}}
                                                {{-- <td>{{ $requirement->other_requirements }}</td> --}}
                                                <td>{{ $requirement->logotype }}</td>
                                                <td>
                                                    @if ($requirement->reference_file)
                                                        <a href="{{ asset($requirement->reference_file) }}"
                                                            target="_blank">View File</a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('logoRecruitment.edit', $requirement->id) }}" class="btn btn-secondary btn-sm"><i class="fa-regular fa-eye h-i-2"></i></a>


                                                        {{-- <a href="{{ route('logoRecruitment.edit', $requirement->id) }}"
                                                            class="btn btn-primary btn-sm" title="Edit Requirement"><i
                                                                class="fa-regular fa-pen-to-square"></i></a> --}}
                                                        {{-- Add other actions if needed --}}
                                                    </div>
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
    {{-- Add any custom JavaScript here --}}
@endsection
