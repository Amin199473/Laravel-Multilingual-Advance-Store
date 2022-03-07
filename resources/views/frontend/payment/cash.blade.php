@extends('frontend.master')

@section('title')
    Cash On Delivery Page
@endsection


@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Checkout</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <div class="row">
                    <div class="col-md-6">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                    </div>
                                    <div class="row">
                                        <ul class="nav nav-checkout-progress list-unstyled">

                                            @foreach (Cart::content() as $item)
                                                <li>
                                                    <strong>Image:</strong>
                                                    <img src="{{ asset($item->options['image']) }}" style="height: 50px;width:50">
                                                </li>
                                                <li>
                                                    <strong>Qty:</strong>
                                                    <span style="padding-right: 8px">({{ $item->qty }})</span>

                                                    <strong>Color:</strong>
                                                    <span style="padding-right: 8px">{{ $item->options['color'] }}</span>

                                                    <strong>Size:</strong>
                                                    <span style="padding-right: 8px">{{ $item->options['size'] }}</span>

                                                    <strong>Price:</strong>
                                                    <span style="padding-right: 8px">{{ $item->price }}</span>
                                                </li>
                                                <li><Strong>SubTotal: </Strong>${{ $item->subtotal }}</li>
                                                <hr>
                                            @endforeach

                                            @if (Session::has('coupon'))
                                                <Strong>Total Cart: </Strong>${{ Cart::total() }}
                                                <hr>
                                                <strong>Coupon Name: </strong>{{ session()->get('coupon')['coupon_name'] }}
                                                <hr>
                                                <strong>Discount(%): </strong>{{ session()->get('coupon')['coupon_discount'] }}%
                                                <hr>
                                                <strong>Discount Amount: </strong>${{ session()->get('coupon')['discount_amount'] }}
                                                <hr>
                                                <strong>Total Amount: </strong>${{ session()->get('coupon')['total_amount'] }}
                                                <hr>
                                            @else
                                                <Strong>Total Amount: </Strong>${{ Cart::total() }}</Strong>
                                                <hr>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>

                    <div class="col-md-6">
                        <!-- Payment method -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">select payment method</h4>
                                    </div>
                                    <form action="{{ route('cash.order') }}" method="post" id="payment-form">
                                        @csrf
                                        @method('POST')
                                        <div class="form-row">
                                            <img src="{{ asset('frontend/assets/images/payments/cash.png') }}" alt="">
                                            <label for="card-element">
                                                <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                                <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                                <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                                <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                                <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                                                <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                                <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                                                <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                            </label>
                                        </div>
                                        <button  class="btn btn-primary" style="margin-top: 10px">Submit Payment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Payment method -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.checkout-box -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
