@extends('layouts.app')

@section('content')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">عرض كل المندوبين</h3>
    </div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">عرض كل المندوبين</h4>
                </div>
                <div class="panel-body">
                    <a class="btn btn-success m-b-sm">إضافة مندوب</a>
                    
                    <div class="table-responsive">
                        <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الإسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>رقم الهاتف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($delegates as $delegate)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $delegate->name }}</td>
                                    <td>{{ $delegate->email }}</td>
                                    <td>{{ $delegate->phone }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center"> لا يوجد مستخدمين</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>الإسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>رقم الهاتف</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- /Page Inner -->

@endsection
