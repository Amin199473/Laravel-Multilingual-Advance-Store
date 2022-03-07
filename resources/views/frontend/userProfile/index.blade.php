@extends('frontend.master')

@section('title')
    Update User Profile
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
                            <span class="text-danger">Hi...</span>
                            <strong>{{ Auth::user()->name }}</strong> Update Your Profile
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.profile.edit', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label class="info-title" for="name">Name </label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control unicase-form-control text-input" id="name">
                                @error('name')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="name">Email </label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control unicase-form-control text-input" id="email">
                                @error('email')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="name">Phone </label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control unicase-form-control text-input" id="phone">
                                @error('phone')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="name">Profile Image</label>
                                <input type="file" name="image" class="form-control unicase-form-control text-input" id="image">
                                @error('name')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="control">
                                    <img id="showImage" src="{{ !empty($user->profile_photo_path) ? url('storage/' . $user->profile_photo_path) : url('upload/no_image.jpg') }}" alt="" style="width: 100px; border:1px solid #000000">
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" value="Update">
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
