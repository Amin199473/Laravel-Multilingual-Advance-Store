@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Coupon list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Coupo Name</th>
                                            <th>Coupon Discount</th>
                                            <th>Coupon Validity Date</th>
                                            <th>Coupon Status Validity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $key => $coupon)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $coupon->coupon_name }}</td>
                                                <td>{{ $coupon->coupon_discount }}%</td>
                                                <td>{{ Carbon\Carbon::parse($coupon->coupon_validity)->format('D,d F Y') }}</td>
                                                <td>
                                                    @if ($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d')  )
                                                        <span class="badge badge-pill badge-success">Valid</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">InValid</span>
                                                    @endif
                                                </td>
                                                <td width="25%">
                                                    <div class="row">
                                                        <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-info ml-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <form method="POST" action="{{ route('coupon.destroy', $coupon->id) }}" id="form" data-id="{{ $coupon->id }}" class="form-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" class="btn btn-danger ml-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </form>
                                                        @if ($coupon->status)
                                                            <a href="{{ route('coupon.inactive', $coupon->id) }}" title="Inactive now" class="btn btn-danger ml-2"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                                        @else
                                                            <a href="{{ route('coupon.active', $coupon->id) }}" title="Active now" class="btn btn-success ml-2"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
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


                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Coupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('coupon.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <h5>Coupon Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="coupon_name" id="coupon_name" class="form-control">
                                            @error('coupon_name')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Coupon Discount(%)<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="coupon_discount" name="coupon_discount" class="form-control">
                                            @error('coupon_discount')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Coupon Validity<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" id="coupon_validity" name="coupon_validity" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control">
                                            @error('coupon_validity')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Add New">
                                    </div>

                                </form>
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
