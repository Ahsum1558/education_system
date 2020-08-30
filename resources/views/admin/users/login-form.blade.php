<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coaching | Login Form</title>
    <!--    Font Awesome Stylesheet-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/fonts/fa/css/all.min.css') }}">
    <!--    Animate CSS-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/bootstrap.min.css') }}">
    <!--    Theme Stylesheet-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('public/admin/assets/images/favicon.png') }}" type="image/x-icon">
</head>
<body>

<!--Content Start-->
<section class="container-fluid">
    <div class="row content login-form">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Admin Login Form</h4>
                </div>
            </div>
            <form action="{{ route('login') }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form-inline">
                @csrf

                <div class="form-group col-12 mb-3">
                    <label for="mobile" class="col-sm-3 col-form-label text-right">{{ __('Mobile Number') }}</label>
                    <input type="text" name="mobile" placeholder="Mobile Number" class="form-control col-sm-9 @error('mobile') is-invalid @enderror" id="mobile" minlength="8" value="{{ old('mobile') }}" autofocus>
                    {{-- <span class="text-danger"></span> --}}
                    @error('mobile')
                    <span class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{-- <div class="form-group col-12 mb-3">
                    <label for="email" class="col-sm-3 col-form-label text-right">{{ __('E-Mail Address') }}</label>
                    <input type="text" name="email" placeholder="Email Address" class="form-control col-sm-9 @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
 --}}
                <div class="form-group col-12 mb-3">
                    <label for="password" class="col-sm-3 col-form-label text-right">{{ __('Password') }}</label>
                    <div class="input-group col-sm-9 pl-0 pr-0">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" name="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="passwordToggle"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    {{-- <span class="text-danger"></span> --}}
                </div>

                {{-- <div class="form-group col-12 mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input col-sm-3 col-form-label" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div> --}}



                <div class="form-group col-12 mb-3">
                    <label class="col-sm-3"></label>
                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">{{ __('Login') }}</button>

                   {{--  @if (Route::has('password.request'))
                        <a class="btn btn-link text-center col-12 col-sm-9 mb-3 btn btn-block" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password ?') }}
                        </a>
                    @endif --}}

                </div>
            </form>
        </div>
    </div>
</section>
<!--Content End-->

<script src="{{ asset('public/admin/assets/js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/script.js') }}"></script>
</body>
</html>