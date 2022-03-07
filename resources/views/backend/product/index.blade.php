@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Product list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Image</th>
                                            <th>Product En</th>
                                            <th>Product Price</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    <img src="{{ asset($product->product_thumbnail) }}" alt="" style="width: 60px" height="60px">
                                                </td>
                                                <td>{{ $product->product_name_en }}</td>
                                                <td>{{ $product->selling_price }}$</td>
                                                <td>{{ $product->product_qty }}</td>
                                                <td>
                                                    @if ($product->discount_price == null)
                                                        <span class="badge badge-pill badge-danger">No Discount</span>
                                                    @else
                                                        @php
                                                            $amount = $product->selling_price - $product->discount_price;
                                                            $discount = ($amount / $product->selling_price) * 100;
                                                        @endphp
                                                        <span class="badge badge-pill badge-danger">{{round($discount)}}%</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->status)
                                                        <span class="badge badge-pill badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td width="30%">
                                                    <div class="row">
                                                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary ml-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info ml-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                        <form method="POST" action="{{ route('product.destroy', $product->id) }}" id="form" data-id="{{ $product->id }}" class="form-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" class="btn btn-danger ml-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </form>

                                                        @if ($product->status)
                                                            <a href="{{ route('product.inactive', $product->id) }}" title="Inactive now" class="btn btn-danger ml-2"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                                        @else
                                                            <a href="{{ route('product.active', $product->id) }}" title="Active now" class="btn btn-success ml-2"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                                                        @endif
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
