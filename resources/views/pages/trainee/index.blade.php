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
                        <a href="{{ route('trainees.create') }}" class="btn btn-success m-b-sm">إضافة متدرب</a>

                        <div class="table-responsive dataTables_wrapper">
                            <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الإسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الهاتف</th>
                                        @if(Auth::user()->is_admin)
                                            <th>القيمة</th>
                                            <th>التخفيض</th>
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
                                        @if(Auth::user()->is_admin)
                                            <td>{{ $trainee->amount }}</td>
                                            <td>{{ $trainee->discount }} %</td>
                                            <td>{{ $trainee->user->name }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ route('trainees.edit', ['trainee' => $trainee->id]) }}" class="btn btn-primary">
                                                <i class="menu-icon icon-pencil"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger" onclick="deleteTrainee({{ $trainee->id }})">
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
        function deleteTrainee(traineeId) {
            console.log(traineeId);
            let url = "{{ route('trainees.destroy', ':trainee') }}";
            url = url.replace(':trainee', traineeId);
            $("#delete-tainee").attr("action", url);
            $('#myModal').modal('show');
        }
    </script>
@endsection
