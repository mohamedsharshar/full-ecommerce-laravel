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
                                <li class="current-list-item"><a href="/">الرئيسية</a>
                                    <ul class="sub-menu">
                                        <li><a href="index.html">الصفحة الرئيسية الثابتة</a></li>
                                        <li><a href="index_2.html">الصفحة الرئيسية المتحركة</a></li>
                                    </ul>
                                </li>
                                <li><a href="/products">المنتجات</a></li>
                                <li><a href="/categories">الفئات</a></li>
                                <li><a href="/products/create">اضافة منتج</a></li>
                                <li><a href="/reviews">اراء العملاء</a></li>
                                <li><a href="#">الصفحات</a>
                                    <ul class="sub-menu">
                                        <li><a href="404.html">404 الصفحة</a></li>
                                        <li><a href="/products">المنتجات</a></li>
                                        <li><a href="/categories">الفئات</a></li>
                                        <li><a href="cart.html">عربة التسوق</a></li>
                                        <li><a href="checkout.html">الدفع</a></li>
                                        <li><a href="contact.html">اتصل بنا</a></li>
                                        <li><a href="news.html">أخبار</a></li>
                                        <li><a href="shop.html">متجر</a></li>
                                    </ul>
                                </li>
                                <li><a href="news.html">أخبار</a>
                                    <ul class="sub-menu">
                                        <li><a href="news.html">أخبار</a></li>
                                        <li><a href="single-news.html">أخبار مفردة</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">اتصل بنا</a></li>
                                <li><a href="shop.html">متجر</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop.html">متجر</a></li>
                                        <li><a href="checkout.html">الدفع</a></li>
                                        <li><a href="single-product.html">منتج مفرد</a></li>
                                        <li><a href="cart.html">عربة التسوق</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="cart.html"><i
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
                                <p class="subtitle">تسوّق الآن واحصل على خصم 50%</p>
                                <h1>خصم خاص على الأدوات المدرسية</h1>
                                <div class="hero-btns">
                                    <a href="shop.html" class="boxed-btn">تسوق الان</a>
                                    <a href="contact.html" class="bordered-btn">تواصل معنا</a>
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
                                <p class="subtitle">أناقة لكل يوم</p>
                                <h1>أكبر تشكيلة من أوتلت الأزياء</h1>
                                <div class="hero-btns">
                                    <a href="shop.html" class="boxed-btn">تسوق الآن</a>
                                    <a href="contact.html" class="bordered-btn">تواصل معنا</a>
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
                                <p class="subtitle">توصيل مجاني لأول طلب</p>
                                <h1>براندات مصرية نفتخر بها</h1>
                                <div class="hero-btns">
                                    <a href="shop.html" class="boxed-btn">تسوق الآن</a>
                                    <a href="contact.html" class="bordered-btn">تواصل معنا</a>
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
                                <p class="subtitle">جهّز نفسك لأقوى العروض</p>
                                <h1>عروض رجوع المدارس</h1>
                                <div class="hero-btns">
                                    <a href="shop.html" class="boxed-btn">تسوق الآن</a>
                                    <a href="contact.html" class="bordered-btn">تواصل معنا</a>
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
                                <p class="subtitle">خصم حتى 35% + 10% إضافي مع الكوبون</p>
                                <h1>أسبوع الجمال</h1>
                                <div class="hero-btns">
                                    <a href="shop.html" class="boxed-btn">تسوق الآن</a>
                                    <a href="contact.html" class="bordered-btn">تواصل معنا</a>
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
                                <p class="subtitle">أسعار تبدأ من 199 جنيه</p>
                                <h1>برّد في عز الصيف</h1>
                                <div class="hero-btns">
                                    <a href="shop.html" class="boxed-btn">تسوق الآن</a>
                                    <a href="contact.html" class="bordered-btn">تواصل معنا</a>
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
                        <h2 class="widget-title">نبذة عنا</h2>
                        <p>نحن متجر متخصص في بيع الفواكه والخضروات الطازجة والعضوية.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">تواصل معنا</h2>
                        <ul>
                            <li>المنوفية, مصر , افريقيا </li>
                            <li>support@fruitkha.com</li>
                            <li>+20 100 383 1471</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box pages">
                        <h2 class="widget-title">الصفحات</h2>
                        <ul>
                            <li><a href="/">الرئيسية</a></li>
                            <li><a href="/about">نبذة عنا</a></li>
                            <li><a href="/services">المتجر</a></li>
                            <li><a href="/news">الأخبار</a></li>
                            <li><a href="/contact">تواصل معنا</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box subscribe">
                        <h2 class="widget-title">الاشتراك</h2>
                        <p>اشترك في قائمتنا البريدية للحصول على آخر التحديثات.</p>
                        <form action="index.html">
                            <input type="email" placeholder="البريد الإلكتروني">
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
                    <p>حقوق الطبع والنشر &copy; <?php echo date('Y'); ?> - <a
                            href="https://mohamedsharshar.netlify.app/">Mohamed SharShar</a>, جميع الحقوق محفوظة.<br>
                        تم التوزيع بواسطة - <a href="https://pure-soft.com/">PureSoft</a>
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
