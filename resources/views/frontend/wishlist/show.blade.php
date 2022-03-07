@extends('frontend.master')


@section('title')
   My Wishlist
@endsection


@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Wishlist</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">My Wishlist</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlists as $wishlist)
                                <tr id="wishlist-{{ $wishlist->id }}">
                                    <td class="col-md-2"><img src="{{ asset($wishlist->product['product_thumbnail']) }}" alt="imga"></td>
                                    <td class="col-md-7">
                                        <div class="product-name"><a href="{{ route('product.details', [$wishlist->product['product_slug_en'] , $wishlist->product['id']]) }}">{{ session()->get('language') == 'persian' ? $wishlist->product['product_name_persian'] : $wishlist->product['product_name_en'] }}</a></div>
                                        <div class="rating">
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star non-rate"></i>
                                            <span class="review">( 06 Reviews )</span>
                                        </div>
                                        <div class="price">
                                            ${{ $wishlist->product['discount_price']? $wishlist->product['discount_price'] : $wishlist->product['selling_price']}}
                                            @if($wishlist->product['discount_price'])
                                            <span>${{ $wishlist->product['selling_price'] }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#exampleModal" title="add to cart" id="{{ $wishlist->product['id'] }}" onclick="productView(this.id)">Add to cart</button>
                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <button class="" id="{{ $wishlist->id}}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
