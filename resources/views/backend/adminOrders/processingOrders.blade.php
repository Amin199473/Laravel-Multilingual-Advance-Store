@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Processing Orders list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Row</th>
                                            <th>Data</th>
                                            <th>Invoice</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($processingOrders as $key => $order)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $order->order_date }}</td>
                                                <td>{{ $order->invoice_no }}</td>
                                                <td>${{ $order->amount}}</td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td><span class="badge badge-pill badge-primary">{{ $order->status }}</span></td>
                                                <td width="20%">
                                                    <div class="row">
                                                        <a href="{{ route('pending.order.details', $order->id) }}" class="btn btn-primary ml-2"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                        <a href="{{ route('admin.invoice.download',$order->id) }}" class="btn btn-danger ml-2" target="_blank"><i class="fa fa-download" aria-hidden="true" style="color: white"></i></a>

                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
