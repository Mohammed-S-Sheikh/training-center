@extends('layouts.app')

@section('content')

<!-- Page Inner -->
<div class="page-inner login-page">
    <div id="main-wrapper" class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-3 login-box">
                <h4 class="login-title">Sign in to your account</h4>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                    <a href="{{ route('register') }}" class="btn btn-default">Register</a><br>
                </form>
            </div>
        </div>
    </div>
</div><!-- /Page Content -->

@endsection
