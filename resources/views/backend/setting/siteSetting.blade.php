@extends('admin.master')

@section('title')
Admin Site Setting
@endsection

@section('content')

    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Site Setting</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            {{-- start form --}}
                            <form method="POST" action="{{ route('update.site.setting')}}" enctype="multipart/form-data" >
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Site Logo <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="logo" id="logo" class="form-control">
                                                        @error('logo')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="control">
                                                        <img id="showImage" src="{{ $site_setting->logo ? asset($site_setting->logo) : url('upload/no_image.jpg') }}" alt="" style="width: 100px; border:1px solid #000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Site Email<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="email" id="email" value="{{ $site_setting->email }}" class="form-control">
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
                                                    <h5>Phone One<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="phone_one" id="phone_one" value="{{ $site_setting->phone_one }}" class="form-control">
                                                        @error('phone_one')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Phone Two<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="test" name="phone_two" id="phone_two" value="{{ $site_setting->phone_two }}" class="form-control">
                                                        @error('phone_two')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Company Name<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="test" name="company_name" id="company_name" value="{{ $site_setting->company_name }}" class="form-control">
                                                        @error('company_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Company Address<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="company_address" name="company_address" id="company_address" value="{{ $site_setting->company_address }}" class="form-control">
                                                        @error('company_address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>FaceBook Link<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="facebook" id="facebook" value="{{ $site_setting->facebook }}" class="form-control">
                                                        @error('facebook')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Twitter<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="twitter" id="twitter" value="{{ $site_setting->twitter }}" class="form-control">
                                                        @error('twitter')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Linkedin<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="linkedin" id="linkedin" value="{{ $site_setting->linkedin }}" class="form-control">
                                                        @error('linkedin')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5>Youtube<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="youtube" id="youtube" value="{{ $site_setting->youtube }}" class="form-control">
                                                        @error('youtube')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="text-xs-right">
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
