@extends('layouts.app')

@section('content')

@include('partials.header')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">تعديل متدرب</h3>
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
                    {{-- <div class="panel-heading">
                        <h4 class="panel-title">تعديل متدرب</h4>
                    </div> --}}
                    <div class="panel-body">
                        <form id="add-row-form" method="POST" action="{{ route('foreign-trainees.update', ['foreign_trainee' => $trainee->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">الإسم</label>
                                <input type="text" id="name-input" class="form-control" name="name" placeholder="الإسم" value="{{ $trainee->name }}" required>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">رقم الهاتف</label>
                                <input type="text" id="phone-input" class="form-control" name="phone" placeholder="رقم الهاتف" value="{{ $trainee->phone }}">
                                @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" id="position-input" class="form-control" name="email" placeholder="البريد الإلكتروني" value="{{ $trainee->email }}">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
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
                            {{-- <div class="form-group">
                                <label for="amount">القيمة</label>
                                <input type="text" id="date-input" class="form-control date-picker" name="amount" placeholder="القيمة" value="{{ $trainee->amount }}">
                                @if ($errors->has('amount'))
                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="discount">التخفيض</label>
                                <input type="text" id="date-input" class="form-control date-picker" name="discount" placeholder="التخفيض" value="{{ $trainee->discount }}">
                                @if ($errors->has('discount'))
                                <span class="text-danger">{{ $errors->first('discount') }}</span>
                                @endif
                            </div> --}}

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
