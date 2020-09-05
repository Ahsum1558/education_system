<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coaching | Home</title>
    <!--    Font Awesome Stylesheet-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/fonts/fa/css/all.min.css') }}">
    <!--    Animate CSS-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/animate.css') }}">
    <!--    Owl Carosel Stylesheets-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/owl-carosel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/owl-carosel/css/owl.theme.default.css') }}">
    <!--    Magnetic Popup-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/magnific-popup/css/magnific-popup.css') }}">
    <!--    Bootstrap-4.3 Stylesheet-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/sub-dropdown.css') }}">
    <!--    Data Table CSS-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/data-table/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/data-table/css/fixedHeader.bootstrap4.min.css') }}">
    <!--    Theme Stylesheet-->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/style.css') }}">
    <!--    jQuery-->
    <script src="{{ asset('public/admin/assets/js/jquery-3.5.1.min.js') }}"></script>
    <!--    Favicon-->
    <link rel="shortcut icon" href="{{ asset('public/admin/assets/images/favicon.png') }}" type="image/x-icon">
</head>
<body>
<!--Header Start-->
<section>
    @if(isset($header))
    <div class="col-sm-12 text-center header pb-1">
        <h2 class="font-weight-bold p-1 m-0">{{ $header->owner_name }}</h2>
        <h5 class="menu-bg p-2 pl-3 pr-3 mb-1">{{ $header->owner_department }}</h5>
        <p class="font-weight-bold mb-0">{{ $header->address }}</p>
        <p class="font-weight-bold mb-0">{{ $header->mobile }}</p>
    </div>
    @else
    <div class="col-sm-12 text-center header pb-1">
        <h2 class="font-weight-bold p-1 m-0">Web Site Title</h2>
        <h5 class="menu-bg p-2 pl-3 pr-3 mb-1">Web Sub Title</h5>
        <p class="font-weight-bold mb-0">Muhsinia Para, PM Khali-4700, Cox's Bazar</p>
        <p class="font-weight-bold mb-0">Mobile: +880-1815-141595</p>
    </div>
    @endif
</section>
<!--Header End-->

<!--User Avatar Start-->
<a href="{{ route('home') }}"><img class="avatar" src="@if(Auth::user()->avatar){{ asset('/').'/'.$user->avatar }}@else{{ asset('public/admin/assets/images/favicon.png') }}@endif" alt="Avatar"></a>
<!--User Avatar Start-->

@include('admin.includes.menu')