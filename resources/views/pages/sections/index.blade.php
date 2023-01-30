@extends('layouts.master')
@section('pageTitle','الأقسام')
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
							<h4 class="content-title mb-0 my-auto">البيانات الأساسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأقسام</span>
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
                                    <a class="btn btn-secondary" href="{{ route('sections.trash') }}"> الأرشيف <i class="fas fa-trash"></i></a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap table-hover table-striped" id="example1">
										<thead>
											<tr>
												<th class="wd-1p border-bottom-0">#</th>
												<th class="wd-20p border-bottom-0">الأسم</th>
												<th class="wd-20p border-bottom-0">الوصف</th>
												<th class="wd-20p border-bottom-0">القسم الرئيسي</th>
												<th class="wd-10p border-bottom-0 text-center">الصورة</th>
												<th class="wd-10p border-bottom-0 text-center">الحالة</th>
												<th class="wd-20p border-bottom-0 text-center">التحكم</th>
											</tr>
										</thead>
										<tbody class="">
                                            @forelse ($sections as $section)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a class="" href="{{ route('sections.show',$section->id) }}">{{ $section->name }} ({{$section->children()->count() ?? 0}})</a>
                                                    </td>
                                                    <td>{{ $section->description }}</td>
                                                    <td>{{ $section->parent->name ?? null }}</td>
                                                    <td class="text-center">
                                                        @if ($section->image)
                                                            <img src="{{ asset('storage/images/'.$section->image) }}" alt="{{ $section->name }}" width="50" />
                                                        @else
                                                            <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" width="50" />
                                                        @endif
                                                    </td>
                                                    <td class="text-center {{ $section->status == true ? 'text-success' : 'text-danger' }}">
                                                        {{ $section->status == true ?  'مفعل' : 'غير مفعل' }}
                                                    </td>
                                                    <td class="text-center">

                                                        @if ($section->status == false)
                                                            {{-- @can('class-active') --}}
                                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('sections.active',$section->id) }}" title="تفعيل"><i class="fas fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @else
                                                            {{-- @can('class-deactivate') --}}
                                                                <a class="btn btn-secondary btn-sm" href="{{ route('sections.deactive',$section->id) }}" title="إلغاء التفعيل"><i class="far fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @endif
                                                        {{-- @can('تعديل قسم') --}}
                                                        <a class="btn btn-sm btn-warning modal-effect" data-effect="effect-sign" data-toggle="modal" href="#update_Modal" title="تعديل"
                                                            data-id="{{ $section->id }}" data-name="{{ $section->name }}" data-description="{{ $section->description }}" 
                                                            data-parent_id="{{ $section->parent_id }}" data-image="{{ $section->image }}" data-status="{{ $section->status }}" >
                                                                <i class="las la-pen"></i>
                                                        </a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('class-show') --}}
                                                            <a class="btn btn-info btn-sm" href="{{ route('sections.show',$section->id) }}" title="عرض"><i class="fas fa-solid fa-binoculars"></i></a>
                                                        {{-- @endcan --}}

                                                       {{-- @can('حذف قسم') --}}
                                                            <a class="btn btn-danger btn-sm" href="{{ route('sections.softDelete',$section->id) }}" title="حذف"><i class="far fa-trash-alt"></i></a>
                                                       {{-- @endcan --}}

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="thead-light text-center">
                                                    <td colspan="7">لا يوجد أقسام</td>
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
                            <h6 class="modal-title">أضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('sections.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الأسم</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                    placeholder="الأجهزة اللإلكترونية"  value="{{old('name')}}" autofocus  maxlength="50">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="parent_id" class="form-label">القسم الرئيسي</label>
                                                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                                    <option value="" selected>حدد القسم الرئيسي</option>
                                                    @foreach ($parent_sections as $section)
                                                        <option value="{{ $section->id }}" {{ old('parent_id') == $section->id ? 'selected' : null }}> {{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('parent_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">الوصف</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                    placeholder="......." rows="3" dir="auto">{{old('description')}}</textarea>
                                                @error('description')
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
                                        <div class="col-md-12">
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
                            <h6 class="modal-title">تعديل القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('sections.update') }}" method="post" enctype="multipart/form-data">
                            {{method_field('patch')}}
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id" value="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الأسم</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                    placeholder="الأجهزة اللإلكترونية"  value="{{old('name')}}" autofocus  maxlength="50">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="parent_id" class="form-label">القسم الرئيسي</label>
                                                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                                    <option value="" selected>حدد القسم الرئيسي</option>
                                                    @foreach ($parent_sections as $section)
                                                        <option value="{{ $section->id }}" {{ old('parent_id') == $section->id ? 'selected' : null }}> {{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('parent_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">الوصف</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                    placeholder="......." rows="3" dir="auto">{{old('description')}}</textarea>
                                                @error('description')
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
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class=" d-flex justify-content-center ">
                                                    <div class="form-check form-switch mt-4  pt-3 ">
                                                        <label class="form-check-label" for="status">الحالة</label>
                                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" {{ (old('status') != null)? (old('status') == true ? 'checked' : null) : 'checked' }} >
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
            var name = button.data('name')
            var description = button.data('description')
            var parent_id = button.data('parent_id')
            var image = button.data('image')
            var status = button.data('status')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #parent_id').val(parent_id);
            if(image)
                modal.find('.modal-body #preview').prop('src', image);
            if(status == 1) 
                modal.find('.modal-body #status').prop('checked', true);
            else 
                modal.find('.modal-body #status').prop('checked', false);
            
         });
    </script>
@endsection