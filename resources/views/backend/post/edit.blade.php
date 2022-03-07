@extends('admin.master')




@section('content')
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit post</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        {{-- Start Form --}}
                        <form method="POST" action="{{ route('post.update',$post->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- 1st row --}}
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Post Title En<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $post->post_title_en }}" name="post_title_en" id="post_title_en" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Post Title Persian<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $post->post_title_persian }}" name="post_title_persian" id="post_title_persian" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>



                            {{-- 2th row --}}
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>post Image<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="image" id="image" class="form-control">
                                            <img src="{{ asset($post->image)}}" id="post_image" style="width: 100px;" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Select Category<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($postCategories as $category)
                                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id  ? 'selected':'' }}>{{ $category->postCategory_name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- 3th row --}}
                            <div class="row pt-4">
                                <div class="col-md-6">
                                    <h5>Post Details English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="post_details_en" rows="10" cols="80">{{ $post->post_details_en }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5>Post Details persian<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="post_details_persian" rows="10" cols="80">{{ $post->post_details_persian }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="text-xs-right pt-4">
                                <input type="submit" class="btn btn-rounded btn-info" value="Update">
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#post_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });
        });
    </script>

@endsection
