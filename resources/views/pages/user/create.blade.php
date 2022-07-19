@extends('layouts.app')

@section('content')
    @include('partials.header')

    <!-- Page Inner -->
    <div class="page-inner">
        <div class="page-title">
            <h3 class="breadcrumb-header">إضافة مستخدم</h3>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mb-3" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div id="main-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <form id="add-row-form" method="POST" action="{{ route('users.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">الإسم</label>
                                    <input type="text" id="name-input" class="form-control" name="name"
                                        placeholder="الإسم" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="text" id="phone-input" class="form-control" name="phone"
                                        placeholder="رقم الهاتف" value="{{ old('phone') }}" required>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="country_id">الجنسية</label>
                                    <select class="form-control" name="country_id">
                                        <option value="" disabled selected>إختر جنسية</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>
                                                {{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="city_id">المدينة</label>
                                    <select class="form-control" name="city_id">
                                        <option value="" disabled selected>إختر مدينة</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" @selected(old('city_id') == $city->id)>
                                                {{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city_id'))
                                        <span class="text-danger">{{ $errors->first('city_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="role">الدور الوظيفي</label>
                                    <select class="form-control" name="role">
                                        <option value="" disabled selected>إختر دور وظيفي</option>
                                        <option value="user">مندوب</option>
                                        <option value="driver">سائق</option>
                                        <option value="admin">مسؤول</option>
                                        <option value="accountant">محاسب</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="text-danger">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني</label>
                                    <input type="email" id="position-input" class="form-control" name="email"
                                        placeholder="البريد الإلكتروني" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">كلمة المرور</label>
                                    <input type="password" id="date-input" class="form-control date-picker" name="password"
                                        placeholder="كلمة المرور" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">تأكيد كلمة المرور</label>
                                    <input type="password" id="date-input" class="form-control date-picker"
                                        name="password_confirmation" placeholder="تأكيد كلمة المرور" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                                <button type="submit" id="add-row"
                                    class="btn btn-success pull-left m-l-xs">إضافة</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
