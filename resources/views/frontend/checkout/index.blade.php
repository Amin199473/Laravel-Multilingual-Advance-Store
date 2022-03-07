@extends('frontend.master')

@section('title')
    Checkout Page
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
                {{-- start form --}}
                <form action="{{ route('checkout.store') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel-group checkout-steps" id="accordion">
                                <!-- checkout-step-01  -->
                                <div class="panel panel-default checkout-step-01">
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <!-- panel-body  -->
                                        <div class="panel-body">
                                            <h4 class="checkout-subtitle" style="padding-bottom: 20px"><b>Shipping Address</b></h4>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 already-registered-login">
                                                    <div class="form-group">
                                                        <label class="info-title" for="shipping_name"><b>Name</b>
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control unicase-form-control text-input" id="shipping_name" name="shipping_name" value="{{ Auth::user()->name }}" placeholder="name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="shipping_name"><b>Email Address</b>
                                                            <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control unicase-form-control text-input" id="shipping_email" name="shipping_email" value="{{ Auth::user()->email }}" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="shipping_phone"><b>Phone</b>
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control unicase-form-control text-input" id="shipping_phone" name="shipping_phone" value="{{ Auth::user()->phone }}" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="post_code"><b>Phone</b>
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control unicase-form-control text-input" id="post_code" name="post_code" placeholder="Post Code">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-6 already-registered-login">
                                                    <div class="form-group">
                                                        <h5><b>Divisions</b> <span class="text-danger">*</span></h5>
                                                        <select name="division_id" id="division_id" class="form-control" aria-invalid="false">
                                                            <option value="">Select Division</option>
                                                            @foreach ($divisions as $division)
                                                                <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('division_id')
                                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <h5><b>Districts</b> <span class="text-danger">*</span></h5>
                                                        <select name="district_id" id="district_id" class="form-control" aria-invalid="false">
                                                            <option value="">Select District</option>

                                                        </select>
                                                        @error('district_id')
                                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <h5><b>State</b> <span class="text-danger">*</span></h5>
                                                        <select name="state_id" id="state_id" class="form-control" aria-invalid="false">
                                                            <option value="">Select District</option>

                                                        </select>
                                                        @error('state_id')
                                                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="info-title" for="notes"><b>Notes</b>
                                                            <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="notes" id="notes" cols="30" rows="5" placeholder="notes"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- panel-body  -->

                                    </div><!-- row -->
                                </div>
                                <!-- checkout-step-01  -->
                            </div><!-- /.checkout-steps -->
                        </div>
                        <div class="col-md-4">
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

                            <!-- Payment method -->
                            <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="unicase-checkout-title">select payment method</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="stripe">Stripe</label>
                                                <input type="radio" id="stripe" name="payment_method" value="stripe">
                                                <img src="{{ asset('frontend/assets/images/payments/4.png') }}" alt="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="card">Card</label>
                                                <input type="radio" id="card" name="payment_method" value="card">
                                                <img src="{{ asset('frontend/assets/images/payments/3.png') }}" alt="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="cash">Cash</label>
                                                <input type="radio" id="cash" name="payment_method" value="cash">
                                                <img src="{{ asset('frontend/assets/images/payments/6.png') }}" alt="">
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>

                                    </div>
                                </div>
                            </div>
                            <!-- Payment method -->

                        </div>
                    </div><!-- /.row -->
                </form>
                {{-- end form --}}
            </div><!-- /.checkout-box -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.districts') }}",
                        data: {
                            "division_id": division_id
                        },
                        dataType: "json",
                        success: function(response) {
                            var clear = $('select[name="district_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value.district_name + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    alert('danger');
                }
            });
        });

        $(document).ready(function() {
            $('select[name="district_id"]').on('click', function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.states') }}",
                        data: {
                            "district_id": district_id
                        },
                        dataType: "json",
                        success: function(response) {
                            var clear = $('select[name="state_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="state_id"]').append(
                                    '<option value="' + value.id + '">' + value.state_name + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
