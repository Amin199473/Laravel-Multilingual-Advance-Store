@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Posts list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Row</th>
                                            <th>Category</th>
                                            <th>Title En</th>
                                            <th>Title Persian</th>
                                            <th>Image</th>
                                            <th>Details En</th>
                                            <th>Details Persian</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $key => $post)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $post->category->postCategory_name_en }}</td>
                                                <td>{{ $post->post_title_en }}</td>
                                                <td>{{ $post->post_title_persian }}</td>
                                                <td>
                                                    <img src="{{ asset($post->image) }}" alt="" style="width: 60px" height="60px">
                                                </td>
                                                <td>{!! Str::limit($post->post_details_en, 15 ,'...') !!}</td>
                                                <td>{!! Str::limit($post->post_details_persian, 15 ,'...') !!}</td>
                                                <td width="25%">
                                                    <div class="row">
                                                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary ml-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info ml-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                        <form method="POST" action="{{ route('post.destroy', $post->id) }}" id="form" data-id="{{ $post->id }}" class="form-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" class="btn btn-danger ml-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </form>
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
