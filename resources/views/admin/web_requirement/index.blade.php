{{-- ================== new ====================== --}}

@extends('layouts.app')

@section('title', 'Manage Website Requirements')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4><i  data-feather="clipboard" class=" h-i"></i> Manage Website Requirements</h4>
                @can('create-website-requirement')
                    <a class="btn btn-primary" href="{{ route('website_requirements.create') }}"> <i
                            class="fa-solid fa-plus h-i-2"></i>Add New Requirement</a>
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
                                            <th>Name</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Website</th>
                                            {{-- <th>Company Address</th>
                                            <th>Business Type</th>
                                            <th>Industry</th>
                                            <th>Main Products</th>
                                            <th>Website Purpose</th>
                                            <th>Domain Name</th>
                                            <th>Competitor Website</th>
                                            <th>Client Role</th>
                                            <th>Color Theme</th>
                                            <th>Web Design Suggestion</th>
                                            <th>Company Introduction</th>
                                            <th>Categories Names</th>
                                            <th>Product Names</th>
                                            <th>Special Requirement</th> --}}
                                            <th>Reference File</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($websiteRequirements as $requirement)
                                            <tr>
                                                <td>{{ $requirement->id }}</td>
                                                <td>{{ $requirement->name }}</td>
                                                <td>{{ $requirement->company_name }}</td>
                                                <td>{{ $requirement->email }}</td>
                                                <td>{{ $requirement->phone }}</td>
                                                <td>{{ $requirement->website }}</td>
                                                {{-- <td>{{ $requirement->company_address }}</td> --}}
                                                {{-- <td>{{ $requirement->business_type }}</td> --}}
                                                {{-- <td>{{ $requirement->industry }}</td> --}}
                                                {{-- <td>{{ $requirement->main_products }}</td> --}}
                                                {{-- <td>{{ $requirement->website_purpose }}</td>
                                                <td>{{ $requirement->domain_name }}</td>
                                                <td>{{ $requirement->competitor_website }}</td>
                                                <td>{{ $requirement->client_role }}</td>
                                                <td>{{ $requirement->color_theme }}</td>
                                                <td>{{ $requirement->web_design_suggestion }}</td>
                                                <td>{{ $requirement->company_introduction }}</td>
                                                <td>{{ $requirement->categories_names }}</td>
                                                <td>{{ $requirement->product_names }}</td>
                                                <td>{{ $requirement->special_requirement }}</td> --}}
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
{{-- 
                                                        <a href="{{ route('website_requirements.edit', $requirement->id) }}"
                                                            class="btn btn-primary btn-sm" title="Edit Requirement"><i
                                                                class="fa-regular fa-pen-to-square"></i></a> --}}

                                                                <a href="{{ route('website_requirements.edit', $requirement->id) }}" class="btn btn-secondary btn-sm"><i class="fa-regular fa-eye h-i-2"></i></a>

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
