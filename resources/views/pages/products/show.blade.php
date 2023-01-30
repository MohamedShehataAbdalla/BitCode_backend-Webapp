@extends('layouts.master')
@section('pageTitle','المنتجات')
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
							<h4 class="content-title mb-0 my-auto">العمليات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تفاصيل المنتج</span>
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
                                    <a class="btn btn-secondary" href="{{ route('products') }}"><i class="fas fa-angle-right"></i> رجوع </a>
								</div>
							</div>
							<div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="name">الأسم</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="name" value="{{ $product->name }}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="description">الوصف</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="description" value="{{ $product->description }}">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="barcode">الباركود</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="barcode" value="{{ $product->barcode ?? null }}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="price">السعر</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="price" value="{{ $product->price }}">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item d-none {{ $product->deleted_at != null ? 'd-block' : '' }}">
                                                        <label for="deleted_at">محذوف في</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="deleted_at" value="{{ $product->deleted_at ?? null }}">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/images/'.$product->image) }}" alt="{{ $product->name }}" width="50" />
                                        @else
                                            <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" width="50" />
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="section_id">القسم</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="section_id" value="{{ $product->section->name }}">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="unit_id">الوحدة</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="unit_id" value="{{ $product->unit->name }}">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="trademark_id">الشركة المنتجة</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="trademark_id" value="{{ $product->trademark->name }}">
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
