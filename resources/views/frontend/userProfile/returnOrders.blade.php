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
                    <img class="card-img-top" style="border-radius: 50%" src="{{ !empty(Auth::user()->profile_photo_path)? asset('storage/' . Auth::user()->profile_photo_path): asset('upload/no_image.jpg') }}" height="100%" width="100%"
                         alt="Avatar">
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
                                        <label for="">Return Reason</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Order Status</label>
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
                                        <label for="">{{ $order->return_reason }}</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">
                                            @if($order->return_order == 1)
                                                <span class="badge badge-pill badge-primary" style="background: #3b1113">Pending Request</span>
                                                <span class="badge badge-pill badge-primary" style="background: #f7030f">Return Request</span>
                                            @elseif($order->return_order == 2)
                                                <span class="badge badge-pill badge-primary" style="background: #2a20b1">Success</span>
                                            @endif
                                        </label>
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
