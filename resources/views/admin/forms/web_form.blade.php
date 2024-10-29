<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Requirements Specification Form</title>

            <!-- //Bootstrap Link -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
            <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    <div class="container">
        <div class="content-container">

            <div class="logo">
                <img src="{{ asset('frontend/images/logo-main.png') }}" alt="">
            </div>


            <!-- Modal -->
            <div class="modal fade" id="termsConditions" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Terms Conditions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>terms Conditions Here Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum
                                neque saepe hic possimus quo! Consequuntur ea voluptate dicta magnam hic asperiores
                                vitae inventore? Rerum deserunt nobis totam ab. Earum, minus?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="submit-btn" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="privacyPolicy" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Privacy Policy</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Privacy Policy Here Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum neque
                                saepe hic possimus quo! Consequuntur ea voluptate dicta magnam hic asperiores vitae
                                inventore? Rerum deserunt nobis totam ab. Earum, minus?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="submit-btn" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="checkout-wrapper">
                @csrf
                <form method="post" action="{{ route('websiteRecruitment') }}" id="payment-form"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Heading -->
                    <div class="heading">
                        <h3>Website Requirements Specification Form</h3>
                    </div>

                    <!-- Input Fields -->
                    <div class="row mx-4 my-3">
                        <div class="col-12">
                            <p class="mini-heading">
                                The following form will help you when you approach us for a website development project
                                – It contains all the necessary information required to build a precise proposal for
                                you.
                                Important Note:
                            </p>

                            <ul>
                                <li>The client will be required to provide us with the information: company
                                    introduction, about us, contact us, pictures, descriptions, and other details
                                    related to the product line.</li>
                                <li>We will post 20 products on your behalf. If you wish to post more products, a
                                    comprehensive user guide will be provided.</li>
                                <li>In the case of revision, we would like you to provide feedback in a single word
                                    document file.</li>
                                <li>The timeline for revision will vary from <b>24</b> to <b>48</b> working hours.</li>
                                <li>In the case of a complete redesign, the timeline of delivery may vary from <b>48</b>
                                    to <b>72</b> working hours.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Heading -->
                    <div class="heading">
                        <h3>CONTACT INFORMATION</h3>
                    </div>

                    <div class="row mx-4 my-3">
                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Name :</label>
                                <input type="text" name="name" placeholder="Name...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Business/Company Name :</label>
                                <input type="text" name="company_name" placeholder="Business/Company...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Phone :</label>
                                <input type="tel" name="phone" placeholder="Phone...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Email Address :</label>
                                <input type="email" name="email" placeholder="Email...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Current Website (If Any) :</label>
                                <input type="text" name="website" placeholder="www.example.com ...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Company/Factory Address :</label>
                                <input type="text" name="company_address" placeholder="Company/Factory Address...">
                            </div>
                        </div>
                    </div>

                    <!-- Heading -->
                    <div class="heading">
                        <h3>COMPANY & PRODUCT / SERVICE INFORMATION</h3>
                    </div>

                    <div class="row mx-4 my-3">
                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Are you :</label>
                                <select name="business_type">
                                    <option selected disabled>Please Select</option>
                                    <option value="Manufacturer">Manufacturer</option>
                                    <option value="Trader">Trader</option>
                                    <option value="Agent">Agent</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Industry :</label>
                                <input type="text" name="industry" placeholder="Industry:...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Main Products :</label>
                                <input type="text" name="main_products" placeholder="Main Products...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Company Slogan (if any) :</label>
                                <input type="text" name="company_slogan" placeholder="Company Slogan...">
                            </div>
                        </div>
                    </div>

                    <!-- Heading -->
                    <div class="heading">
                        <h3>WEBSITE INFORMATION</h3>
                    </div>

                    <div class="row mx-4 my-3">
                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Are you :</label>
                                <select name="website_purpose">
                                    <option selected disabled>Please Select</option>
                                    <option value="Manufacturer">Manufacturer</option>
                                    <option value="Trader">Trader</option>
                                    <option value="Agent">Agent</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Domain Name Suggestion :</label>
                                <input type="text" name="domain_name" placeholder="Domain Name:...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>List Competitor Website :</label>
                                <input type="text" name="competitor_website" placeholder="Competitor Website...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>What's the role of this website :</label>
                                <select name="client_role" id="roleSelect">
                                    <option selected disabled>Please Select</option>
                                    <option value="sales_channel">Sales Channel</option>
                                    <option value="information_portal">Information Portal</option>
                                    <option value="other">Other</option>
                                </select>
                                <input type="text" id="otherInput" name="other_role" placeholder="Please specify"
                                    style="display:none; margin-top: 10px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Color Theme Suggestion :</label>
                                <input type="text" name="color_theme" placeholder="Color Theme Suggestion...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Website Design Suggestion :</label>
                                <input type="text" name="web_design_suggestion"
                                    placeholder="Website Design Suggestion...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Company Introduction :</label>
                                <input type="text" name="company_introduction"
                                    placeholder="Company Introduction...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Categories Names :</label>
                                <input type="text" name="categories_names" placeholder="Categories Names...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Product names :</label>
                                <input type="text" name="product_names" placeholder="Product names...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>ANY SPECIAL REQUIREMENT :</label>
                                <input type="text" name="special_requirement"
                                    placeholder="Special Requirement...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Any Reference file :</label>
                                <input type="file" name="reference_file" placeholder="Suggestion..."
                                    style="padding: 4.4px;">
                            </div>
                        </div>

                        <div class="col-12 my-2">
                            <div class="mb-2">
                                <input type="checkbox" id="agreeCheck" name="terms_and_conditions" required>
                                <label style="cursor: pointer; font-size:12px" for="agreeCheck"> I accept
                                    <a data-bs-toggle="modal" data-bs-target="#termsConditions" class="a">Terms
                                        condition</a> and
                                    <a data-bs-toggle="modal" data-bs-target="#privacyPolicy" class="a">Privacy
                                        Policy.</a>
                                </label>
                            </div>
                            <input type="submit" class="submit-btn" value="Submit">
                        </div>
                    </div>
                </form>
            </div>

            <script>
                const roleSelect = document.getElementById('roleSelect');
                const otherInput = document.getElementById('otherInput');

                roleSelect.addEventListener('change', function() {
                    if (this.value === 'other') {
                        otherInput.style.display = 'block';
                    } else {
                        otherInput.style.display = 'none';
                    }
                });
            </script>



        </div>
    </div>

    <!-- //Bootstrap Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>



</body>

</html>
