<!DOCTYPE html>
<html lang="en">
@php
$seo = App\Models\Seo::find(1);
@endphp

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="{{ $seo->meta_description }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="{{ $seo->meta_author }}">
    <meta name="keywords" content="{{ $seo->meta_keyword }}">
    <meta name="robots" content="all">

    <title>
        @yield('title')
    </title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

    {{-- taoster cdn --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- stripe script -->
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->

    @include('frontend.body.header')

    <!-- ============================================== HEADER : END ============================================== -->

    @yield('content')

    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->

    @include('frontend.body.footer')
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- Add To cart Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="productName"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img id="productImage" class="card-img-top" src="" alt="Card image cap" style="height: 200px ; width:200px">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">Product Price:$<strong id="productPrice" class="text-danger"></strong> <br> $<del id="mainPrice"></del>
                                </li>
                                <li class="list-group-item">Product Code: <strong id="productCode"></strong></li>
                                <li class="list-group-item">Category: <strong id="productCategory"></strong></li>
                                <li class="list-group-item">Brand: <strong id="productBrand"></strong></li>
                                <li class="list-group-item">Stock:
                                    <span class="badge badge-pill badge-success" style="background-color: green" id="available"></span>
                                    <span class="badge badge-pill badge-danger" style="background-color: red" id="stockOut"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color">Choose Color</label>
                                <select class="form-control" id="color" name="color">

                                </select>
                            </div>

                            <div class="form-group" id="sizeArea">
                                <label for="size">Choose Size</label>
                                <select class="form-control" id="size" name="size">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" value="1" min="1">
                            </div>
                            <input type="hidden" name="productID" id="productID">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>

    {{-- sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- toaster --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
        @endif
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
            }
        });

        // start product view with Modal
        function productView(id) {
            $.ajax({
                type: "GET",
                url: "/product/view/modal/" + id,
                dataType: "json",
                success: function(data) {
                    if (data.product.discount_price == null) {
                        $('#productPrice').text('');
                        $('#mainPrice').text('');
                        $('#productPrice').text(data.product.selling_price);
                    } else {
                        $('#productPrice').text(data.product.discount_price);
                        $('#mainPrice').text(data.product.selling_price);
                    }

                    if (data.product.product_qty > 0) {
                        $('#available').text('');
                        $('#stockOut').text('');
                        $('#available').text('Available');
                    } else {
                        $('#available').text('');
                        $('#stockOut').text('');
                        $('#stockOut').text('Stockout');
                    }

                    $('#productName').text(data.product.product_name_en);
                    $('#productCode').text(data.product.product_code);
                    $('#productCategory').text(data.product.category.category_name_en);
                    $('#productBrand').text(data.product.brand.brand_name_en);
                    $('#productImage').attr('src', '/' + data.product.product_thumbnail);
                    $('#productID').val(id);
                    $('#quantity').val(1);

                    $('select[name = color]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append(
                            `<option value = ${value} > ${value} </option>`
                        );
                    });

                    $('select[name = size]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append(
                            `<option value = ${value} > ${value} </option>`
                        );
                    });

                    if (data.product.product_size_en == null) {
                        $('#sizeArea').hide();
                    } else {
                        $('#sizeArea').show();
                    }
                }
            });
        }

        //Add To Cart Product
        function addToCart() {
            let productName = $('#productName').text();
            let id = $('#productID').val();
            let color = $('#color option:selected').text();
            let size = $('#size option:selected').text();
            let quantity = $('#quantity').val();
            $.ajax({
                type: "POST",
                url: "/addToCart/store/" + id,
                dataType: "json",
                data: {
                    productName: productName,
                    color: color,
                    size: size,
                    quantity: quantity
                },
                success: function(data) {
                    miniCart();
                    $('#closeModal').click();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 5000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        });
                    }
                }
            });
        }
    </script>

    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: "GET",
                url: "/product/mini/cart/",
                dataType: "json",
                success: function(response) {
                    // console.log(response.carts);
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);
                    var miniCart = '';
                    $.each(response.carts, function(key, value) {
                        miniCart +=
                            `
                            <div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image"> <a href="detail.html"><img src="{{ asset('${value.options.image}') }}" alt=""></a> </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                            <div class="price">$${value.price}*${value.qty}</div>
                                        </div>
                                        <div class="col-xs-1 action">
                                            <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>
                        `
                    });
                    $('#miniCart').html(miniCart);
                }
            });
        }
        miniCart();

        //mini cart remove
        function miniCartRemove(rowId) {
            $.ajax({
                type: "GET",
                url: "/miniCart/product/remove/" + rowId,
                dataType: "json",
                success: function(data) {
                    miniCart();
                    CouponCalculation()
                    $('#item-' + rowId).remove();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        });
                    }
                    window.location.href = 'http://127.0.0.1:8000/myCart'
                }
            });
        }
    </script>

    <script>
        function addToWishlist(product_id) {
            $.ajax({
                type: "POST",
                url: "/addTo-Wishlist/" + product_id,
                dataType: "json",
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        });
                    }
                }
            });
        }

        function wishlistRemove(id) {
            $.ajax({
                type: "GET",
                url: "/wishlist-remove/" + id,
                dataType: "json",
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        });
                    }
                    $('#wishlist-' + id).remove()
                }
            });
        }
    </script>

    <script>
        function applyCoupon() {
            let coupon_name = $('#coupon_name').val();
            $.ajax({
                type: "POST",
                url: "{{ route('apply.coupon') }}",
                data: {
                    coupon_name: coupon_name
                },
                dataType: "json",
                success: function(data) {
                    CouponCalculation();
                    if (data.validity == true) {
                        $('#couponForm').hide();
                    }
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        });
                    }
                }
            });
        }

        function CouponCalculation() {
            $.ajax({
                type: "GET",
                url: "{{ route('coupon.calculation') }}",
                dataType: "json",
                success: function(data) {
                    if (data.total) {
                        $('#couponCalField').html(`
                            <tr>
                                <th>
                                    <div class="cart-grand-total">
                                        Total Amount<span class="inner-left-md text-danger">$${data.total}</span>
                                    </div>
                                </th>
                            </tr>
                        `);
                    } else {
                        $('#couponCalField').html(`

                            <tr>
                                <th>
                                    <div class="cart-grand-total">
                                        Cart Total<span class="inner-left-md text-danger">$${data.cart_total}</span>
                                    </div>
                                </th>
                            </tr>

                            <tr>
                                <th>
                                    <div class="cart-grand-total">
                                        <button type="submit" onClick="couponRemove()" style="color:red"><i class="fa fa-trash"></i></button>
                                        Coupon Name
                                        <span class="inner-left-md text-danger">
                                            ${data.coupon_name}
                                        </span>
                                    </div>
                                </th>
                            </tr>

                            <tr>
                                <th>
                                    <div class="cart-grand-total">
                                        Coupon Discount(%)<span class="inner-left-md text-danger">${data.coupon_discount}</span>
                                    </div>
                                </th>
                            </tr>

                            <tr>
                                <th>
                                    <div class="cart-grand-total">
                                        Discount Amount<span class="inner-left-md text-danger">$${data.discount_amount}</span>
                                    </div>
                                </th>
                            </tr>

                            <tr>
                                <th>
                                    <div class="cart-grand-total">
                                        Total Amount<span class="inner-left-md text-danger">$${data.total_amount}</span>
                                    </div>
                                </th>
                            </tr>
                        `);
                    }
                }
            });
        }
        CouponCalculation()
    </script>

    <script>
        function couponRemove() {
            $.ajax({
                type: "GET",
                url: "{{ route('coupon.remove') }}",
                dataType: "json",
                success: function(data) {
                    CouponCalculation();
                    $('#couponForm').show();
                    $('#coupon_name').val('');
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        });
                    }
                }
            });
        }
    </script>

    <script>
        const site_url = "http://127.0.0.1:8000/";

        $("body").on("keyup", "#search", function() {

            let text = $("#search").val();
            // console.log(text);

            if (text.length > 0) {

                $.ajax({
                    data: {
                        search: text
                    },
                    url: site_url + "advance/search/",
                    method: 'post',
                    beforSend: function(request) {
                        return request.setReuestHeader('X-CSRF-Token', ("meta[name='csrf-token']"))

                    },
                    success: function(result) {
                        $("#searchProducts").html(result);
                    }

                }); // end ajax

            } // end if

            if (text.length < 1) $("#searchProducts").html("");


        }); // end one
    </script>
</body>

</html>
