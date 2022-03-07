@extends('frontend.master')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Foggot Password</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Forgot Password-->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Forgot Password</h4>
                        <p class="">Forgot Your Password? No Problem</p>


                        {{-- start login From --}}
                        <form method="POST" action="{{ route('password.email') }}" class="register-form outer-top-xs" role="form">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control unicase-form-control text-input">
                            </div>
                            @error('name')
                                <span class="invalid-feedeback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Email Password
                                Reset Link</button>
                        </form>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
