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
                        <div class="row">
                            <div class="col-lg-2 col-xs-6 col-lg-offset-9 pull-right">
                                <a href="{{ route('foreign-trainees.create') }}" class="btn btn-success m-b-sm">إضافة متدرب</a>
                            </div>
                            <div class="col-lg-1 col-xs-4 pull-left">
                                <button type="button" class="btn bg-gray m-b-sm" onclick="toggleField()">
                                    <i class="fa fa-filter"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row filters" style="width:100%;">
                            <form method="GET" action="{{ route('foreign-trainees.index') }}">
                                {{-- @csrf --}}
                                <div class="row">
                                    <div class="form-group col-lg-3 col-xs-12 pull-right">
                                        <input type="text" class="form-control" name="search" placeholder="الإسم، الإيميل، رقم الهاتف" value="{{ old('search') }}">
                                    </div>
                                    @if (Auth::user()->role == 'admin')
                                        <div class="form-group col-lg-2 col-xs-12 pull-right">
                                            <select class="form-control" name="user_id">
                                                <option vlaue="" disabled selected>إختر مستخدم</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group col-lg-2 col-xs-12 pull-right">
                                        <select class="form-control" name="country_id">
                                            <option vlaue="" disabled selected>إختر جنسية</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>{{ $country->nationality }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-2 col-xs-12 pull-right">
                                        <label for="created_at">تاريخ الإشتراك:</label>
                                    </div>
                                    <div class="form-group col-lg-2 col-xs-6 pull-right">
                                        <input type="date" class="form-control" name="created_at[]" placeholder="من" value="{{ old('created_at[]') }}">
                                    </div>
                                    <div class="form-group col-lg-2 col-xs-6 pull-right">
                                        <input type="date" class="form-control" name="created_at[]" placeholder="إلى" value="{{ old('created_at[]') }}">
                                    </div>
                                    <div class="form-group col-lg-1 col-xs-12 pull-left">
                                        <input type="submit" class="btn btn-success" value="بحث"/>
                                    </div>
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
                                        @if(Auth::user()->role == 'admin')
                                            <th>القيمة بالدينار</th>
                                            <th>القيمة بالدولار</th>
                                            <th>بواسطة</th>
                                        @endif
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
                                        <td>{{ $trainee->country->name }}</td>
                                        @if(Auth::user()->role == 'admin')
                                            <td>{{ $trainee->ly }}</td>
                                            <td>{{ $trainee->us }}</td>
                                            <td>{{ $trainee->user->name }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ route('foreign-trainees.edit', ['foreign_trainee' => $trainee->id]) }}" class="btn btn-primary">
                                                <i class="menu-icon icon-pencil"></i>
                                            </a>

                                            @if(
                                                Auth::user()->role == 'admin' ||
                                                $trainee->created_at > now()->subWeek()
                                            )
                                                <button type="button" class="btn btn-danger" onclick="deleteTrainee({{ $trainee->id }})">
                                                    <i class="menu-icon fa fa-trash"></i>
                                                </button>
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
                            {{ $trainees->appends($data)->links() }}
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
                <p>هل متأكد من حذف هذا المتدرب؟</p>
            </div>
            <div class="modal-footer">
                <form id="delete-tainee" method="POST">
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
        function deleteTrainee(traineeId) {
            let url = "{{ route('foreign-trainees.destroy', ':foreign_trainee') }}";
            url = url.replace(':foreign_trainee', traineeId);
            $("#delete-tainee").attr("action", url);
            $('#myModal').modal('show');
        }
        function toggleField(){
            $(".filters").toggle();
        }
    </script>
@endsection
