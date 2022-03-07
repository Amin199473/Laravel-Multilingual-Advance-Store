@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->

        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Order Details</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Order Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">

                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>shipping Details</strong></h4>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Shipping Name:</th>
                                <th>{{ $order->name }}</th>
                            </tr>

                            <tr>
                                <th>Shipping Email:</th>
                                <th>{{ $order->email }}</th>
                            </tr>

                            <tr>
                                <th>Shipping Phone:</th>
                                <th>{{ $order->phone }}</th>
                            </tr>

                            <tr>
                                <th>Shipping Division:</th>
                                <th>{{ $order->division['division_name'] }}</th>
                            </tr>

                            <tr>
                                <th>Shipping District:</th>
                                <th>{{ $order->district['district_name'] }}</< /th>
                            </tr>

                            <tr>
                                <th>Shipping State:</th>
                                <th>{{ $order->state['state_name'] }}</< /th>
                            </tr>


                            <tr>
                                <th>Post Code:</th>
                                <th>{{ $order->post_code }}</< /th>
                            </tr>


                            <tr>
                                <th>Order Date:</th>
                                <th>{{ $order->order_date }}</< /th>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">Order Details <span class="text-danger"> Invoice:</span></h4>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Payment Type:</th>
                                <th>{{ $order->payment_type }}</th>
                            </tr>

                            <tr>
                                <th>Total Amount:</th>
                                <th>${{ $order->amount }}</th>
                            </tr>

                            <tr>
                                <th>Invoice Number :</th>
                                <th class="text-danger">{{ $order->invoice_no }}</th>
                            </tr>

                            @if ($order->transaction_id)
                                <tr>
                                    <th>Transcation Id :</th>
                                    <th>{{ $order->transaction_id }}</th>
                                </tr>
                            @endif

                            <tr>
                                <th>Order :</th>
                                <th>
                                    <span class="badge badge-pill badge-primary" style="background: #418DB9">{{ $order->status }}</span>
                                </th>
                            </tr>

                            <tr>
                                <th></th>
                                <th>
                                    @if ($order->status == 'pending')
                                        <a href="{{ route('pending.to.confirmed', $order->id) }}" class="btn btn-block btn-success" id="confirm">Confirmed Order</a>
                                    @elseif($order->status == 'confirmed')
                                        <a href="{{ route('confirmed.to.processing', $order->id) }}" class="btn btn-block btn-success" id="processing">Processing Order</a>
                                    @elseif($order->status == 'processing')
                                        <a href="{{ route('processing.to.picked', $order->id) }}" class="btn btn-block btn-success" id="picked">Picked Order</a>
                                    @elseif($order->status == 'picked')
                                        <a href="{{ route('picked.to.shipped', $order->id) }}" class="btn btn-block btn-success" id="shipped">Shipped Order</a>
                                    @elseif($order->status == 'shipped')
                                        <a href="{{ route('shipped.to.delivered', $order->id) }}" class="btn btn-block btn-success" id="delivered">Delivered Order</a>
                                    @elseif($order->status == 'delivered')
                                        <a href="{{ route('delivered.to.canceled', $order->id) }}" class="btn btn-block btn-success" id="canceled">Cancel Order</a>
                                    @endif
                                </th>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">

                <div class="col-md-12 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>Order Items</strong></h4>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="col-md-2">
                                        <label for="">Image</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Product Name</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Product Code</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Color</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Size</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Quantity</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Price</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Subtotal</label>
                                    </td>
                                </tr>

                                @foreach ($orderItems as $item)
                                    <tr>
                                        <td class="col-md-2">
                                            <label for="">
                                                <img src="{{ asset($item->product->product_thumbnail) }}" alt="" style="height: 50px; width:50px;">
                                            </label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">{{ $item->product->product_name_en }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">{{ $item->product->product_code }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">{{ $item->color }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">{{ $item->size }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">{{ $item->qty }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">${{ $item->price }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">${{ $item->price * $item->qty }}</label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        //sweet alert for confirm
        $(function() {
            $(document).on('click', '#confirm', function(e) {
                e.preventDefault();
                let link = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure For Confirmed?',
                    text: "Once you confirmed you will not be to Pending again!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes,Confirmed it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;

                        Swal.fire(
                            'Confirm!',
                            'You Confirmed Changes',
                            'success'
                        )
                    }
                });
            });
        });


        //sweet alert for processing
        $(function() {
            $(document).on('click', '#processing', function(e) {
                e.preventDefault();
                let link = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure For Processing?',
                    text: "Once you Processing you will not be to Confirm again!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Processing it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;

                        Swal.fire(
                            'Processing!',
                            'You Processing Changes',
                            'success'
                        )
                    }
                });
            });
        });

        //sweet alert for picked
        $(function() {
            $(document).on('click', '#picked', function(e) {
                e.preventDefault();
                let link = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure For Picked?',
                    text: "Once you Picked you will not be to Processing again!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Picked it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;

                        Swal.fire(
                            'Picked!',
                            'You Picked Changes',
                            'success'
                        )
                    }
                });
            });
        });

        //sweet alert for shipped
        $(function() {
            $(document).on('click', '#shipped', function(e) {
                e.preventDefault();
                let link = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure For Shipped?',
                    text: "Once you Shipped you will not be to Picked again!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Shipped it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;

                        Swal.fire(
                            'Shipped!',
                            'You Shipped Changes',
                            'success'
                        )
                    }
                });
            });
        });

        //sweet alert for delivered
        $(function() {
            $(document).on('click', '#delivered', function(e) {
                e.preventDefault();
                let link = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure For delivered?',
                    text: "Once you delivered you will not be to Picked again!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delivered it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;

                        Swal.fire(
                            'delivered!',
                            'You delivered Changes',
                            'success'
                        )
                    }
                });
            });
        });

        //sweet alert for canceled
        $(function() {
            $(document).on('click', '#canceled', function(e) {
                e.preventDefault();
                let link = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure For Canceled?',
                    text: "Once you Canceled you will not be to Delivered again!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Canceled it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;

                        Swal.fire(
                            'Canceled!',
                            'You Canceled Changes',
                            'success'
                        )
                    }
                });
            });
        });
    </script>
@endsection
