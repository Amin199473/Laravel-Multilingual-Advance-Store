@extends('frontend.master')

@section('title')
    Stripe payment Page
@endsection
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

</style>

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
                                    <form action="{{ route('stripe.order') }}" method="post" id="payment-form">
                                        @csrf
                                        @method('POST')
                                        <div class="form-row">
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
                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>

                                            <!-- Used to display Element errors. -->
                                            <div id="card-errors" role="alert"></div>
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

    <script type="text/javascript">
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51KQo68G98zTkDP1OnKSrJattECUjA29ziFzbvYbDMow9RawCoBDknsYw1gehudhE5KgBQcFJzLTVQg6SHPeyRUl500U8iorZTK');
        // Create an instance of Elements.
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style
        });
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    </script>
@endsection
