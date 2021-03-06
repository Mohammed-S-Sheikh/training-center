@extends('layouts.app')

@section('content')

<!-- Page Inner -->
<div class="page-inner login-page">
    <div id="main-wrapper" class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-3 login-box">
                <h4 class="login-title">تسجيل الدخول الى الحساب</h4>
                <div class="form-group">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert" style="margin-bottom:0;">
                            {{ $errors->first() }}
                        </div>
                    @endif
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" name="password">
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
