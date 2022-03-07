@extends('frontend.master')


@section('title')
    User Update Password
@endsection

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <br>
                    <br>
                    <img class="card-img-top" style="border-radius: 50%" src="{{ !empty(Auth::user()->profile_photo_path) ? asset('storage/' . Auth::user()->profile_photo_path) : asset('upload/no_image.jpg') }}" height="100%" width="100%"
                         alt="Avatar">
                    <br>
                    <br>
                    <ul class="list-group list-group-flush">
                        @include('frontend.partial.userPanel')
                    </ul>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center">
                            <strong>Update Your Password</strong>

                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update.password') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="info-title" for="current_password">Current Password </label>
                                <input type="password" name="oldpassword" id="current_password" class="form-control unicase-form-control text-input">
                                @error('oldpassword')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="name">New Password</label>
                                <input type="password" name="password" id="password" class="form-control unicase-form-control text-input">
                                @error('password')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="name">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control unicase-form-control text-input">
                                @error('password_confirmation')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" value="Update Password">
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
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
