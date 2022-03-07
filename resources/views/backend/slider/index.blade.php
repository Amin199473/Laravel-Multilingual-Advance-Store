@extends('admin.master')


@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Slider list</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $key => $slider)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    @if ($slider->title)
                                                        {{$slider->title}}
                                                    @else
                                                        <span class="badge badge-pill badge-danger">No Title</span>
                                                    @endif
                                                </td>
                                                <td>{{ $slider->description }}</td>
                                                <td>
                                                    <img style="width: 70px" height="40px" src="{{ asset($slider->slider_img) }}" alt="">
                                                </td>
                                                <td>
                                                    @if ($slider->status)
                                                        <span class="badge badge-pill badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td width="25%">
                                                    <div class="row">
                                                        <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-info ml-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                        <form method="POST" action="{{ route('slider.destroy', $slider->id) }}" id="form" data-id="{{ $slider->id }}" class="form-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" class="btn btn-danger ml-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </form>

                                                        @if ($slider->status)
                                                            <a href="{{ route('slider.inactive', $slider->id) }}" title="Inactive now" class="btn btn-danger ml-2"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                                        @else
                                                            <a href="{{ route('slider.active', $slider->id) }}" title="Active now" class="btn btn-success ml-2"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
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
                            <h3 class="box-title">Add Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <h5>Title<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title" id="title" class="form-control">
                                            @error('title')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Description<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="description" id="description" class="form-control" placeholder="Your Description"></textarea>
                                            @error('description')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Slider Image<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="image" id="image" class="form-control">
                                            @error('image')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="control">
                                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="" style="width: 100px; border:1px solid #000000">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });
        });
    </script>
@endsection
