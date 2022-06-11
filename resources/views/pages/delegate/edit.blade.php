@extends('layouts.app')

@section('content')

@include('partials.header')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">تعديل مندوب</h3>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-3" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger mb-3" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">تعديل مندوب</h4>
                    </div>
                    <div class="panel-body">
                        <form id="add-row-form" method="POST" action="{{ route('delegates.update', ['delegate' => $user->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="text" id="name-input" class="form-control" name="name" placeholder="الإسم" value="{{ $user->name }}" required>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="number" id="phone-input" class="form-control" name="phone" placeholder="رقم الهاتف" value="{{ $user->phone }}" required>
                                @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="email" id="position-input" class="form-control" name="email" placeholder="البريد الإلكتروني" value="{{ $user->email }}" required>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" id="date-input" class="form-control date-picker" name="password" placeholder="كلمة المرور">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" id="date-input" class="form-control date-picker" name="password_confirmation" placeholder="تأكيد كلمة المرور">
                                @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="date-input" class="form-control date-picker" name="is_admin" value="1" {{ $user->is_admin? 'checked' : null }}>مسؤول
                                @if ($errors->has('is_admin'))
                                <span class="text-danger">{{ $errors->first('is_admin') }}</span>
                                @endif
                            </div>
                            
                            <button type="submit" id="add-row" class="btn btn-success pull-left m-l-xs">تعديل</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div><!-- /Page Inner -->
</div>

@endsection
