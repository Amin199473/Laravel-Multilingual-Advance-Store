@extends('frontend.master')

@section('title')
    User Dashboard
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
                            <strong>{{ Auth::user()->name }}</strong> welcome Online Shop
                        </h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
