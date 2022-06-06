@extends('layouts.app')

@section('content')

@include('partials.header')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">عرض كل المتدربين</h3>
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
                        <h4 class="panel-title">عرض كل المتدربين</h4>
                    </div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-success m-b-sm" data-toggle="modal" data-target="#myModal">إضافة متدرب</button>

                        <form id="add-row-form" method="POST" action="{{ route('trainees.store') }}">
                            @csrf
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:left;"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">إضافة متدرب</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="text" id="name-input" class="form-control" name="name" placeholder="الإسم" required>
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="number" id="phone-input" class="form-control" name="phone" placeholder="رقم الهاتف">
                                                @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="email" id="position-input" class="form-control" name="email" placeholder="البريد الإلكتروني">
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="date-input" class="form-control date-picker" name="amount" placeholder="القيمة">
                                                @if ($errors->has('amount'))
                                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="date-input" class="form-control date-picker" name="discount" placeholder="التخفيض">
                                                @if ($errors->has('discount'))
                                                <span class="text-danger">{{ $errors->first('discount') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="add-row" class="btn btn-success" style="float: left;">إضافة</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">إلغاء</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        <div class="table-responsive dataTables_wrapper">
                            <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الإسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الهاتف</th>
                                        <th>القيمة</th>
                                        <th>التخفيض</th>
                                        <th>بواسطة</th>
                                        <th>إعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trainees as $trainee)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $trainee->name }}</td>
                                        <td>{{ $trainee->email }}</td>
                                        <td>{{ $trainee->phone }}</td>
                                        <td>{{ $trainee->amount }}</td>
                                        <td>{{ $trainee->discount }}</td>
                                        <td>{{ $trainee->user->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary m-b-sm" data-toggle="modal" data-target="#myModal">
                                                <i class="menu-icon icon-pencil"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger m-b-sm" data-toggle="modal" data-target="#myModal">
                                                <i class="menu-icon fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center"> لا يوجد متدربين</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $trainees->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div><!-- /Page Inner -->
</div>

@endsection
