@php
$routeName = Route::current()->getName();
$routeSegment = request()->segment(2);
@endphp
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>Admin</b> Shop</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $routeName === 'admin.dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ $routeSegment === 'brand' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Brands</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ $routeName === 'brand.index' ? 'active' : '' }}"><a href="{{ route('brand.index') }}"><i class="ti-more"></i>All Brand</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'category' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="mail"></i><span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'category.index' ? 'active' : '' }}"><a href="{{ route('category.index') }}"><i class="ti-more"></i>All Category</a></li>
                    <li class="{{ $routeName === 'subcategory.index' ? 'active' : '' }}"><a href="{{ route('subcategory.index') }}"><i class="ti-more"></i>All SubCategory</a></li>
                    <li class="{{ $routeName === 'subsubcategory.index' ? 'active' : '' }}"><a href="{{ route('subsubcategory.index') }}"><i class="ti-more"></i>All Sub->SubCategory</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'product' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'product.create' ? 'active' : '' }}"><a href="{{ route('product.create') }}"><i class="ti-more"></i>Add Product</a></li>
                    <li class="{{ $routeName === 'product.index' ? 'active' : '' }}"><a href="{{ route('product.index') }}"><i class="ti-more"></i>Management Products</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'slider' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Slider</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'slider.index' ? 'active' : '' }}"><a href="{{ route('slider.index') }}"><i class="ti-more"></i>Management Sliders</a></li>
                    <li class="{{ $routeName === 'slider.create' ? 'active' : '' }}"><a href="{{ route('slider.index') }}"><i class="ti-more"></i>Add Slider</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'coupon' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Coupons</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'coupon.index' ? 'active' : '' }}"><a href="{{ route('coupon.index') }}"><i class="ti-more"></i>Management Cpupon</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'shipping' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Shipping Area</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'manageDivision.index' ? 'active' : '' }}"><a href="{{ route('manageDivision.index') }}"><i class="ti-more"></i>Ship Division</a></li>
                    <li class="{{ $routeName === 'manageDistrict.index' ? 'active' : '' }}"><a href="{{ route('manageDistrict.index') }}"><i class="ti-more"></i>Ship District</a></li>
                    <li class="{{ $routeName === 'manageState.index' ? 'active' : '' }}"><a href="{{ route('manageState.index') }}"><i class="ti-more"></i>Ship District</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'blog' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Manage Blog</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'postCategory.index' ? 'active' : '' }}"><a href="{{ route('postCategory.index') }}"><i class="ti-more"></i>Blog Category</a></li>
                    <li class="{{ $routeName === 'post.index' ? 'active' : '' }}"><a href="{{ route('post.index') }}"><i class="ti-more"></i>Posts</a></li>
                    <li class="{{ $routeName === 'post.create' ? 'active' : '' }}"><a href="{{ route('post.create') }}"><i class="ti-more"></i>Add New Post</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'setting' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Site Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'site.setting' ? 'active' : '' }}"><a href="{{ route('site.setting') }}"><i class="ti-more"></i>Site Setting</a></li>
                    <li class="{{ $routeName === 'seo.setting' ? 'active' : '' }}"><a href="{{ route('seo.setting') }}"><i class="ti-more"></i>Seo Setting</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'return' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Returned orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'admin.return.order' ? 'active' : '' }}"><a href="{{ route('admin.return.order') }}"><i class="ti-more"></i>Return Request</a></li>
                    <li class="{{ $routeName === 'return.all.orders' ? 'active' : '' }}"><a href="{{ route('return.all.orders') }}"><i class="ti-more"></i>All Return Request</a></li>
                </ul>
            </li>


            <li class="treeview {{ $routeSegment === 'stock' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Manage Stock</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'product.stock' ? 'active' : '' }}"><a href="{{ route('product.stock') }}"><i class="ti-more"></i>Product Stock</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'review' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Product review</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'pending.approve' ? 'active' : '' }}"><a href="{{ route('pending.approve') }}"><i class="ti-more"></i>Pending Review</a></li>
                    <li class="{{ $routeName === 'approved.reviews' ? 'active' : '' }}"><a href="{{ route('approved.reviews') }}"><i class="ti-more"></i>All Approved Review</a></li>
                </ul>
            </li>


            <li class="header nav-small-cap">User Interface</li>

            <li class="treeview {{ $routeSegment === 'orders' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'pendingOrders' ? 'active' : '' }}"><a href="{{ route('pendingOrders') }}"><i class="ti-more"></i>Pending Orders</a></li>
                    <li class="{{ $routeName === 'confirmedOrders' ? 'active' : '' }}"><a href="{{ route('confirmedOrders') }}"><i class="ti-more"></i>Confirmed Orders</a></li>
                    <li class="{{ $routeName === 'processingOrders' ? 'active' : '' }}"><a href="{{ route('processingOrders') }}"><i class="ti-more"></i>Processing Orders</a></li>
                    <li class="{{ $routeName === 'pickedOrders' ? 'active' : '' }}"><a href="{{ route('pickedOrders') }}"><i class="ti-more"></i>Picked Orders</a></li>
                    <li class="{{ $routeName === 'shippedOrders' ? 'active' : '' }}"><a href="{{ route('shippedOrders') }}"><i class="ti-more"></i>Shipped Orders</a></li>
                    <li class="{{ $routeName === 'deliveredOrders' ? 'active' : '' }}"><a href="{{ route('deliveredOrders') }}"><i class="ti-more"></i>Delivered Orders</a></li>
                    <li class="{{ $routeName === 'canceledOrders' ? 'active' : '' }}"><a href="{{ route('canceledOrders') }}"><i class="ti-more"></i>Canceled Orders</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'reports' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'report.view' ? 'active' : '' }}"><a href="{{ route('report.view') }}"><i class="ti-more"></i>All Reports</a></li>
                </ul>
            </li>

            <li class="treeview {{ $routeSegment === 'useres' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $routeName === 'all.users' ? 'active' : '' }}"><a href="{{ route('all.users') }}"><i class="ti-more"></i>All Users</a></li>
                </ul>
            </li>
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
