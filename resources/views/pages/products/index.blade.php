@extends('layouts.master')
@section('pageTitle','المنتجات')
@section('styles')
    <!-- Internal Data table css -->
    {{-- <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">العمليات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
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
                                    <a class="btn btn-secondary" href="{{ route('products.trash') }}"> الأرشيف <i class="fas fa-trash"></i></a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap table-hover table-striped" id="example1">
										<thead>
											<tr>
												<th class="wd-1p border-bottom-0">#</th>
												<th class="wd-20p border-bottom-0">الأسم</th>
												<th class="wd-15p border-bottom-0">الشركة المنتجة</th>
												<th class="wd-15p border-bottom-0">القسم</th>
												<th class="wd-5p border-bottom-0">السعر</th>
												<th class="wd-5p border-bottom-0">الخصم</th>
												<th class="wd-10p border-bottom-0 text-center">الصورة</th>
												<th class="wd-5p border-bottom-0 text-center">الحالة</th>
												<th class="wd-20p border-bottom-0 text-center">التحكم</th>
											</tr>
										</thead>
										<tbody class="">
                                            @forelse ($products as $product)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a class="" href="{{ route('products.show',$product->id) }}">{{ $product->name }}</a>
                                                    </td>
                                                    <td>{{ $product->trademark->name ?? null }}</td>
                                                    <td>{{ $product->section->name ?? null }}</td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ number_format(((float)$product->discount / (float)$product->price) * 100, 2,'.', '')  }}%</td>
                                                    <td class="text-center">
                                                        @if ($product->image)
                                                            <img src="{{ asset('storage/images/'.$product->image) }}" alt="{{ $product->name }}" width="50" />
                                                        @else
                                                            <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" width="50" />
                                                        @endif
                                                    </td>
                                                    <td class="text-center {{ $product->status == true ? 'text-success' : 'text-danger' }}">
                                                        {{ $product->status == true ?  'مفعل' : 'غير مفعل' }}
                                                    </td>
                                                    <td class="text-center">

                                                        @if ($product->status == false)
                                                            {{-- @can('class-active') --}}
                                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('products.active',$product->id) }}" title="تفعيل"><i class="fas fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @else
                                                            {{-- @can('class-deactivate') --}}
                                                                <a class="btn btn-secondary btn-sm" href="{{ route('products.deactive',$product->id) }}" title="إلغاء التفعيل"><i class="far fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @endif
                                                        {{-- @can('تعديل قسم') --}}
                                                        <a class="btn btn-sm btn-warning modal-effect" data-effect="effect-sign" data-toggle="modal" href="#update_Modal" title="تعديل"
                                                            data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-description="{{ $product->description }}" data-discount="{{ $product->discount }}"
                                                            data-price="{{ $product->price  }}" data-image="{{ asset('storage/images/'.$product->image) }}" data-status="{{ $product->status }}" data-barcode="{{ $product->barcode }}"
                                                            data-section_id="{{ $product->section_id }}" data-unit_id="{{ $product->unit_id }}" data-trademark_id="{{ $product->trademark_id }}" >
                                                                <i class="las la-pen"></i>
                                                        </a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('class-show') --}}
                                                            <a class="btn btn-info btn-sm" href="{{ route('products.show',$product->id) }}" title="عرض"><i class="fas fa-solid fa-binoculars"></i></a>
                                                        {{-- @endcan --}}

                                                       {{-- @can('حذف قسم') --}}
                                                            <a class="btn btn-danger btn-sm" href="{{ route('products.softDelete',$product->id) }}" title="حذف"><i class="far fa-trash-alt"></i></a>
                                                       {{-- @endcan --}}

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="thead-light text-center">
                                                    <td colspan="9">لا يوجد منتجات</td>
                                                </tr>
                                            @endforelse
										</tbody>
                                        <tfoot>
                                            <tr class="pagination product-pagination m-auto d-flex justify-content-center" colspan="9">
                                                {{ $products->appends(request()->input())->links() }}
                                            </tr>
                                        </tfoot>
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
                <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">أضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الأسم</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                    placeholder="لاب توب ديل core i7"  value="{{old('name')}}" autofocus  maxlength="50">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="section_id" class="form-label">القسم</label>
                                                <select name="section_id" id="section_id" class="form-control @error('section_id') is-invalid @enderror">
                                                    <option value="" selected>حدد القسم</option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : null }}> {{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('section_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="barcode" class="form-label">الباركود</label>
                                                <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode"
                                                    placeholder=""  value="{{old('barcode')}}"  maxlength="13">
                                                @error('barcode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">السعر</label>
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01"
                                                    placeholder="100.00"  value="{{old('price')}}"  >
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="discount" class="form-label">الخصم</label>
                                                <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" step="0.01"
                                                    placeholder="100.00"  value="{{old('discount')}}"  >
                                                @error('discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="unit_id" class="form-label">الوحدة</label>
                                                <select name="unit_id" id="unit_id" class="form-control @error('unit_id') is-invalid @enderror">
                                                    <option value="" selected>حدد الوحدة</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : null }}> {{ $unit->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('unit_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="trademark_id" class="form-label">الشركة المنتجة</label>
                                                <select name="trademark_id" id="trademark_id" class="form-control @error('trademark_id') is-invalid @enderror">
                                                    <option value="" selected>حدد الشركة المنتجة</option>
                                                    @foreach ($trademarks as $trademark)
                                                        <option value="{{ $trademark->id }}" {{ old('trademark_id') == $trademark->id ? 'selected' : null }}> {{ $trademark->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('trademark_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">الوصف</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                    placeholder="......." rows="4" dir="auto">{{old('description')}}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="tag_id" class="form-label">العلامات</label>
                                                <div class="items-group"  style="height:100px; overflow: scroll;">
                                                    @foreach ($tags as $tag)
                                                        <div class="form-group mb-1">
                                                            <div class="form-check">
                                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_id-{{ $tag->id }}" class="form-check-input @error('tag_id') is-invalid @enderror"
                                                                {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                                                                <label class="form-check-label mr-3" for="tag_id-{{ $tag->id }}">{{ $tag->name }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('tags')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-8">
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
                                        <div class="col-md-2">
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
                <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">تعديل المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('products.update') }}" method="post" enctype="multipart/form-data">
                            {{method_field('patch')}}
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <input type="hidden"  id="id" name="id" value="{{old('id')}}">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الأسم</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                    placeholder="لاب توب ديل core i7"  value="{{old('name')}}" autofocus  maxlength="50">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="section_id" class="form-label">القسم</label>
                                                <select name="section_id" id="section_id" class="form-control @error('section_id') is-invalid @enderror">
                                                    <option value="" selected>حدد القسم</option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : null }}> {{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('section_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="barcode" class="form-label">الباركود</label>
                                                <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode"
                                                    placeholder=""  value="{{old('barcode')}}"  maxlength="13">
                                                @error('barcode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">السعر</label>
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01"
                                                    placeholder="100.00"  value="{{old('price')}}"  >
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="discount" class="form-label">الخصم</label>
                                                <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" step="0.01"
                                                    placeholder="100.00"  value="{{old('discount')}}"  >
                                                @error('discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="unit_id" class="form-label">الوحدة</label>
                                                <select name="unit_id" id="unit_id" class="form-control @error('unit_id') is-invalid @enderror">
                                                    <option value="" selected>حدد الوحدة</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : null }}> {{ $unit->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('unit_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="trademark_id" class="form-label">الشركة المنتجة</label>
                                                <select name="trademark_id" id="trademark_id" class="form-control @error('trademark_id') is-invalid @enderror">
                                                    <option value="" selected>حدد الشركة المنتجة</option>
                                                    @foreach ($trademarks as $trademark)
                                                        <option value="{{ $trademark->id }}" {{ old('trademark_id') == $trademark->id ? 'selected' : null }}> {{ $trademark->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('trademark_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">الوصف</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                    placeholder="......." rows="4" dir="auto">{{old('description')}}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="tag_id" class="form-label">العلامات</label>
                                                <div class="items-group"  style="height:100px; overflow: scroll;">
                                                    @foreach ($tags as $tag)
                                                        <div class="form-group mb-1">
                                                            <div class="form-check">
                                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_id-{{ $tag->id }}" class="form-check-input @error('tag_id') is-invalid @enderror"
                                                                    {{ is_array(old('tags', $product->tags->pluck('id')->toArray())) && in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                                <label class="form-check-label mr-3" for="tag_id-{{ $tag->id }}">{{ $tag->name }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('tags')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-8">
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
                                                    <img src=""  id="preview" alt="Empty" width="90" height="60" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
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
            var barcode = button.data('barcode')
            var image = button.data('image')
            var status = button.data('status')
            // var price = button.data('price').replace(",", "");
            // var discount = button.data('discount').replace(",", "");
            var price = button.data('price');
            var discount = button.data('discount');
            var section_id  = button.data('section_id')
            var unit_id  = button.data('unit_id')
            var trademark_id  = button.data('trademark_id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #barcode').val(barcode);
            modal.find('.modal-body #price').val(price);
            modal.find('.modal-body #discount').val(discount);
            modal.find('.modal-body #section_id').val(section_id);
            modal.find('.modal-body #unit_id').val(unit_id);
            modal.find('.modal-body #trademark_id').val(trademark_id);
            if(image)
                modal.find('.modal-body #preview').prop('src', image);
            if(status == 1)
                modal.find('.modal-body #status').prop('checked', true);
            else
                modal.find('.modal-body #status').prop('checked', false);

         });
    </script>
@endsection
