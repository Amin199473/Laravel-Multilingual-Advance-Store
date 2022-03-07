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
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr style="background: #e2e2e2;">
                                    <td class="col-md-2">
                                        <label for="">Date</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Total</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Payment</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Invoice</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Order</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Action</label>
                                    </td>
                                </tr>

                                @forelse($orders as $order)
                                    <tr>
                                        <td class="col-md-2">
                                            <label for="">{{ $order->order_date }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">${{ $order->amount }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">{{ $order->payment_method }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">{{ $order->invoice_no }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">
                                                @if ($order->status == 'pending')
                                                    <span class="badge badge-pill badge-warning" style="background: #800080;"> Pending </span>
                                                @elseif($order->status == 'confirm')
                                                    <span class="badge badge-pill badge-warning" style="background: #0000FF;"> Confirm </span>
                                                @elseif($order->status == 'processing')
                                                    <span class="badge badge-pill badge-warning" style="background: #FFA500;"> Processing </span>
                                                @elseif($order->status == 'picked')
                                                    <span class="badge badge-pill badge-warning" style="background: #808000;"> Picked </span>
                                                @elseif($order->status == 'shipped')
                                                    <span class="badge badge-pill badge-warning" style="background: #808080;"> Shipped </span>
                                                @elseif($order->status == 'delivered')
                                                    <span class="badge badge-pill badge-warning" style="background: #008000;"> Delivered </span>

                                                    @if ($order->return_order == 1)
                                                        <span class="badge badge-pill badge-warning" style="background:red;">Return Requested </span>
                                                    @endif

                                                @else
                                                    <span class="badge badge-pill badge-warning" style="background: #FF0000;"> Cancel </span>
                                                @endif
                                            </label>
                                        </td>

                                        <td class="col-md-2">
                                            <a href="{{ route('my.order.details', $order->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>View</a>
                                            <a href="{{ route('user.invoice.download', $order->id) }}" class="btn btn-sm btn-danger" target="_blank" style="margin-top: 5px"><i class="fa fa-download" aria-hidden="true"
                                                   style="color: white"></i>Inovice</a>
                                        </td>
                                    </tr>
                                @empty
                                    <h2 class="text-danger">order Not Found</h2>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
