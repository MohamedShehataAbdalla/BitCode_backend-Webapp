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
							<h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تفاصيل الموظف</span>
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
                                    <a class="btn btn-secondary" href="{{ route('employees') }}"><i class="fas fa-angle-right"></i> رجوع </a>
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
                                                        <input type="text" readonly class="form-control-plaintext" id="name" value="{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name}}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="job">الوظيفة</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="job" value="{{ $employee->job }}">
                                                    </li>
                                                    <li class="list-group-item d-none {{ $employee->user_id != null ? 'd-block' : '' }}">
                                                        <label for="user_id">الحساب</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="user_id" value="{{ $employee->user_id ?? null }}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="join_date">تاريخ الأنضمام</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="join_date" value="{{ $employee->join_date }}">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="barcode">الرقم القومي</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="barcode" value="{{ $employee->personal_id }}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="price">الموبيل</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="price" value="{{ $employee->mobile }}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="commission_percentage">العمولة</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="commission_percentage" value="{{ $employee->commission_percentage }}">
                                                    </li>
                                                    <li class="list-group-item d-none {{ $employee->deleted_at != null ? 'd-block' : '' }}">
                                                        <label for="deleted_at">محذوف في</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="deleted_at" value="{{ $employee->deleted_at ?? null }}">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="price">تاريخ الميلاد</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="price" value="{{ $employee->dirth_date }}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="job">النوع</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="job" value="{{ $employee->gender }}">
                                                    </li>
                                                    <li class="list-group-item">
                                                        <label for="salary">الراتب</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="salary" value="{{ $employee->salary }}">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        @if ($employee->image)
                                            <img src="{{ asset('storage/images/'.$employee->image) }}" alt="{{ $employee->first_name }}" width="50" />
                                        @else
                                            <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" width="50" />
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="address">العنوان</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="address" value="{{ $employee->address }}">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="qualification">المؤهلات</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="qualification" value="{{ $employee->qualification }}">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <label for="job_description">الوصف الوظيفي</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="job_description" value="{{ $employee->job_description }}">
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
