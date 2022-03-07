@extends('admin.master')

@section('title')
    Admin Profile
@endsection

@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-black">
                            <h3 class="widget-user-username">Admin Name : {{ $admin->name }}</h3>
                            <a href="{{ route('admin.profile.edit',$admin->id)}}" style="float: right" class="btn btn-rounded btn-success mb-5">Edit
                                Profile</a>
                            <h6 class="widget-user-desc">Email :{{ $admin->email }}</h6>
                        </div>
                        <div class="widget-user-image"><img class="rounded-circle bg-white"
                                src="{{ !empty($admin->profile_photo_path) ? asset('upload/admin_images/'.$admin->profile_photo_path) : asset('upload/no_image.jpg')}}" alt="User Avatar">

                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">Mobile NO</h5>
                                        <span class="description-text">}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 br-1 bl-1">
                                    <div class="description-block">
                                        <h5 class="description-header">Address</h5>
                                        <span class="description-text"></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">Gender</h5>
                                        <span class="description-text"></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection
