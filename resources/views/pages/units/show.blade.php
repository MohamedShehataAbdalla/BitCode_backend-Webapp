@extends('layouts.master')
@section('pageTitle','الوحدات')
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
							<h4 class="content-title mb-0 my-auto">البيانات الأساسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تفاصيل الوحدة</span>
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
							<div class="card-header pb-0">
								<div class="d-blok">
                                    <a class="btn btn-secondary" href="{{ route('units') }}"><i class="fas fa-angle-right"></i> رجوع </a>
								</div>
							</div>
							<div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="name">الأسم</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="name" value="{{ $unit->name }}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="description">الوصف</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="description" value="{{ $unit->description }}">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="quantity">الكمية</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="quantity" value="{{ $unit->quantity }} {{ $unit->parent->name ?? null }}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="default">الأفتراضية</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="default" value="{{ $unit->default == 1 ?  'أفتراضي' : 'غير أفتراضي' }}">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="parent_id">الوحدة الرئيسية</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="parent_id" value="{{ $unit->parent->name ?? null }}">
                                                    </li>
                                                    <li class="list-group-item d-none {{ $unit->deleted_at != null ? 'd-block' : '' }}">
                                                        <label for="deleted_at">محذوف في</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="deleted_at" value="{{ $unit->deleted_at ?? null }}">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item d-none {{ $children_units->count() > 0 ? 'd-block' : '' }}">
                                                        <label for="children">الأقسام الفرعية ({{$children_units->count() ?? 0 }})</label>
                                                        @foreach ($children_units as $unit)
                                                            <input type="text" readonly class="form-control-plaintext pr-5" id="children" value=" {{ $loop->iteration }} - {{ $unit->name }}">
                                                        @endforeach
                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item d-none {{ $products->count() > 0 ? 'd-block' : '' }}">
                                                        <label for="product">منتجات هذا القسم ({{$products->count() ?? 0 }})</label>
                                                        @foreach ($products as $product)
                                                            <input type="text" readonly class="form-control-plaintext pr-5" id="product" value=" {{ $loop->iteration }} - {{ $product->name }}">
                                                        @endforeach
                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="status"> الحالة</label>
                                                        <input type="text" readonly class="form-control-plaintext pr-5  {{ $unit->status == 1 ? 'text-success' : 'text-danger' }}" id="status" value="{{ $unit->status == 1 ?  'مفعل' : 'غير مفعل' }}">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->


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

@endsection