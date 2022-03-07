@extends('admin.master')

@section('title')
    Admin Seo Setting
@endsection

@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Seo Setting</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            {{-- start form --}}
                            <form method="POST" action="{{ route('update.seo.setting') }}" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Meta Title<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="meta_title" id="meta_title" value="{{ $seo_setting->meta_title }}" class="form-control">
                                                        @error('meta_title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Meta Author<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="meta_author" id="meta_author" value="{{ $seo_setting->meta_author }}" class="form-control">
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Meta Keyword<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="meta_keyword" id="meta_keyword" value="{{ $seo_setting->meta_keyword }}" class="form-control">
                                                        @error('meta_keyword')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Meta Description<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="5">{{ $seo_setting->meta_description }}</textarea>
                                                    @error('meta_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Google Analytics<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="google_analytics" id="google_analytics" cols="30" rows="5">{{ $seo_setting->google_analytics }}</textarea>
                                                    @error('google_analytics')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="text-xs-right" style="margin-top: 12px">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Save Changes">
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
        <!-- /.content -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });
        });
    </script>
@endsection
