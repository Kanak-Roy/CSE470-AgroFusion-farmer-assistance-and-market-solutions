<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agro Fusion</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p> Empowering Farmers, Connecting Markets</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            
                            <div class="header__top__links">
                                <a href="{{ URL:: to('profile')}}">My Profile</a>
                                
                            </div>
                            <div class="header__top__links">
                             @if(session()->has('id'))
                            <a href="{{ URL:: to('/logout')}}">Logout</a>
                            @else

                            <a href="{{ URL:: to('/login')}}">Login</a>
                            <a href="{{ URL:: to('/register')}}">Register</a>
                            @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="{{ URL::asset('img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{ URL:: to('/') }}">Home</a></li>
                            <li><a href="{{ URL:: to('/shop')}}">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    {{--<li><a href="./about.html">About Us</a></li>
                                    <li><a href="./shop-details.html">Shop Details</a></li>--}}
                                    <li><a href="{{ URL:: to('/cart')}}">Shopping Cart</a></li>
                                    <li><a href="{{ URL:: to('/checkout')}}">Check Out</a></li>
                                    <li><a href="{{ URL:: to('/myOrders')}}">My Orders</a></li>
                                    
                                </ul>
                            </li>
                           {{-- @if(session()->has('id'))
                            <li><a href="{{ URL:: to('/logout')}}">Logout</a></li>
                            @else

                            <li><a href="{{ URL:: to('/login')}}">Login</a></li>
                            <li><a href="{{ URL:: to('/register')}}">Register</a></li>
                            @endif--}}
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="{{ URL::asset('img/icon/search.png') }}" alt=""></a>
                        
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->