@extends('layouts.app')

@section('title', 'View Website Requirement')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4><i data-feather="figma" class=" h-i"></i> View Website Requirement</h4>
            </div>

            <div class="card-body">
                <form>
                    @csrf
                    @method('GET')

                    <!-- Check if data is available and display it -->
                    @if ($requirement)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $requirement->company_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="products">Products</label>
                                    <input type="text" name="products" id="products" class="form-control" value="{{ $requirement->products }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo_name">Logo Name</label>
                                    <input type="text" name="logo_name" id="logo_name" class="form-control" value="{{ $requirement->logo_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tagline">Tagline</label>
                                    <input type="text" name="tagline" id="tagline" class="form-control" value="{{ $requirement->tagline }}" disabled>
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
                                    <label for="other_requirements">Other Requirements</label>
                                    <input type="text" name="other_requirements" id="other_requirements" class="form-control" value="{{ $requirement->other_requirements }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logotype">Logotype</label>
                                    <input type="text" name="logotype" id="logotype" class="form-control" value="{{ $requirement->logotype }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="created_at">Created At</label>
                                    <input type="text" name="created_at" id="created_at" class="form-control" value="{{ $requirement->created_at->format('d M Y H:i') }}" disabled>
                                </div>
                            </div>

                           
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updated_at">Updated At</label>
                                        <input type="text" name="updated_at" id="updated_at" class="form-control" value="{{ $requirement->updated_at->format('d M Y H:i') }}" disabled>
                                    </div>
                                </div>
                           
                              
                                
                                

                        </div>

                     

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

                    @else
                        <p>No data available</p>
                    @endif

                    <a href="{{ route('website_requirements.index') }}" class="btn btn-secondary">Back to List</a>
                </form>
            </div>
        </div>
    </section>
@endsection