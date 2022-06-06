@extends('layouts.app')

@section('content')

<!-- Page Inner -->
<div class="page-inner login-page">
    <div id="main-wrapper" class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-3 login-box">
                <h4 class="login-title">Create an account</h4>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="phone" class="form-control" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="admin">Admin</label>
                        <input type="checkbox" class="form-control" id="admin" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                    <a href="{{ route('login') }}" class="btn btn-default">Login</a><br>
                </form>
            </div>
        </div>
    </div>
</div><!-- /Page Content -->

@endsection
