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
                                <a href="{{ route('leads.create') }}" class="btn btn-success m-b-sm">إضافة متدرب</a>
                            </div>
                            <div class="col-lg-1 col-xs-4 pull-left">
                                <button type="button" class="btn bg-gray m-b-sm" onclick="toggleField()">
                                    <i class="fa fa-filter"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row filters" style="width:100%;">
                            <form method="GET" action="{{ route('leads.index') }}">
                                {{-- @csrf --}}
                                <div class="form-group col-lg-3 col-xs-12 pull-right">
                                    <input type="text" class="form-control" name="search" placeholder="الإسم، الإيميل، رقم الهاتف" value="{{ old('search') }}">
                                </div>
                                @if (Auth::user()->is_admin)
                                    <div class="form-group col-lg-2 col-xs-12 pull-right">
                                        <select class="form-control" name="user_id">
                                            <option vlaue="" disabled selected>إختر مندوب</option>
                                            @foreach ($delegates as $delegate)
                                                <option value="{{ $delegate->id }}" @selected(old('user_id') == $delegate->id)>{{ $delegate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group col-lg-2 col-xs-12 pull-right">
                                    <label for="created_at">تاريخ الإشتراك:</label>
                                </div>
                                <div class="form-group col-lg-2 col-xs-6 pull-right">
                                    <input type="date" class="form-control" name="created_at[]" value="{{ old('created_at[]') }}">
                                </div>
                                <div class="form-group col-lg-2 col-xs-6 pull-right">
                                    <input type="date" class="form-control" name="created_at[]" value="{{ old('created_at[]') }}">
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
                                        @if(Auth::user()->is_admin)
                                            <th>القيمة</th>
                                            <th>التخفيض</th>
                                            <th>بواسطة</th>
                                            <th>المدينة</th>
                                        @endif
                                        <th>إعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($leads as $lead)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $lead->name }}</td>
                                        <td>{{ $lead->email }}</td>
                                        <td>{{ $lead->phone }}</td>
                                        @if(Auth::user()->is_admin)
                                            <td>{{ $lead->amount }}</td>
                                            <td>{{ $lead->discount }} %</td>
                                            <td>{{ $lead->user?->name ?? '-' }}</td>
                                            <td>{{ $lead->user?->city->name ?? '-' }}</td>
                                        @endif
                                        <td>
                                            @if(
                                                Auth::user()->is_admin ||
                                                Auth::id() == $lead->user_id
                                            )
                                                <button type="button" class="btn btn-success" onclick="promoteLead({{ $lead->id }})">
                                                    <i class="menu-icon fa fa-arrow-up"></i>
                                                </button>
                                            @endif

                                            <a href="{{ route('leads.edit', ['lead' => $lead->id]) }}" class="btn btn-primary">
                                                <i class="menu-icon icon-pencil"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger" onclick="deleteTrainee({{ $lead->id }})">
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
                            {{ $leads->links() }}
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
                <form id="delete-trainee" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="add-row" class="btn btn-danger" style="float: left;">حذف</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">إلغاء</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="promoteTrainee" tabindex="-1" role="dialog" aria-labelledby="promoteTraineeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:left;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="promoteTraineeLabel">التنسيق مع المتدرب</h4>
            </div>
            <div class="modal-body">
                <p>نقل هذا المتدرب الى صفحة المتدربين؟</p>
            </div>
            <div class="modal-footer">
                <form id="promote-lead" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" id="add-row" class="btn btn-success" style="float: left;">ترقية</button>
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
            console.log(traineeId);
            let url = "{{ route('leads.destroy', ':lead') }}";
            url = url.replace(':lead', traineeId);
            $("#delete-trainee").attr("action", url);
            $('#myModal').modal('show');
        }
        function promoteLead(traineeId) {
            console.log(traineeId);
            let url = "{{ route('leads.promote', ':lead') }}";
            url = url.replace(':lead', traineeId);
            $("#promote-lead").attr("action", url);
            $('#promoteTrainee').modal('show');
        }
        function toggleField(){
            $(".filters").toggle();
        }
    </script>
@endsection
