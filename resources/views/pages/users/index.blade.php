@extends('layouts.master')
@section('pageTitle','المستخدمين')
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
							<h4 class="content-title mb-0 my-auto">البيانات الأساسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المستخدمين</span>
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
                                    <a class="btn btn-secondary" href="{{ route('users.trash') }}"> الأرشيف <i class="fas fa-trash"></i></a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap table-hover table-striped" id="example1">
										<thead>
											<tr>
												<th class="wd-1p border-bottom-0">#</th>
												<th class="wd-20p border-bottom-0">الأسم</th>
												<th class="wd-20p border-bottom-0">البريد الإلكتروني</th>
												<th class="wd-20p border-bottom-0">الأدوار</th>
												<th class="wd-10p border-bottom-0 text-center">الصورة</th>
												<th class="wd-10p border-bottom-0 text-center">الحالة</th>
												<th class="wd-20p border-bottom-0 text-center">التحكم</th>
											</tr>
										</thead>
										<tbody class="">
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a class="" href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if (!empty($user->getRoleNames()))
                                                            @foreach ($user->getRoleNames() as $v)
                                                                <label class="badge badge-success">{{ $v }}</label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($user->profile_photo_path)
                                                            <img src="{{ asset('storage/images/'.$user->profile_photo_path) }}" alt="{{ $user->name }}" width="50" />
                                                        @else
                                                            <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" width="50" />
                                                        @endif
                                                    </td>
                                                    <td class="text-center {{ $user->status == true ? 'text-success' : 'text-danger' }}">
                                                        {{ $user->status == true ?  'مفعل' : 'غير مفعل' }}
                                                    </td>
                                                    <td class="text-center">

                                                        @if ($user->status == false)
                                                            {{-- @can('class-active') --}}
                                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('users.active',$user->id) }}" title="تفعيل"><i class="fas fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @else
                                                            {{-- @can('class-deactivate') --}}
                                                                <a class="btn btn-secondary btn-sm" href="{{ route('users.deactive',$user->id) }}" title="إلغاء التفعيل"><i class="far fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @endif
                                                        {{-- @can('تعديل قسم') --}}
                                                        <a class="btn btn-sm btn-warning modal-effect" data-effect="effect-sign" data-toggle="modal" href="#update_Modal" title="تعديل"
                                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" 
                                                            data-profile_photo_path="{{ $user->profile_photo_path }}" data-status="{{ $user->status }}" >
                                                                <i class="las la-pen"></i>
                                                        </a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('class-show') --}}
                                                            <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}" title="عرض"><i class="fas fa-solid fa-binoculars"></i></a>
                                                        {{-- @endcan --}}

                                                       {{-- @can('حذف قسم') --}}
                                                            <a class="btn btn-danger btn-sm" href="{{ route('users.softDelete',$user->id) }}" title="حذف"><i class="far fa-trash-alt"></i></a>
                                                       {{-- @endcan --}}

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="thead-light text-center">
                                                    <td colspan="7">لا يوجد مستخدمين</td>
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
			</div>
			<!-- Container closed -->

            <!-- Start Add Modal effects -->

            <div class="modal fade" id="add_Modal">
                <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">أضافة مستخدم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('users.store') }}" method="post" autocomplete="off">
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الأسم</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                    placeholder="محمد شحاته"  value="{{old('name')}}" autofocus dir="auto"  maxlength="100" dir="auto" >
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                                    placeholder="admin@gmail.com"  value=""  maxlength="100" dir="ltr" >
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">كلمة المرور</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                                    placeholder="******"  value=""  minlength="6"  >
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="mb-3">
                                                <label for="confirm-password" class="form-label">تأكيد كلمة المرور</label>
                                                <input type="password" class="form-control @error('confirm-password') is-invalid @enderror" id="confirm-password" name="confirm-password"
                                                    placeholder="******"  value=""  minlength="6" >
                                                @error('confirm-password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">الصورة</label>
                                                <input type="file" class="form-control @error('profile_photo_path') is-invalid @enderror" id="profile_photo_path" name="profile_photo_path"
                                                    placeholder="حدد صورة"  value="{{old('profile_photo_path')}}" accept="image/png, image/jpg, image/jpeg" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                                @error('profile_photo_path')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="roles_name" class="form-label">الأدوار</label>
                                                <select name="roles_name[]" id="roles_name" class="form-control @error('roles_name') is-invalid @enderror" multiple>
                                                    <option value="" selected disabled>حدد دور</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{$role}}"> {{ $role }}</option>
                                                    @endforeach
                                                </select>
                                                @error('roles_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-check form-switch mt-4">
                                                <label class="form-check-label" for="status">الحالة</label>
                                                <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" checked>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class=" d-flex justify-content-center ">
                                                <img src="{{ asset('storage/images/noImage.png') }}"  id="preview" alt="Empty" width="90" height="60" />
                                            </div>
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
                            <h6 class="modal-title">تعديل مستخدم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('users.update') }}" method="post" autocomplete="off">
                            {{method_field('patch')}}
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id" value="">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الأسم</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                    placeholder="محمد شحاته"  value="{{old('name')}}" autofocus dir="auto"  maxlength="100"  dir="auto" >
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                                    placeholder="admin@gmail.com"  value="{{old('email')}}"  maxlength="100"  dir="ltr" >
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">كلمة المرور</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                                    placeholder="******"  value=""  minlength="6"  >
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="mb-3">
                                                <label for="confirm-password" class="form-label">تأكيد كلمة المرور</label>
                                                <input type="password" class="form-control @error('confirm-password') is-invalid @enderror" id="confirm-password" name="confirm-password"
                                                    placeholder="******"  value=""  minlength="6" >
                                                @error('confirm-password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">الصورة</label>
                                                <input type="file" class="form-control @error('profile_photo_path') is-invalid @enderror" id="profile_photo_path" name="profile_photo_path"
                                                    placeholder="حدد صورة"  value="{{old('profile_photo_path')}}" accept="image/png, image/jpg, image/jpeg" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                                @error('profile_photo_path')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="roles_name" class="form-label">الأدوار</label>
                                                <select name="roles_name[]" id="roles_name" class="form-control @error('roles_name') is-invalid @enderror" multiple>
                                                    <option value="" selected disabled>حدد دور</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{$role}}"> {{ $role }}</option>
                                                    @endforeach
                                                </select>
                                                @error('roles_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-check form-switch mt-4">
                                                <label class="form-check-label" for="status">الحالة</label>
                                                <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" checked>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class=" d-flex justify-content-center ">
                                                <img src="{{ asset('storage/images/noImage.png') }}"  id="preview" alt="Empty" width="90" height="60" />
                                            </div>
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
    </script>
@endsection