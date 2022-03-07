@extends('frontend.master')


@section('title')
    Posts
@endsection


@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Blog</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="blog-page">
                    <div class="col-md-9">
                        @foreach ($posts as $post)
                            <div class="blog-post  wow fadeInUp">
                                <a href="blog-details.html">
                                    <img class="img-responsive" src="{{ asset($post->image) }}" alt="">
                                </a>
                                <h1><a href="{{ route('post.detail',[$post->id,$post->post_slug_en]) }}">{{ session()->get('language') =='persian' ? $post->post_title_persian : $post->post_title_en }}</a></h1>
                                <span class="author">John Doe</span>
                                <span class="review">6 Comments</span>
                                <span class="date-time">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                                <p>
                                    {!! session()->get('language') =='persian' ? Str::limit($post->post_details_persian, 200 ,'...') : Str::limit( $post->post_details_en, 200, '...') !!}
                                </p>
                                <a href="{{ route('post.detail',[$post->id,$post->post_slug_en]) }}" class="btn btn-upper btn-primary read-more">read more</a>
                            </div>
                        @endforeach

                        <div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

                            <div class="text-right">
                                <div class="pagination-container">
                                    <ul class="list-inline list-unstyled">
                                    {{ $posts->links() }}
                                    </ul>
                                </div><!-- /.pagination-container -->
                            </div><!-- /.text-right -->

                        </div><!-- /.filters-container -->
                    </div>
                    <div class="col-md-3 sidebar">
                        <div class="sidebar-module-container">
                            <div class="search-area outer-bottom-small">
                                <form>
                                    <div class="control-group">
                                        <input placeholder="Type to search" class="search-field">
                                        <a href="#" class="search-button"></a>
                                    </div>
                                </form>
                            </div>

                            <div class="home-banner outer-top-n outer-bottom-xs">
                                <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                            </div>
                            <!-- ==============================================CATEGORY============================================== -->
                            <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                                <h3 class="section-title">Category</h3>
                                <div class="sidebar-widget-body m-t-10">
                                    <div class="accordion">

                                     <div class="list-group">
                                        @foreach($postCategories as $category )
                                            <a href="{{ route('category.post',$category->id) }}" class="list-group-item list-group-item-action">
                                                {{ session()->get('language') == 'persian' ? $category->postCategory_name_persian : $category->postCategory_name_en }}
                                            </a>
                                        @endforeach
                                        </div>
                                    </div><!-- /.accordion -->
                                </div><!-- /.sidebar-widget-body -->
                            </div><!-- /.sidebar-widget -->
                            <!-- ============================================== CATEGORY : END ============================================== -->
                            <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                                <h3 class="section-title">tab widget</h3>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#popular" data-toggle="tab">popular post</a></li>
                                    <li><a href="#recent" data-toggle="tab">recent post</a></li>
                                </ul>
                                <div class="tab-content" style="padding-left:0">
                                    <div class="tab-pane active m-t-20" id="popular">
                                        <div class="blog-post inner-bottom-30 ">
                                            <img class="img-responsive" src="assets/images/blog-post/blog_big_01.jpg" alt="">
                                            <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                            <span class="review">6 Comments</span>
                                            <span class="date-time">12/06/16</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                        </div>
                                        <div class="blog-post">
                                            <img class="img-responsive" src="assets/images/blog-post/blog_big_02.jpg" alt="">
                                            <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                            <span class="review">6 Comments</span>
                                            <span class="date-time">23/06/16</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                        </div>
                                    </div>

                                    <div class="tab-pane m-t-20" id="recent">
                                        <div class="blog-post inner-bottom-30">
                                            <img class="img-responsive" src="assets/images/blog-post/blog_big_03.jpg" alt="">
                                            <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                            <span class="review">6 Comments</span>
                                            <span class="date-time">5/06/16</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                        </div>
                                        <div class="blog-post">
                                            <img class="img-responsive" src="assets/images/blog-post/blog_big_01.jpg" alt="">
                                            <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                            <span class="review">6 Comments</span>
                                            <span class="date-time">10/07/16</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================== PRODUCT TAGS ============================================== -->
                            <div class="sidebar-widget product-tag wow fadeInUp">
                                <h3 class="section-title">Product tags</h3>
                                <div class="sidebar-widget-body outer-top-xs">
                                    <div class="tag-list">
                                        <a class="item" title="Phone" href="category.html">Phone</a>
                                        <a class="item active" title="Vest" href="category.html">Vest</a>
                                        <a class="item" title="Smartphone" href="category.html">Smartphone</a>
                                        <a class="item" title="Furniture" href="category.html">Furniture</a>
                                        <a class="item" title="T-shirt" href="category.html">T-shirt</a>
                                        <a class="item" title="Sweatpants" href="category.html">Sweatpants</a>
                                        <a class="item" title="Sneaker" href="category.html">Sneaker</a>
                                        <a class="item" title="Toys" href="category.html">Toys</a>
                                        <a class="item" title="Rose" href="category.html">Rose</a>
                                    </div><!-- /.tag-list -->
                                </div><!-- /.sidebar-widget-body -->
                            </div><!-- /.sidebar-widget -->
                            <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
    </div>
@endsection
