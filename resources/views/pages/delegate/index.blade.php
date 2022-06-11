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
                        <a href="{{ route('delegates.create') }}" class="btn btn-success m-b-sm">إضافة مندوب</a>
                        <div class="table-responsive dataTables_wrapper">
                            <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الإسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الهاتف</th>
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                                <i class="menu-icon icon-pencil"></i>
                                            </button>

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
        function deleteDelegate(id) {
            console.log(id);
            let url = "{{ route('delegates.destroy', ':user') }}";
            url = url.replace(':user', id);
            $("#delete-delegate").attr("action", url);
            $('#myModal').modal('show');
        }
    </script>
@endsection