@extends('layouts.master')
@section('pageTitle','الموظفين')
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
							<h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الموظفين</span>
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
                                    <a class="btn btn-secondary" href="{{ route('employees.trash') }}"> الأرشيف <i class="fas fa-trash"></i></a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap table-hover table-striped" id="example1">
										<thead>
											<tr>
												<th class="wd-1p border-bottom-0">#</th>
												<th class="wd-20p border-bottom-0">الأسم</th>
                                                <th class="wd-15p border-bottom-0">الموبيل</th>
												<th class="wd-15p border-bottom-0">البريد اللإلكتروني</th>
												<th class="wd-5p border-bottom-0">النوع</th>
												<th class="wd-10p border-bottom-0 text-center">الصورة</th>
												<th class="wd-5p border-bottom-0 text-center">الحالة</th>
												<th class="wd-20p border-bottom-0 text-center">التحكم</th>
											</tr>
										</thead>
										<tbody class="">
                                            @forelse ($employees as $employee)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a class="" href="{{ route('employees.show',$employee->id) }}">{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name}} ({{ $employee->invoices->count() }})</a>
                                                    </td>
                                                    <td>{{ $employee->mobile }}</td>
                                                    <td>{{ $employee->user->email ?? null }}</td>
                                                    <td>{{ $employee->gender }}</td>
                                                    <td class="text-center">
                                                        @if ($employee->image)
                                                            <img src="{{ asset('storage/images/'.$employee->image) }}" alt="{{ $employee->first_name }}" width="50" />
                                                        @else
                                                            <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" width="50" />
                                                        @endif
                                                    </td>
                                                    <td class="text-center {{ $employee->status == true ? 'text-success' : 'text-danger' }}">
                                                        {{ $employee->status == true ?  'مفعل' : 'غير مفعل' }}
                                                    </td>
                                                    <td class="text-center">

                                                        @if ($employee->status == false)
                                                            {{-- @can('class-active') --}}
                                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('employees.active',$employee->id) }}" title="تفعيل"><i class="fas fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @else
                                                            {{-- @can('class-deactivate') --}}
                                                                <a class="btn btn-secondary btn-sm" href="{{ route('employees.deactive',$employee->id) }}" title="إلغاء التفعيل"><i class="far fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @endif
                                                        {{-- @can('تعديل قسم') --}}
                                                        <a class="btn btn-sm btn-warning modal-effect" data-effect="effect-sign" data-toggle="modal" href="#update_Modal" title="تعديل"
                                                            data-id="{{ $employee->id }}" data-first_name="{{ $employee->first_name }}" data-middle_name="{{ $employee->middle_name }}" data-last_name="{{ $employee->last_name }}"
                                                            data-address="{{ $employee->address }}" data-image="{{ $employee->image }}" data-status="{{ $employee->status }}" data-job="{{ $employee->job }}" data-user_id="{{ $employee->user_id }}"
                                                            data-personal_id="{{ $employee->personal_id }}" data-gender="{{ $employee->gender }}" data-mobile="{{ $employee->mobile }}" data-dirth_date="{{ $employee->dirth_date }}" data-join_date="{{ $employee->join_date }}"
                                                            data-qualification="{{ $employee->qualification }}" data-job_description="{{ $employee->job_description }}" data-salary="{{ $employee->salary }}" data-commission_percentage="{{ $employee->commission_percentage }}" >
                                                                <i class="las la-pen"></i>
                                                        </a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('class-show') --}}
                                                            <a class="btn btn-info btn-sm" href="{{ route('employees.show',$employee->id) }}" title="عرض"><i class="fas fa-solid fa-binoculars"></i></a>
                                                        {{-- @endcan --}}

                                                       {{-- @can('حذف قسم') --}}
                                                            <a class="btn btn-danger btn-sm" href="{{ route('employees.softDelete',$employee->id) }}" title="حذف"><i class="far fa-trash-alt"></i></a>
                                                       {{-- @endcan --}}

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="thead-light text-center">
                                                    <td colspan="8">لا يوجد موظفين</td>
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
                            <h6 class="modal-title">أضافة موظف</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">الأسم الأول</label>
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                                                    placeholder="محمد"  value="{{old('first_name')}}" autofocus  maxlength="50">
                                                @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="middle_name" class="form-label">الأسم الأوسط</label>
                                                <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name"
                                                    placeholder="شحاته"  value="{{old('middle_name')}}"  maxlength="50">
                                                @error('middle_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">الأسم الأخير</label>
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                                                    placeholder="عبدالله"  value="{{old('last_name')}}"  maxlength="50">
                                                @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="job" class="form-label">الوظيفة</label>
                                                <input type="text" class="form-control @error('job') is-invalid @enderror" id="job" name="job"
                                                    placeholder="مبرمج"  value="{{old('job')}}"  maxlength="13">
                                                @error('job')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="personal_id" class="form-label">الرقم القومي</label>
                                                <input type="text" class="form-control @error('personal_id') is-invalid @enderror" id="personal_id" name="personal_id"
                                                    placeholder="2 12 34 56 78 931 11"  value="{{old('personal_id')}}"  minlength="14" maxlength="20" pattern="\d{1}\s*\d{2}\s*\d{2}\s*\d{2}\s*\d{2}\s*\d{3}\s*\d{2}" oninput="this.value = this.value.replace(/[^0-9\s]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('personal_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="mobile" class="form-label">الموبيل</label>
                                                <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
                                                    placeholder="(011) 2345-6789"  value="{{old('mobile')}}"  maxlength="15" minlength="11" pattern="\(*01(0|1|2|5)\)*\s*\d{4}\-*\d{4}" oninput="this.value = this.value.replace(/[^0-9\s\(\)\-]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-4 d-flex justify-content-evenly ">
                                                <div class="form-check pt-3">
                                                    <input class="form-check-input" type="radio" name="gender" id="gender-male" value="m" checked>
                                                    <label class="form-check-label mr-4" for="gender-male"><i class="fas fa-male"></i> ذكر</label>
                                                </div>
                                                <div class="form-check pt-3">
                                                    <input class="form-check-input" type="radio" name="gender" id="gender-female" value="f">
                                                    <label class="form-check-label mr-4" for="gender-female"><i class="fas fa-female"></i> أنثي</label>
                                                </div>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="dirth_date" class="form-label">تاريخ الميلاد</label>
                                                <input type="date" class="form-control @error('dirth_date') is-invalid @enderror" id="dirth_date" name="dirth_date"
                                                    placeholder=""  value="{{old('dirth_date')}}">
                                                @error('dirth_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="salary" class="form-label">الراتب</label>
                                                <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary"
                                                    placeholder="5000.00"  value="{{old('salary') ??  0.00}}">
                                                @error('salary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="commission_percentage" class="form-label">العمولة</label>
                                                <input type="number" class="form-control @error('commission_percentage') is-invalid @enderror" id="commission_percentage" name="commission_percentage"
                                                    placeholder="5.0"  value="{{old('commission_percentage') ?? 0.00}}">
                                                @error('commission_percentage')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="join_date" class="form-label">تاريخ الأنضمام</label>
                                                <input type="date" class="form-control @error('join_date') is-invalid @enderror" id="join_date" name="join_date"
                                                    placeholder=""  value="{{old('join_date')}}">
                                                @error('join_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="qualification" class="form-label">المؤهلات</label>
                                                <textarea class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification"
                                                    placeholder="......." rows="3" >{{old('qualification')}}</textarea>
                                                @error('qualification')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="job_description" class="form-label">الوصف الوظيفي</label>
                                                <textarea class="form-control @error('job_description') is-invalid @enderror" id="job_description" name="job_description"
                                                    placeholder="......." rows="3" >{{old('job_description')}}</textarea>
                                                @error('job_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">العنوان</label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                                    placeholder="......." rows="3" >{{old('address')}}</textarea>
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">الصورة</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                                    placeholder="حدد الصورة"  value="{{old('image')}}" accept="image/png, image/jpg, image/jpeg" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <div class=" d-flex justify-content-center ">
                                                    <img src="{{ asset('storage/images/noImage.png') }}"  id="preview" alt="Empty" width="90" height="60" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">الحساب</label>
                                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                                    <option value="" selected>حدد الحساب</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : null }}> {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class=" d-flex justify-content-center ">
                                                    <div class="form-check form-switch mt-4  pt-3 ">
                                                        <label class="form-check-label" for="status">الحالة</label>
                                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" {{ (old('status') != null)? (old('status') == true ? 'checked' : null) : 'checked' }}>
                                                        @error('status')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
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
                            <h6 class="modal-title">تعديل موظف</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('employees.update') }}" method="post" enctype="multipart/form-data">
                            {{method_field('patch')}}
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id" value="">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">الأسم الأول</label>
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                                                    placeholder="محمد"  value="{{old('first_name')}}" autofocus  maxlength="50">
                                                @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="middle_name" class="form-label">الأسم الأوسط</label>
                                                <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name"
                                                    placeholder="شحاته"  value="{{old('middle_name')}}"  maxlength="50">
                                                @error('middle_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">الأسم الأخير</label>
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                                                    placeholder="عبدالله"  value="{{old('last_name')}}"  maxlength="50">
                                                @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="job" class="form-label">الوظيفة</label>
                                                <input type="text" class="form-control @error('job') is-invalid @enderror" id="job" name="job"
                                                    placeholder="مبرمج"  value="{{old('job')}}"  maxlength="13">
                                                @error('job')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="personal_id" class="form-label">الرقم القومي</label>
                                                <input type="text" class="form-control @error('personal_id') is-invalid @enderror" id="personal_id" name="personal_id"
                                                    placeholder="2 12 34 56 78 931 11"  value="{{old('personal_id')}}"  minlength="14" maxlength="20" pattern="\d{1}\s*\d{2}\s*\d{2}\s*\d{2}\s*\d{2}\s*\d{3}\s*\d{2}" oninput="this.value = this.value.replace(/[^0-9\s]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('personal_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="mobile" class="form-label">الموبيل</label>
                                                <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
                                                    placeholder="(011) 2345-6789"  value="{{old('mobile')}}"  maxlength="15" minlength="11" pattern="\(*01(0|1|2|5)\)*\s*\d{4}\-*\d{4}" oninput="this.value = this.value.replace(/[^0-9\s\(\)\-]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-4 d-flex justify-content-evenly ">
                                                <div class="form-check pt-3">
                                                    <input class="form-check-input" type="radio" name="gender" id="gender-male" value="m" checked>
                                                    <label class="form-check-label mr-4" for="gender-male"><i class="fas fa-male"></i> ذكر</label>
                                                </div>
                                                <div class="form-check pt-3">
                                                    <input class="form-check-input" type="radio" name="gender" id="gender-female" value="f">
                                                    <label class="form-check-label mr-4" for="gender-female"><i class="fas fa-female"></i> أنثي</label>
                                                </div>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="dirth_date" class="form-label">تاريخ الميلاد</label>
                                                <input type="date" class="form-control @error('dirth_date') is-invalid @enderror" id="dirth_date" name="dirth_date"
                                                    placeholder=""  value="{{old('dirth_date')}}">
                                                @error('dirth_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="salary" class="form-label">الراتب</label>
                                                <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary"
                                                    placeholder="5000.00"  value="{{old('salary') ?? 0.00}}">
                                                @error('salary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="commission_percentage" class="form-label">العمولة</label>
                                                <input type="number" class="form-control @error('commission_percentage') is-invalid @enderror" id="commission_percentage" name="commission_percentage"
                                                    placeholder="5.0"  value="{{old('commission_percentage') ?? 0.00}}">
                                                @error('commission_percentage')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="join_date" class="form-label">تاريخ الأنضمام</label>
                                                <input type="date" class="form-control @error('join_date') is-invalid @enderror" id="join_date" name="join_date"
                                                    placeholder=""  value="{{old('join_date')}}">
                                                @error('join_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="qualification" class="form-label">المؤهلات</label>
                                                <textarea class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification"
                                                    placeholder="......." rows="3" >{{old('qualification')}}</textarea>
                                                @error('qualification')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="job_description" class="form-label">الوصف الوظيفي</label>
                                                <textarea class="form-control @error('job_description') is-invalid @enderror" id="job_description" name="job_description"
                                                    placeholder="......." rows="3" >{{old('job_description')}}</textarea>
                                                @error('job_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">العنوان</label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                                    placeholder="......." rows="3" >{{old('address')}}</textarea>
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">الصورة</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                                    placeholder="حدد الصورة"  value="{{old('image')}}" accept="image/png, image/jpg, image/jpeg" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <div class=" d-flex justify-content-center ">
                                                    <img src="{{ asset('storage/images/noImage.png') }}"  id="preview" alt="Empty" width="90" height="60" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">الحساب</label>
                                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                                    <option value="" selected>حدد الحساب</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : null }}> {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class=" d-flex justify-content-center ">
                                                    <div class="form-check form-switch mt-4  pt-3 ">
                                                        <label class="form-check-label" for="status">الحالة</label>
                                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" {{ (old('status') != null)? (old('status') == true ? 'checked' : null) : 'checked' }}>
                                                        @error('status')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
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
            var first_name = button.data('first_name')
            var middle_name = button.data('middle_name')
            var last_name = button.data('last_name')
            var address = button.data('address')
            var job = button.data('job')
            var image = button.data('image')
            var status = button.data('status')
            var personal_id = button.data('personal_id')
            var gender  = button.data('gender')
            var mobile  = button.data('mobile')
            var dirth_date  = button.data('dirth_date')
            var user_id  = button.data('user_id')
            var qualification  = button.data('qualification')
            var job_description  = button.data('job_description')
            var salary  = button.data('salary')
            var commission_percentage  = button.data('commission_percentage')
            var join_date  = button.data('join_date')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #first_name').val(first_name);
            modal.find('.modal-body #middle_name').val(middle_name);
            modal.find('.modal-body #last_name').val(last_name);
            modal.find('.modal-body #address').val(address);
            modal.find('.modal-body #job').val(job);
            modal.find('.modal-body #personal_id').val(personal_id);
            modal.find('.modal-body #gender').val(gender);
            modal.find('.modal-body #mobile').val(mobile);
            modal.find('.modal-body #dirth_date').val(dirth_date);
            modal.find('.modal-body #user_id').val(user_id);
            modal.find('.modal-body #qualification').val(qualification);
            modal.find('.modal-body #job_description').val(job_description);
            modal.find('.modal-body #salary').val(salary);
            modal.find('.modal-body #commission_percentage').val(commission_percentage);
            modal.find('.modal-body #join_date').val(join_date);
            if(image)
                modal.find('.modal-body #preview').prop('src', image);
            if(status == 1)
                modal.find('.modal-body #status').prop('checked', true);
            else
                modal.find('.modal-body #status').prop('checked', false);

         });
    </script>
@endsection
