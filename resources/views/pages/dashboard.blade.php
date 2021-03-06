@extends('layouts.app')

@section('content')

@include('partials.header')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">لوحة التحكم</h3>
    </div>
    <div id="main-wrapper">
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <h4 class="no-m m-b-lg">الإعدادات</h4>
                        <hr>
                        <table id="user" class="table table-bordered table-striped" style="clear: both">
                            <tbody>
                                @foreach ($settings as $setting)
                                    <tr>
                                        <form action="{{ route('settings.update', $setting->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td style="width: 35%;">{{ $setting->name }}</td>
                                            <td style="width: 60%;">
                                                <input type="text" id="course-amount-input" class="form-control" name="value" placeholder="{{ $setting->name }}" value="{{ $setting->value }}">
                                            </td>
                                            <td style="width: 5%;">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="menu-icon fa fa-check"></i>
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
        <hr>
        <div class="row">
            <div class="col-lg-2 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number">{{ $usersCount }}</span>
                            <p class="stats-info">مستخدمين</p>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-car stats-icon text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number">{{ $trainees->count() }}</span>
                            <p class="stats-info">متدربين</p>
                        </div>
                        <div class="pull-right">
                            <i class="icon-people stats-icon text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number">{{ $leads->count() }}</span>
                            <p class="stats-info">المنسق معهم</p>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-square-o stats-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- <div class="col-lg-2 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number">{{ $trainees->sum('ly')  }}د </span>
                            <p class="stats-info">إجمالي القيم</p>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-money stats-icon text-muted"></i>
                        </div>
                    </div>
                </div>
            </div> --}}
            @if(Auth::user()->role == 'admin')
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-white stats-widget">
                        <div class="panel-body">
                            <div class="pull-left">
                                <span class="stats-number">{{ $trainees->sum('ly') }}</span>
                                <p class="stats-info">صافي الأرباح - دينار</p>
                            </div>
                            <div class="pull-right">
                                <i class="icon-arrow_upward stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number">${{ $trainees->sum('us') }}</span>
                            <p class="stats-info">صافي الأرباح - دولار</p>
                        </div>
                        <div class="pull-right">
                            <i class="icon-arrow_upward stats-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="panel-heading">
                            <h4 class="panel-title">ملاحظة: يتم حساب الأرباح عن طريق حساب قيمة الكورس حين تم إدخال المتدرب مطروحا من قيمة التخفيض.</h4>
                        </div>
                        <div class="table-responsive dataTables_wrapper">
                            <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الإسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الهاتف</th>
                                        <th>المدينة</th>
                                        <th>تم التنسيق مع</th>
                                        <th>عدد المتدربين</th>
                                        @if(Auth::user()->role == 'admin')
                                            <th>الأرباح - دينار</th>
                                        @endif
                                        <th>الأرباح - دولار</th>
                                        <th>الدور الوظيفي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>{{ $user->city->name }}</td>
                                        <td>{{ $user->leads_count }}</td>
                                        <td>{{ $user->trainees_count }}</td>
                                        @if(Auth::user()->role == 'admin')
                                            <td>{{ $user->trainees->sum('ly') }}</td>
                                        @endif
                                        <td>{{ $user->trainees->sum('us')}}</td>
                                        <td>
                                            @if ($user->role == 'admin')
                                                <span class="badge bg-danger">مسؤول</span>
                                            @elseif ($user->role == 'driver')
                                                <span class="badge bg-warning">سائق</span>
                                            @elseif ($user->role == 'user')
                                                <span class="badge bg-info">مندوب</span>
                                            @elseif ($user->role == 'accountant')
                                                <span class="badge bg-success">محاسب</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center"> لا يوجد متدربين</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $users->appends($data)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div><!-- Main Wrapper -->
</div><!-- /Page Inner -->

@endsection
