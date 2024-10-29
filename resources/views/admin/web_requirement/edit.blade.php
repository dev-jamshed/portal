@extends('layouts.app')

@section('title', 'View Website Requirement')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4><i  data-feather="clipboard" class=" h-i"></i> View Website Requirement</h4>
            </div>

            <div class="card-body">
                <form>
                    @csrf
                    @method('GET')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $requirement->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $requirement->company_name }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $requirement->phone }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $requirement->email }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" name="website" id="website" class="form-control" value="{{ $requirement->website }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_address">Company Address</label>
                                <input type="text" name="company_address" id="company_address" class="form-control" value="{{ $requirement->company_address }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="business_type">Business Type</label>
                                <input type="text" name="business_type" id="business_type" class="form-control" value="{{ $requirement->business_type }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="industry">Industry</label>
                                <input type="text" name="industry" id="industry" class="form-control" value="{{ $requirement->industry }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="main_products">Main Products</label>
                                <input type="text" name="main_products" id="main_products" class="form-control" value="{{ $requirement->main_products }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="website_purpose">Website Purpose</label>
                                <input type="text" name="website_purpose" id="website_purpose" class="form-control" value="{{ $requirement->website_purpose }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="domain_name">Domain Name</label>
                                <input type="text" name="domain_name" id="domain_name" class="form-control" value="{{ $requirement->domain_name }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="competitor_website">Competitor Website</label>
                                <input type="text" name="competitor_website" id="competitor_website" class="form-control" value="{{ $requirement->competitor_website }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_role">Client Role</label>
                                <input type="text" name="client_role" id="client_role" class="form-control" value="{{ $requirement->client_role }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="color_theme">Color Theme</label>
                                <input type="text" name="color_theme" id="color_theme" class="form-control" value="{{ $requirement->color_theme }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="web_design_suggestion">Web Design Suggestion</label>
                                <input type="text" name="web_design_suggestion" id="web_design_suggestion" class="form-control" value="{{ $requirement->web_design_suggestion }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_introduction">Company Introduction</label>
                                <input type="text" name="company_introduction" id="company_introduction" class="form-control" value="{{ $requirement->company_introduction }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categories_names">Categories Names</label>
                                <input type="text" name="categories_names" id="categories_names" class="form-control" value="{{ $requirement->categories_names }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_names">Product Names</label>
                                <input type="text" name="product_names" id="product_names" class="form-control" value="{{ $requirement->product_names }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="special_requirement">Special Requirement</label>
                                <input type="text" name="special_requirement" id="special_requirement" class="form-control" value="{{ $requirement->special_requirement }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_at">Created At</label>
                                <input type="text" name="created_at" id="created_at" class="form-control" value="{{ $requirement->created_at->format('d M Y H:i') }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reference_file">Reference File</label>
                                @if ($requirement->reference_file)
                                    <a href="{{ asset($requirement->reference_file) }}" target="_blank">View File</a>
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('website_requirements.index') }}" class="btn btn-secondary">Back to List</a>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    {{-- Add any custom JavaScript here --}}
@endsection
