@extends('layouts.master')
@section('pageTitle','المخزون')
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
							<h4 class="content-title mb-0 my-auto">العمليات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المخزون</span>
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
                                    <a class="btn btn-secondary" href="{{ route('stocked_products.trash') }}"> الأرشيف <i class="fas fa-trash"></i></a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap table-hover table-striped" id="example1">
										<thead>
											<tr>
												<th class="wd-1p border-bottom-0">#</th>
												<th class="wd-20p border-bottom-0">الأسم</th>
												<th class="wd-15p border-bottom-0">القسم</th>
												<th class="wd-10p border-bottom-0 text-center">الكمية</th>
												<th class="wd-10p border-bottom-0 text-center">تاريخ الأنتاج</th>
												<th class="wd-10p border-bottom-0 text-center">تاريخ الإنتهاء</th>
												<th class="wd-5p border-bottom-0 text-center">الحالة</th>
												<th class="wd-20p border-bottom-0 text-center">التحكم</th>
											</tr>
										</thead>
										<tbody class="">
                                            @forelse ($stockedProducts as $stockedProduct)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a class="" href="{{ route('stocked_products.show',$stockedProduct->id) }}">{{ $stockedProduct->product->name }}</a>
                                                    </td>
                                                    <td>{{ $stockedProduct->product->section->name }}</td>
                                                    <td class="text-center">{{ $stockedProduct->quantity }} {{ $stockedProduct->product->unit->name }}</td>
                                                    <td class="text-center">{{ $stockedProduct->production_date }}</td>
                                                    <td class="text-center">{{ $stockedProduct->expiry_date }}</td>
                                                    <td class="text-center {{ $stockedProduct->status == true ? 'text-success' : 'text-danger' }}">
                                                        {{ $stockedProduct->status == true ?  'مفعل' : 'غير مفعل' }}
                                                    </td>
                                                    <td class="text-center">

                                                        @if ($stockedProduct->status == false)
                                                            {{-- @can('class-active') --}}
                                                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('stocked_products.active',$stockedProduct->id) }}" title="تفعيل"><i class="fas fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @else
                                                            {{-- @can('class-deactivate') --}}
                                                                <a class="btn btn-secondary btn-sm" href="{{ route('stocked_products.deactive',$stockedProduct->id) }}" title="إلغاء التفعيل"><i class="far fa-lightbulb"></i></a>
                                                            {{-- @endcan --}}
                                                        @endif
                                                        {{-- @can('تعديل قسم') --}}
                                                        <a class="btn btn-sm btn-warning modal-effect" data-effect="effect-sign" data-toggle="modal" href="#update_Modal" title="تعديل"
                                                            data-id="{{ $stockedProduct->id }}" data-product_id="{{ $stockedProduct->product_id }}" data-quantity="{{ $stockedProduct->quantity }}" data-section_id="{{ $stockedProduct->product->section_id }}"
                                                            data-production_date="{{ $stockedProduct->production_date }}" data-expiry_date="{{ $stockedProduct->expiry_date }}" data-status="{{ $stockedProduct->status }}" data-product_unit="{{ $stockedProduct->product->unit->name }}">
                                                                <i class="las la-pen"></i>
                                                        </a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('class-show') --}}
                                                            <a class="btn btn-info btn-sm" href="{{ route('stocked_products.show',$stockedProduct->id) }}" title="عرض"><i class="fas fa-solid fa-binoculars"></i></a>
                                                        {{-- @endcan --}}

                                                       {{-- @can('حذف قسم') --}}
                                                            <a class="btn btn-danger btn-sm" href="{{ route('stocked_products.softDelete',$stockedProduct->id) }}" title="حذف"><i class="far fa-trash-alt"></i></a>
                                                       {{-- @endcan --}}

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="thead-light text-center">
                                                    <td colspan="8">لا يوجد مخزون</td>
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
                            <h6 class="modal-title">أضافة مخزون</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('stocked_products.store') }}" method="post">
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="section_id" class="form-label">القسم</label>
                                                <select id="section_id" class="form-control selectBox @error('section_id') is-invalid @enderror" autofocus>
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
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="product_id" class="form-label">المنتج</label>
                                                <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                                                    {{-- <option value="" selected>حدد المنتج</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : null }}> {{ $product->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                                @error('product_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="production_date" class="form-label">تاريخ الأنتاج</label>
                                                <input type="date" class="form-control @error('production_date') is-invalid @enderror" id="production_date" name="production_date"
                                                    value="{{old('production_date')}}">
                                                @error('production_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="expiry_date" class="form-label">تاريخ الأنتهاء</label>
                                                <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date"
                                                    value="{{old('expiry_date')}}">
                                                @error('expiry_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">الكمية</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity"
                                                        placeholder="10.00"  value="{{old('quantity')}}"  >
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="product_unit"></span>
                                                    </div>
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
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
                            <h6 class="modal-title">تعديل مخزون</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('stocked_products.update') }}" method="post">
                            {{method_field('patch')}}
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id" value="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="section_id" class="form-label">القسم</label>
                                                <select id="section_id" class="form-control @error('section_id') is-invalid @enderror" autofocus>
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
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="product_id" class="form-label">المنتج</label>
                                                <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror" autofocus>
                                                    <option value="" selected>حدد المنتج</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : null }}> {{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="production_date" class="form-label">تاريخ الأنتاج</label>
                                                <input type="date" class="form-control @error('production_date') is-invalid @enderror" id="production_date" name="production_date"
                                                    value="{{old('production_date')}}">
                                                @error('production_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="expiry_date" class="form-label">تاريخ الأنتهاء</label>
                                                <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date"
                                                    value="{{old('expiry_date')}}">
                                                @error('expiry_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">الكمية</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity"
                                                        placeholder="10.00"  value="{{old('quantity')}}"  >
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="product_unit"></span>
                                                    </div>
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
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

        $(document).ready(function() {
            $('select.selectBox').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('sections/section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product_id"]').empty();
                            $.each(data, function(index) {
                                const name = Object.values(data)[index]["name"];
                                const id = Object.values(data)[index]["_id"];
                                const unit_id = Object.values(data)[index]["unit_id"];
                                $('select[name="product_id"]').append('<option value="' +
                                    id + '">' +  name + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });

         $('#update_Modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_id = button.data('section_id')
            var product_id = button.data('product_id')
            var quantity = button.data('quantity')
            var product_unit = button.data('product_unit')
            var production_date = button.data('production_date')
            var expiry_date = button.data('expiry_date')
            var status = button.data('status')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_id').val(section_id);
            modal.find('.modal-body #product_id').val(product_id);
            modal.find('.modal-body #quantity').val(quantity);
            modal.find('.modal-body #product_unit').text(product_unit);
            modal.find('.modal-body #production_date').val(production_date);
            modal.find('.modal-body #expiry_date').val(expiry_date);
            if(status == 1)
                modal.find('.modal-body #status').prop('checked', true);
            else
                modal.find('.modal-body #status').prop('checked', false);

         });
    </script>
@endsection
