@extends('layouts.app')

@section('content')

@include('partials.header')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">إضافة متدرب</h3>
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
                    <div class="panel-body">
                        <form id="add-row-form" method="POST" action="{{ route('foreign-trainees.store') }}">
                            @csrf
                            <div class="form-group col-lg-12 col-xs-12">
                                <label for="name">الإسم</label>
                                <input type="text" id="name-input" class="form-control" name="name" placeholder="الإسم" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-lg-12 col-xs-12">
                                <label for="phone">رقم الهاتف</label>
                                <input type="text" id="phone-input" class="form-control" name="phone" placeholder="رقم الهاتف" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-lg-12 col-xs-12">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" id="position-input" class="form-control" name="email" placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-lg-12 col-xs-12">
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
                            <div class="form-group col-lg-6 col-xs-6">
                                <label for="us">القيمة بالدولار</label>
                                <input type="text" id="date-input" class="form-control date-picker" name="us" placeholder="القيمة" value="{{ old('us') }}">
                                @if ($errors->has('us'))
                                <span class="text-danger">{{ $errors->first('us') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-xs-6">
                                <label for="ly">القيمة بالدينار</label>
                                <input type="text" id="date-input" class="form-control date-picker" name="ly" placeholder="القيمة" value="{{ old('ly') }}">
                                @if ($errors->has('ly'))
                                <span class="text-danger">{{ $errors->first('ly') }}</span>
                                @endif
                            </div>

                            <button type="submit" id="add-row" class="btn btn-success pull-left m-l-xs">إضافة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div><!-- /Page Inner -->
</div>

@endsection
