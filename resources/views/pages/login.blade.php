@extends('layouts.app')

@section('content')

<!-- Page Inner -->
<div class="page-inner login-page">
    <div id="main-wrapper" class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-3 login-box">
                <h4 class="login-title">تسجيل الدخول الى الحساب</h4>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" name="email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">
                        تسجيل الدخول
                    </button>
                </form>
            </div>
        </div>
    </div>
</div><!-- /Page Content -->

@endsection
