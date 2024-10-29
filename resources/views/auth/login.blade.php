
<!DOCTYPE html>
<html lang="en">
<!-- basic-form.html  21 Nov 2019 03:54:41 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login</title>

  <link rel="icon" type="image/x-icon" href="{{asset('frontend')}}/images/logo.png">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('admin')}}/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
    <!-- include summernote js-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <link rel="stylesheet" href="{{asset('admin')}}/assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="{{asset('admin')}}/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="{{asset('admin')}}/assets/css/style.css">
  <link rel="stylesheet" href="{{asset('admin')}}/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('admin')}}/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='{{asset('admin')}}/assets/img/w11-stop-logo.png' />
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <style>
        
        form{
                max-width: 100%;
    width: 345px;
    margin: 0px auto;
        }
        .i_lable {
    padding-top: calc(.375rem + 1px);
    padding-bottom: calc(.375rem + 1px);
    margin-bottom: 0;
    font-size: inherit;
    line-height: 1.5;
    padding-left: 5px;
}
.login-container {
    max-width: 100%;
    width: 560px;
}
        
    </style>

</head>
@php
    use Illuminate\Support\Str;
@endphp

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="container">
        <div class="flex-center-xy">

            <div class="card login-container ">
                <div class="card-header"> <img class="logo-w11" src="{{asset('admin')}}/assets/img/w11-stop-logo.png" alt=""></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-12">
                                <label for="email" class="i_lable">{{ __('Email Address') }}</label>
                            </div>
                            <div class="col-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="password" class="i_lable">{{ __('Password') }}</label>
                            </div>

                            <div class="col-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-5 pt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-7 text-right">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset('admin')}}/assets/js/app.min.js"></script>
  <!-- JS Libraies -->

  <script src="{{asset('admin')}}/assets/bundles/datatables/datatables.min.js"></script>
  <script src="{{asset('admin')}}/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{{asset('admin')}}/assets/bundles/jquery-ui/jquery-ui.min.js"></script>

  <script src="{{asset('admin')}}/assets/js/page/datatables.js"></script>
  <script src="{{asset('admin')}}/assets/js/scripts.js"></script>


  <script src="{{asset('admin/assets/bundles/summernote/summernote-bs4.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{asset('admin')}}/assets/js/custom.js"></script>




  @yield('customJs')
</body>


<!-- basic-form.html  21 Nov 2019 03:54:41 GMT -->
</html>
