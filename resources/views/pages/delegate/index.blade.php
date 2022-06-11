@extends('layouts.app')

@section('content')

@include('partials.header')

<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">عرض كل المندوبين</h3>
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
                        <h4 class="panel-title">عرض كل المندوبين</h4>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-2 col-xs-6 col-lg-offset-9 pull-right">
                                <a href="{{ route('delegates.create') }}" class="btn btn-success m-b-sm">إضافة مندوب</a>
                            </div>
                            <div class="col-lg-1 col-xs-4 pull-left">
                                <button type="button" class="btn bg-gray m-b-sm" onclick="toggleField()">
                                    <i class="fa fa-filter"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row filters" style="width:100%;">
                            <form method="GET" action="{{ route('delegates.index') }}">
                                @csrf
                                {{-- <div class="form-group col-lg-2 col-xs-12 pull-right">
                                    <input type="text" class="form-control" name="amount" placeholder="القيمة" value="{{ old('amount') }}">
                                </div>
                                <div class="form-group col-lg-2 col-xs-12 pull-right">
                                    <input type="text" class="form-control" name="discount" placeholder="التخفيض" value="{{ old('discount') }}">
                                </div> --}}
                                <div class="form-group col-lg-2 col-xs-12 pull-right m-t-xxs">
                                    <input type="checkbox" class="form-control" name="is_admin" value="{{ old('is_admin') }}"/>مسؤول
                                </div>
                                <div class="form-group col-lg-3 col-xs-12 pull-right">
                                    <input type="text" class="form-control" name="search" placeholder="الإسم، الإيميل، رقم الهاتف" value="{{ old('search') }}">
                                </div>
                                <div class="form-group col-lg-2 col-xs-12">
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
                                        <th>مسؤول</th>
                                        <th>إعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($delegates as $delegate)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $delegate->name }}</td>
                                        <td>{{ $delegate->email }}</td>
                                        <td>{{ $delegate->phone ?? '-' }}</td>
                                        <td>
                                            @if ($delegate->is_admin)
                                                <span class="badge bg-success">مسؤول</span>
                                            @else
                                                <span class="badge bg-warning">غير مسؤول</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('delegates.edit', ['delegate' => $delegate->id]) }}" class="btn btn-primary">
                                                <i class="menu-icon icon-pencil"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger" onclick="deleteDelegate({{ $delegate->id }})">
                                                <i class="menu-icon fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center"> لا يوجد مندوبين</td>
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
                <p>هل متأكد من حذف هذا المندوب؟</p>
            </div>
            <div class="modal-footer">
                <form id="delete-delegate" method="POST">
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
            let url = "{{ route('delegates.destroy', ':user') }}";
            url = url.replace(':user', id);
            $("#delete-delegate").attr("action", url);
            $('#myModal').modal('show');
        }
        function toggleField(){
            $(".filters").toggle();
        }
    </script>
@endsection