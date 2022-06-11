@extends('layouts.app')

@section('content')

@include('partials.header')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">لوحة التحكم</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
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
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number">{{ $delegatesCount }}</span>
                            <p class="stats-info">عدد المندوبين</p>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-car stats-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number">{{ $trainees->count() }}</span>
                            <p class="stats-info">عدد المتدربين</p>
                        </div>
                        <div class="pull-right">
                            <i class="icon-people stats-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number">{{ $trainees->sum('amount')  }}</span>
                            <p class="stats-info">إجمالي القيم</p>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-money stats-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-white stats-widget">
                    <div class="panel-body">
                        <div class="pull-left">
                            <span class="stats-number">{{ $trainees->sum('amount') - $trainees->sum('discount')  }}</span>
                            <p class="stats-info">صافي الأرباح</p>
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
                            <h4 class="panel-title">ملاحظة: يتم حساب الأرباح عن طريق حساب قيمة الكورس حين تم إدخال المتدرب.</h4>
                        </div>
                        <div class="table-responsive dataTables_wrapper">
                            <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الإسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الهاتف</th>
                                        <th>عدد المتدربين</th>
                                        <th>الأرباح</th>
                                        <th>التخفيضات</th>
                                        <th>الناتج</th>
                                        <th>مسؤول</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($delegates as $delegate)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $delegate->name }}</td>
                                        <td>{{ $delegate->email }}</td>
                                        <td>{{ $delegate->phone ?? '-' }}</td>
                                        <td>{{ $delegate->trainees_count }}</td>
                                        <td>{{ $delegate->trainees->sum('amount') }}</td>
                                        <td>{{ $delegate->trainees->sum('discount')}}</td>
                                        <td>{{ $delegate->trainees->sum('amount') - $delegate->trainees->sum('discount') }}</td>
                                        <td>
                                            @if ($delegate->is_admin)
                                                <span class="badge bg-success">مسؤول</span>
                                            @else
                                                <span class="badge bg-warning">غير مسؤول</span>
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
                            {{ $delegates->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div><!-- Main Wrapper -->
</div><!-- /Page Inner -->

@endsection
