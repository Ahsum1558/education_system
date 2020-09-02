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

<!--Main Menu Start-->
<nav class="navbar navbar-expand-lg menu-bg">
    <!--    <a class="navbar-brand" href="#">LOGO</a>-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="mobile-menu-icon fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Student
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class=""><a class="dropdown-item" href="form.html">Registration</a></li>
                    <li class=""><a class="dropdown-item" href="table.html">Batch Wise List</a></li>
                    <li class=""><a class="dropdown-item" href="#">Class Wise List</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('photo-gallery') }}">Gallery</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Setting
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">School</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('add-school') }}" class="dropdown-item">Add School</a></li>
                            <li><a href="{{ route('school-list') }}" class="dropdown-item">School List</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Class</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('add-class') }}" class="dropdown-item">Add Class</a></li>
                            <li><a href="{{ route('class-list') }}" class="dropdown-item">Class List</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Batch</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('add-batch') }}" class="dropdown-item">Add Batch</a></li>
                            <li><a href="{{ route('batch-list') }}" class="dropdown-item">Batch List</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Slider</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('add-slide') }}" class="dropdown-item">Add Slide</a></li>
                            <li><a href="{{ route('manage-slide') }}" class="dropdown-item">Manage Slide</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">General</a>
                        <ul class="dropdown-menu">
                            @if(!isset($header))
                            <li><a href="{{ route('add-header-footer') }}" class="dropdown-item">Add Header & Footer</a></li>
                            @endif
                            @if(isset($header))
                            <li><a href="{{ route('manage-header-footer', ['id'=>$header->id]) }}" class="dropdown-item">Manage Header & Footer</a></li>
                            @endif
                        </ul>
                    </li>

                     <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">User</a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->role == 'Admin')
                            <li><a href="{{ route('user-registration') }}" class="dropdown-item">Add User</a></li>
                            <li><a href="{{ route('user-list') }}" class="dropdown-item">User List</a></li>
                            @endif
                            <li><a href="{{ route('user-profile', ['userId' => Auth::user()->id]) }}" class="dropdown-item">User Profile</a></li>
                        </ul>
                    </li>

                </ul>
            </li>
        </ul>

        <a class="font-weight-bold my-2 my-sm-0 mr-2 logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>



        {{-- <a class="font-weight-bold my-2 my-sm-0 mr-2 logout" href="#">Logout</a> --}}

        <!--        <form class="form-inline my-2 my-lg-0">-->
        <!--            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
        <!--            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
        <!--        </form>-->
    </div>
</nav>
<!--Main Menu End-->
