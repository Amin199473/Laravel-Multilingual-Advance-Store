@extends('admin.master')

@section('title')
    Admin Panel Dashboard
@endsection


@section('content')

    @php
        $date = date('d-m-y');
        $today = App\Models\Order::where('order_date',$date)->sum('amount');

        $month = date('F');
        $monthlySales = App\Models\Order::where('order_month',$month)->sum('amount');

        $year = date('Y');
        $yearlySales = App\Models\Order::where('order_year',$year)->sum('amount');

        $pendingOrder = App\Models\Order::where('status','pending')->get();
    @endphp

    <div class="container-full">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xl-3 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-primary-light rounded w-60 h-60">
                                <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Today's sales</p>
                                <h3 class="text-white mb-0 font-weight-500">${{ $today }} <small class="text-success"><i class="fa fa-caret-up"></i> USD</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-warning-light rounded w-60 h-60">
                                <i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Monthly's Sales</p>
                                <h3 class="text-white mb-0 font-weight-500">${{ $monthlySales }} <small class="text-success"><i class="fa fa-caret-up"></i>USD</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-info-light rounded w-60 h-60">
                                <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Yearly's sales</p>
                                <h3 class="text-white mb-0 font-weight-500">${{ $yearlySales }} <small class="text-success"><i class="fa fa-caret-up"></i>USD</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-danger-light rounded w-60 h-60">
                                <i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Pending Order</p>
                                <h3 class="text-white mb-0 font-weight-500">{{ count($pendingOrder) }}<small class="text-success"><i class="fa fa-caret-up"></i> Order</small></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title align-items-start flex-column">
                                Recent Orders
                            </h4>
                        </div>

                        @php
                            $orders = App\Models\Order::where('status','pending')->orderBy('id','DESC')->get()
                        @endphp

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <thead>
                                        <tr class="text-uppercase bg-lightest">
                                            <th style="min-width: 250px"><span class="text-white">Date</span></th>
                                            <th style="min-width: 100px"><span class="text-fade">Invoice</span></th>
                                            <th style="min-width: 100px"><span class="text-fade">Amount</span></th>
                                            <th style="min-width: 150px"><span class="text-fade">Payment</span></th>
                                            <th style="min-width: 130px"><span class="text-fade">status</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($orders as $order)
                                        <tr>
                                            <td class="pl-0 py-8">
                                                <span class="text-white font-weight-600 d-block font-size-16">
                                                   {{ Carbon\Carbon::parse($order->order_date)->diffForHumans() }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-white font-weight-600 d-block font-size-16">
                                                   {{ $order->invoice_no }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-white font-weight-600 d-block font-size-16">
                                                   {{$order->amount}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-white font-weight-600 d-block font-size-16">
                                                   {{ $order->payment_method }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary-light badge-lg">{{ $order->status }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection
