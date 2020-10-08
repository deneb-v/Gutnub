@extends('template')
@section('content')
    <div class="container-fluid">
        <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100vh">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h2 class="card-title">Login</h2>

                    <a class="btn btn-primary" href="{{ route('loginByGoogle') }}" role="button">
                        <i class="fab fa-google"></i>
                        Login by Google Account
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
