@extends('layouts.master')
@section('pageTitle','الصلاحيات')
@section('styles')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الصلاحيات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')


    @include('layouts.alerts')

    	<!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-blok">
                            <a class="modal-effect btn btn-primary " data-effect="effect-sign" data-toggle="modal" href="#add_Modal"> أضافة جديد <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap table-hover table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-5p border-bottom-0">#</th>
                                        <th class="border-bottom-0">الأسم</th>
                                        <th class="wd-20p border-bottom-0 text-center">التحكم</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @forelse ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a class="" href="{{ route('roles.show',$role->id) }}">{{ $role->name }}</a>
                                            </td>
                                            <td class="text-center">

                                                <a class="btn btn-sm btn-warning modal-effect" data-effect="effect-sign" data-toggle="modal" href="#update_Modal" title="تعديل"
                                                    data-id="{{ $role->id }}" data-name="{{ $role->name }}" data-name="{{ $role->name }}" >
                                                        <i class="las la-pen"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}" title="عرض"><i class="fas fa-solid fa-binoculars"></i></a>
                                                <a class="btn btn-sm btn-danger modal-effect" data-effect="effect-sign" href="#delete_Modal" title="حذف"
                                                data-id="{{ $role->id }}" data-name="{{ $role->name }}" data-toggle="modal" >
                                                        <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="thead-light text-center">
                                            <td colspan="3">لا يوجد أدوار</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->
        </div>
        <!-- /row -->




            <!-- row -->
            {{-- <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-right">
                                        @can('اضافة صلاحية')
                                            <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">اضافة</a>
                                        @endcan
                                    </div>
                                </div>
                                <br>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap table-hover ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @can('عرض صلاحية')
                                                        <a class="btn btn-success btn-sm"
                                                            href="{{ route('roles.show', $role->id) }}">عرض</a>
                                                    @endcan

                                                    @can('تعديل صلاحية')
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                                    @endcan

                                                    @if ($role->name !== 'owner')
                                                        @can('حذف صلاحية')
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                            $role->id], 'style' => 'display:inline']) !!}
                                                            {!! Form::submit('حذف', ['class' => 'btn btn-danger btn-sm']) !!}
                                                            {!! Form::close() !!}
                                                        @endcan
                                                    @endif


                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/div-->
            </div> --}}
            <!-- row closed -->
    </div>
    <!-- Container closed -->

    <!-- Start Add Modal effects -->

    <div class="modal fade" id="add_Modal">
        <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">أضافة دور</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('roles.store') }}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">الأسم</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                            placeholder="Admin"  value="{{old('name')}}" autofocus dir="auto"  maxlength="100" dir="auto" >
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <ul id="treeview1">
                                        <li><a href="#">الصلاحيات</a>
                                            <ul>
                                                </li>
                                                    @foreach ($permission as $value)
                                                        <div class="col">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{$value->id}}" id="permission{{$value->id}}"
                                                                    {{-- @foreach ($kidGuardians as $kidGuardian)
                                                                        {{ $guardian->id == $kidGuardian->guardian_id  ? 'checked' : '' }}
                                                                    @endforeach --}}
                                                                    >
                                                                <label class="form-check-label mr-3" for="permission{{$value->id}}">
                                                                    {{  $value->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @error('permission')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End Add Modal effects-->

     <!-- Start Update Modal effects -->

    <div class="modal fade" id="update_Modal">
        <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل دور</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('roles.update') }}" method="post" autocomplete="off">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">الأسم</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                            placeholder="Admin"  value="{{old('name')}}" autofocus dir="auto"  maxlength="100" dir="auto" >
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <ul id="treeview1">
                                        <li><a href="#">الصلاحيات</a>
                                            <ul>
                                                </li>
                                                    @foreach ($permission as $value)
                                                        <div class="col">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{$value->id}}" id="permission{{$value->id}}"
                                                                    {{-- @foreach ($kidGuardians as $kidGuardian)
                                                                        {{ $guardian->id == $kidGuardian->guardian_id  ? 'checked' : '' }}
                                                                    @endforeach --}}
                                                                    >
                                                                <label class="form-check-label mr-3" for="permission{{$value->id}}">
                                                                    {{  $value->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @error('permission')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End Update Modal effects-->

    <!-- Start Delete Modal effects-->

    <div class="modal fade" id="delete_Modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف الدور</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('roles.delete') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <!-- End Delete Modal effects-->


</div>
<!-- main-content closed -->
@endsection
@section('scripts')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

    <script>
         $('#update_Modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')
            // var roles_name = button.data('roles_name')
            var status = button.data('status')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #email').val(email);
            // modal.find('.modal-body #roles_name').val(roles_name);

            if(status == 1)
                modal.find('.modal-body #status').prop('checked', true);
            else
                modal.find('.modal-body #status').prop('checked', false);

         });

         $('#delete_Modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        });
    </script>
@endsection
