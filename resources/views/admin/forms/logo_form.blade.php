<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo Requirement Specification</title>

    <!-- //Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                <form action="{{ route('logoRecruitment') }}" method="post" id="payment-form"
                    enctype='multipart/form-data'>
                    @csrf
                    <!-- //Heading -->
                    <div class="heading">
                        <h3>Logo Requirement Specification</h3>
                    </div>

                    <!-- //input Fields  -->
                    <div class="row mx-4 my-3">
                        <div class="col-12 ">

                            <p class="mini-heading">The following form will help us when approaching for designing the
                                logo. It contains all of the necessary information we need in order to create a good
                                logo design for you</p>


                            <p>Please fill in the form with accurate answers:</p>

                        </div>
                    </div>

                    <!-- //Heading -->
                    <div class="heading">
                        <h3>Logo Requirement </h3>
                    </div>

                    <div class="row mx-4 my-3">

                        <div class="col-md-6 ">
                            <div class="input-div">
                                <label>Business/Company Name :</label>
                                <input required type="text" name="company_name" placeholder="Business/Company...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Main Products | Services :</label>
                                <input required type="text" name="products" placeholder="Products / Services...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Exact name to be appeared on logo :</label>
                                <input required name="logo_name" type="text" placeholder="Exact Name...">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Any Tagline/Slogan? :</label>
                                <input required type="text" name="tagline" placeholder="Slogan...">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Do you have any existing website? :</label>
                                <input required type="text" name="website" placeholder="Reference Website URL ...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Company/Factory Address :</label>
                                <input required type="text" name="company_address"
                                    placeholder="Company/Factory Address...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-div">
                                <label>Do you have any other requirements or suggestions? :</label>
                                <input required type="text" name="other_requirements" placeholder="Suggestion...">
                            </div>
                        </div>

                    </div>

                    <!-- //Heading -->
                    <div class="heading">
                        <h3>Please select the design you like </h3>
                    </div>

                    <div class="row mx-4 my-3">


                        <div class="col-md-12">
                            <div class="logo_type_container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-3">
                                        <div class="flex_1">
                                            <label class="logo_label" for="Abstracted">Abstracted Logo </label>
                                            <input value="Abstracted" type="radio" id="Abstracted" name="logotype">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-9">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Abstract logo/1.jpg') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Abstract logo/2.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Abstract logo/3.webp') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Abstract logo/4.jpg') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="logo_type_container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-3">
                                        <div class="flex_1">
                                            <label class="logo_label" for="combination">Combination Based Logo
                                            </label>
                                            <input value="combination" type="radio" id="combination" name="logotype">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-9">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/combination/1.jpeg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/combination/2.png ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/combination/3.jpeg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/combination/4.png ') }}"
                                                    alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="logo_type_container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-3">
                                        <div class="flex_1">
                                            <label class="logo_label" for="handmade">Hand Made Logo </label>
                                            <input value="handmade" type="radio" id="handmade" name="logotype">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-9">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/hand made/1.jpg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/hand made/2.jpg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/hand made/3.jpg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/hand made/4.png ') }}"
                                                    alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="logo_type_container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-3">
                                        <div class="flex_1">
                                            <label class="logo_label" for="mascot">Mascot Logo </label>
                                            <input  value="mascot" type="radio" id="mascot" name="logotype">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-9">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/mascot logo/1.jpeg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/mascot logo/2.jpg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/mascot logo/3.jpeg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/mascot logo/4.jpg ') }}"
                                                    alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="logo_type_container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-3">
                                        <div class="flex_1">
                                            <label class="logo_label" for="monogrambased">Monogram based Logo </label>
                                            <input value="monogrambased" type="radio" id="monogrambased" name="logotype">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-9">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/monogrambased/1.png ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/monogrambased/2.jpg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/monogrambased/3.png ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/monogrambased/4.png ') }}"
                                                    alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="logo_type_container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-3">
                                        <div class="flex_1">
                                            <label class="logo_label" for="Illustration">Symbolic Illustration Logo
                                            </label>
                                            <input value="Illustration" type="radio" id="Illustration" name="logotype">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-9">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Symbolic Illustration/1.jpg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Symbolic Illustration/2.png ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Symbolic Illustration/3.jpeg ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Symbolic Illustration/4.jpg ') }}"
                                                    alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="logo_type_container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-3">
                                        <div class="flex_1">
                                            <label class="logo_label" for="WordMark">Word Mark Logo </label>
                                            <input value="WordMark" type="radio" id="WordMark" name="logotype">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-9">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Word Mark/1.png ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Word Mark/2.png ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Word Mark/3.png ') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <img class="logo-type"
                                                    src="{{ asset('frontend/images/Word Mark/4.png ') }}"
                                                    alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="input-div">
                                <label>Any Reference files or existing Logo? (PNG, JPG) :</label>
                                <input type="file" name="reference_file" placeholder="Suggestion..."
                                    style="padding: 4.4px;">
                            </div>
                        </div>

                        <div class="col-12 my-2">
                            <div class="mb-2">
                                <input required type="checkbox" id="agreeCheck">
                                <label style="cursor: pointer;font-size:12px" for="agreeCheck"> I accept
                                    <a data-bs-toggle="modal" data-bs-target="#termsConditions" class="a">Terms
                                        condition</a> and
                                    <a data-bs-toggle="modal" data-bs-target="#privacyPolicy" class="a">Privacy
                                        Policy.</a></label>
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
