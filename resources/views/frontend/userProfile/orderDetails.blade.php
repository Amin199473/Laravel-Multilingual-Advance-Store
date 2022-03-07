@extends('frontend.master')


@section('title')
    User Orders
@endsection

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <br>
                    <br>
                    <img class="card-img-top" style="border-radius: 50%" src="{{ !empty(Auth::user()->profile_photo_path)? asset('storage/' . Auth::user()->profile_photo_path): asset('upload/no_image.jpg') }}" height="100%" width="100%" alt="Avatar">
                    <br>
                    <br>
                    <ul class="list-group list-group-flush">
                        @include('frontend.partial.userPanel')
                    </ul>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipping Details</h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC">
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
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Details <span class="text-danger"> Invoice: {{ $order->invoice_no }}</span></h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC">
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

                            </table>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr style="background: #e2e2e2;">
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

                @if ( ($order->status == 'delivered' ) && ($order->return_reason == null) )
                    <form action="{{ route("return.order",$order->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="return_reason">Order Return Reason</label>
                                    <textarea class="form-control" name="return_reason" id="return_reason" cols="30" rows="5" placeholder="Order Returen Reason"></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>
                    <br>
                @else
                    <span class="badge badge-pill badge-danger" style="background-color: rgb(197, 26, 26);margin-bottom:10px"><h6>You already sent your Return Request for this order</h6></span>
                @endif
            </div>
        </div>
    </div>
@endsection
