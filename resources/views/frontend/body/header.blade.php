<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('dashboard') }}"><i class="icon fa fa-user"></i>{{ session()->get('language') == 'persian' ? 'حساب من' : 'My Account' }}</a></li>
                        <li><a href="{{ route('mywishlist.products') }}"><i class="icon fa fa-heart"></i>{{ session()->get('language') == 'persian' ? 'لیست علاقه مندی ها' : 'Wishlist' }}</a></li>
                        <li><a href="{{ route('myCart') }}"><i class="icon fa fa-shopping-cart"></i>{{ session()->get('language') == 'persian' ? 'سبد خرید من' : 'My Cart' }}</a></li>
                        <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>{{ session()->get('language') == 'persian' ? 'تسویه حساب' : 'Checkout' }}</a></li>
                        <li><a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderTracking"><i class="icon fa fa-check"></i>{{ session()->get('language') == 'persian' ? 'رهگیری سفارش' : 'Order Tracking' }}</a>
                        </li>
                        @auth
                            <li><a href="{{ route('login') }}"><i class="icon fa fa-user"></i>{{ session()->get('language') == 'persian' ? 'پروفایل کاربر' : 'User Profile' }}</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>{{ session()->get('language') == 'persian' ? 'ورود/ثبت نام' : 'Login/Register' }}</a></li>
                        @endauth

                    </ul>
                </div>
                <!-- /.cnt-account -->

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">
                                    @if (session()->get('language') == 'persian')
                                        زبان
                                    @else
                                        Language
                                    @endif
                                </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if (session()->get('language') == 'persian')
                                    <li><a href="{{ route('english.language') }}">English</a></li>
                                @else
                                    <li><a href="{{ route('persian.language') }}">فارسی</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    <!-- /.list-unstyled -->
                </div>
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    @php
                        $setting = App\Models\SiteSetting::find(1);
                    @endphp
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"> <a href="{{ url('/') }}"> <img src="{{ asset($setting->logo) }}" alt="logo"> </a> </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form method="POST" action="{{ route('product.search') }}">
                            @csrf
                            @method('POST')
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="menu-header">Computer</li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <input class="search-field" onfocus="search_result_show()" onblur="search_result_hide()" id="search" name="search" placeholder="Search here..." />
                                <button class="search-button" type="submit"></button>
                            </div>
                        </form>
                        <div id="searchProducts"></div>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count" id="cartQty"></span></div>
                                <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price"> <span class="sign">$</span><span class="value" id="cartSubTotal"></span> </span> </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div id="miniCart">

                                </div>
                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Sub Total :</span><span class='price' id="cartSubTotal"></span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                </div>
                                <!-- /.cart-total-->
                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ url('/') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ session()->get('language') == 'persian' ? 'حانه' : 'Home' }}</a> </li>

                                @php
                                    $categories = App\models\category::orderBy('category_name_en', 'ASC')->get();
                                @endphp

                                @foreach ($categories as $category)
                                    <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle"
                                           data-toggle="dropdown">{{ session()->get('language') == 'persian' ? $category->category_name_persian : $category->category_name_en }}</a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content ">
                                                    <div class="row">
                                                        @php
                                                            $subcategories = App\models\SubCategory::where('category_id', $category->id)
                                                                ->orderBy('subcategory_name_en', 'ASC')
                                                                ->get();
                                                        @endphp

                                                        @foreach ($subcategories as $sub_cat)
                                                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                                <a href="{{ route('subcategory.products', [$sub_cat->id, $sub_cat->subcategory_slug_en]) }}">
                                                                    <h2 class="title">{{ session()->get('language') == 'persian' ? $sub_cat->subcategory_name_persian : $sub_cat->subcategory_name_en }}</h2>
                                                                </a>
                                                                <ul class="links">
                                                                    @php
                                                                        $subsubcategories = App\models\SubSubCategory::where('subcategory_id', $sub_cat->id)
                                                                            ->orderBy('subsubcategory_name_en', 'ASC')
                                                                            ->get();
                                                                    @endphp

                                                                    @foreach ($subsubcategories as $sub_sub_cat)
                                                                        <li><a
                                                                               href="{{ route('subsubcategory.products', [$sub_sub_cat->id, $sub_sub_cat->subsubcategory_slug_en]) }}">{{ session()->get('language') == 'persian'? $sub_sub_cat->subsubcategory_name_persian: $sub_sub_cat->subsubcategory_name_en }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                        <!-- /.col -->
                                                        <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/top-menu-banner.jpg') }}" alt=""> </div>
                                                        <!-- /.yamm-content -->
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                @endforeach
                                <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                                <li class="dropdown  navbar-right special-menu"> <a href="{{ route('home.posts') }}">Blog</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->


    <!-- Modal -->
    <div class="modal fade" id="orderTracking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Track your order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('order.tracking') }}" method="POST">
                        @csrf
                        @method('POST')
                        <label for="code">Invoice Code</label>
                        <input type="text" name="code" id="" class="form-control" placeholder="Track Your Order" required>
                        <br>
                        <button type="submit" class="btn btn-danger mt-2">Track</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</header>



<script>
    function search_result_hide() {
        $('#searchProducts').slideUp();
    }

    function search_result_show() {
        $('#searchProducts').slideDown();
    }
</script>
