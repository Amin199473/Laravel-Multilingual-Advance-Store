


@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pending Reviews</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Row</th>
                                            <th>Summary</th>
                                            <th>comment</th>
                                            <th>User</th>
                                            <th>Product</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approvedReviews as $key => $review)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $review->summary }}</td>
                                                <td>{{ $review->comment }}</td>
                                                <td>{{ $review->user->name}}</td>
                                                <td>{{ $review->product->product_name_en }}</td>
                                                <td>
                                                    @if($review->status)
                                                        <span class="badge badge-pill badge-success">Approved</span>
                                                    @else
                                                        <span class="badge badge-pill badge-primary">Pending</span>
                                                    @endif
                                                </td>
                                                <td width="20%">
                                                    <form method="POST" action="{{ route('review.delete', $review->id) }}" id="form" data-id="{{ $review->id }}" class="form-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="#" class="btn btn-danger ml-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </form>
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




