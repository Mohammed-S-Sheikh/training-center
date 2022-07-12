@extends('layouts.app')

@section('content')

@include('partials.header')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">عرض كل المستخدمين</h3>
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
                        <h4 class="panel-title">عرض كل المستخدمين</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-2 col-xs-6 col-lg-offset-9 pull-right">
                                <a href="{{ route('users.create') }}" class="btn btn-success m-b-sm">إضافة مستخدم</a>
                            </div>
                        </div>

                        <div class="row" style="width:100%;">
                            <form method="GET" action="{{ route('users.index') }}">
                                {{-- @csrf --}}
                                <div class="form-group col-lg-3 col-xs-12 pull-right">
                                    <input type="text" class="form-control" name="search" placeholder="الإسم، الإيميل، رقم الهاتف" value="{{ old('search') }}">
                                </div>
                                <div class="form-group col-lg-2 col-xs-12 pull-right">
                                    <select class="form-control" name="country_id">
                                        <option vlaue="" disabled selected>إختر جنسية</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-2 col-xs-12 pull-right">
                                    <select class="form-control" name="city_id">
                                        <option vlaue="" disabled selected>إختر مدينة</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" @selected(old('city_id') == $city->id)>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-1 col-xs-12 pull-left">
                                    <input type="submit" class="btn btn-success" value="بحث"/>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive dataTables_wrapper">
                            <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الإسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الهاتف</th>
                                        <th>البلد</th>
                                        <th>المدينة</th>
                                        <th>الدور الوظيفي</th>
                                        <th>إعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>{{ $user->country->name }}</td>
                                        <td>{{
                                            $user->country->name == 'ليبيا'
                                                ? $user->city->name : '-'
                                        }}</td>
                                        <td>
                                            @if ($user->role == 'admin')
                                                <span class="badge bg-success">مسؤول</span>
                                            @elseif ($user->role == 'driver')
                                                <span class="badge bg-warning">سائق</span>
                                            @else
                                                <span class="badge bg-info">مندوب</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">
                                                <i class="menu-icon icon-pencil"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger" onclick="deleteDelegate({{ $user->id }})">
                                                <i class="menu-icon fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center"> لا يوجد مستخدمين</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div><!-- /Page Inner -->
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:left;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">حذف متدرب</h4>
            </div>
            <div class="modal-body">
                <p>هل متأكد من حذف هذا المستخدم؟</p>
            </div>
            <div class="modal-footer">
                <form id="delete-user" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="add-row" class="btn btn-danger" style="float: left;">حذف</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">إلغاء</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        $(".filters").toggle();
        function deleteDelegate(id) {
            let url = "{{ route('users.destroy', ':user') }}";
            url = url.replace(':user', id);
            $("#delete-user").attr("action", url);
            $('#myModal').modal('show');
        }
        function toggleField(){
            $(".filters").toggle();
        }
    </script>
@endsection
