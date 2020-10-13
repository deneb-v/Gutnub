@extends('layout.loginlayout')
@section('content')
<div class="container"  style="min-height: 100vh">
    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row align-items-center">
                        <div class="col-lg-6 ">
                            <img src="{{{ asset('img/logo/Gutnub-logo-wtext.png') }}}" style="width: 100%;" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                    <a href="{{ route('loginByGoogle') }}" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Login with Google
                                    </a>
                                <hr>
                                {{-- <div class="text-center">
                                    <a class="small" href="forgot-password.html">About Us</a>
                                </div> --}}
                                {{-- <div class="text-center">
                                    <a class="small" href="register.html">Create an Account!</a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
