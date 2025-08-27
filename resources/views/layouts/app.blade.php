<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @livewireStyles
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Fruitkha</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/addproduct.css') }}">

    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/language.css') }}">

</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="/">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu" dir="rtl">
                            <ul>
                                <li class="current-list-item"><a href="/">{{ __('messages.home') }}</a>

                                </li>
                                <li><a href="/products">{{ __('messages.products') }}</a></li>
                                <li><a href="/categories">{{ __('messages.categories') }}</a></li>
                                {{-- <li><a href="/products/create">اضافة منتج</a></li> --}}
                                <li><a href="/reviews">{{ __('messages.reviews') }}</a></li>
                                {{-- <li><a href="{{ route('coupons.index') }}">الكوبونات</a></li> --}}
                                <li><a href="/about">{{ __('messages.about') }}</a></li>
                                <li><a href="#">{{ __('messages.pages') }}</a>
                                    <ul class="sub-menu">
                                        <li><a href="/products">{{ __('messages.products') }}</a></li>
                                        <li><a href="/categories">{{ __('messages.categories') }}</a></li>
                                        <li><a href="/cart">{{ __('messages.cart') }}</a></li>
                                        <li><a href="/checkout">{{ __('messages.checkout') }}</a></li>
                                        <li><a href="{{ route('contact.show', app()->getLocale()) }}">{{ __('messages.contact') }}</a></li>
                                    </ul>
                                </li>


                                {{-- <li><a href="{{ route('products.trashed') }}">المنتجات المحذوفة</a></li> --}}
                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">{{ __('messages.register') }}</a></li>
                                    @endif
                                @else
                                    <li>
                                        <a href="#">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="{{route('profile.show')}}">{{ __('messages.profile') }}</a></li>
                                            @if (auth()->user()->hasRole('admin'))
                                                <li><a
                                                        href="{{ route('products.trashed') }}">{{ __('messages.trashed_products') }}</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    {{ __('messages.logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endguest
                                {{-- <li><a href="contact.html">{{__('messages.contact')}}</a></li> --}}

                                <li>
                                    <div class="header-icons">
                                        <div class="language-switcher">
                                            <a href="{{ route('locale.switch', 'ar') }}" class="lang-btn">ع</a>
                                            <a href="{{ route('locale.switch', 'en') }}" class="lang-btn">EN</a>
                                        </div>

                                        <a class="shopping-cart" href="{{ route('cart.index') }}"><i
                                                class="fas fa-shopping-cart"></i></a>
                                        <a class="mobile-hide search-bar-icon" href="#"><i
                                                class="fas fa-search"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>

                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            @livewire('product-search')
                        </div>
                        @livewireScripts
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search area -->

    <!-- home page slider -->
    <div class="homepage-slider">
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{__('messages.shop_now_get_discount')}}</p>
                                <h1>{{__('messages.special_discount_on_school_supplies')}}</h1>
                                <div class="hero-btns">
                                    <a href="/products" class="boxed-btn">{{__('messages.shop_now')}}</a>
                                    <a href="{{ route('contact.show', app()->getLocale()) }}" class="bordered-btn">{{__('messages.contact_us')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{__('messages.everyday_elegance')}}</p>
                                <h1>{{__('messages.largest_collection')}}</h1>
                                <div class="hero-btns">
                                    <a href="/products" class="boxed-btn">{{__('messages.shop_now')}}</a>
                                    <a href="/contact" class="bordered-btn">{{__('messages.contact_us')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-right">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{__('messages.free_shipping_on_first_order')}}</p>
                                <h1>{{__('messages.proudly_egyptian_brands')}}</h1>
                                <div class="hero-btns">
                                    <a href="/products" class="boxed-btn">{{__('messages.shop_now')}}</a>
                                    <a href="/contact" class="bordered-btn">{{__('messages.contact_us')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-left">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{__('messages.get_ready_for_the_best_offers')}}</p>
                                <h1>{{__('messages.back_to_school_offers')}}</h1>
                                <div class="hero-btns">
                                    <a href="/products" class="boxed-btn">{{__('messages.shop_now')}}</a>
                                    <a href="/contact" class="bordered-btn">{{__('messages.contact_us')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{__('messages.school_supplies_discount')}}</p>
                                <h1>{{__('messages.beauty_week')}}</h1>
                                <div class="hero-btns">
                                    <a href="/products" class="boxed-btn">{{__('messages.shop_now')}}</a>
                                    <a href="/contact" class="bordered-btn">{{__('messages.contact_us')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-right">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{__('messages.from_199_egp')}}</p>
                                <h1>{{__('messages.cool_in_the_summer')}}</h1>
                                <div class="hero-btns">
                                    <a href="/products" class="boxed-btn">{{__('messages.shop_now')}}</a>
                                    <a href="/contact" class="bordered-btn">{{__('messages.contact_us')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end home page slider -->

    @yield('content')

    <!-- footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">{{__('messages.about_us')}}</h2>
                        <p>{{__('messages.about_us_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">{{__('messages.get_in_touch')}}</h2>
                        <ul>
                            <li>{{__('messages.Menoufia')}}, {{__('messages.Egypt')}}, {{__('messages.Africa')}}</li>
                            <li>support@fruitkha.com</li>
                            <li>+20 100 383 1471</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box pages">
                        <h2 class="widget-title">{{__('messages.pages')}}</h2>
                        <ul>
                            <li><a href="/">{{__('messages.home')}}</a></li>
                            <li><a href="/about">{{__('messages.about_us')}}</a></li>
                            <li><a href="/services">{{__('messages.products')}}</a></li>
                            <li><a href="/news">{{__('messages.news')}}</a></li>
                            <li><a href="{{ route('contact.show', app()->getLocale()) }}">{{__('messages.contact_us')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box subscribe">
                        <h2 class="widget-title">{{__('messages.subscribe')}}</h2>
                        <p>{{__('messages.subscribe_description')}}</p>
                        <form action="index.html">
                            <input type="email" placeholder="{{__('messages.email_placeholder')}}">
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end footer -->

    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>{{__('messages.copyright_notice')}} &copy; <?php echo date('Y'); ?> - <a
                            href="https://mohamedsharshar.netlify.app/">Mohamed SharShar</a>, {{__('messages.copyright')}}.<br>
                        {{__('messages.distributed_by')}} - <a href="https://pure-soft.com/">PureSoft</a>
                    </p>
                </div>
                <div class="col-lg-6 text-right col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->

    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min..js"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- count down -->
    <script src="{{ asset('assets/js/jquery.countdown.js') }}"></script>
    <!-- isotope -->
    <script src="{{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
    <!-- waypoints -->
    <script src="{{ asset('assets/js/waypoints.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- mean menu -->
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <!-- sticker js -->
    <script src="{{ asset('assets/js/sticker.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
