@extends('layouts.master')
@section('pageTitle','التحصيلات')
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
							<h4 class="content-title mb-0 my-auto">العمليات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ التحصيلات</span>
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
                                    <a class="btn btn-primary" href="{{ route('installments.create') }}"> أضافة جديد <i class="fas fa-plus"></i></a>
                                    <a class="btn btn-secondary" href="{{ route('installments.trash') }}"> الأرشيف <i class="fas fa-trash"></i></a>
                                </div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap table-hover table-striped" id="example1">
										<thead>
											<tr>
												<th class="wd-1p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">رقم الفاتورة</th>
												<th class="wd-10p border-bottom-0">رقم التحصيل</th>
												<th class="wd-15p border-bottom-0 text-center">تاريخ السداد</th>
												<th class="wd-15p border-bottom-0 text-center">متبقي من الفاتورة</th>
												<th class="wd-15p border-bottom-0 text-center">المدفوع</th>
												<th class="wd-15p border-bottom-0 text-center">المتبقي</th>
												<th class="wd-5p border-bottom-0 text-center">الحالة</th>
												<th class="wd-10p border-bottom-0 text-center">التحكم</th>
											</tr>
										</thead>
										<tbody class="">
                                            @forelse($installments as $installment)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a class="" href="{{ route('invoices.show',$installment->invoice_id) }}">{{ $installment->invoice->invoice_number }}</a>
                                                    </td>
                                                    <td>
                                                        <a class="" href="{{ route('installments.show',$installment->id) }}">{{ $installment->installment_number }}</a>
                                                    </td>
                                                    <td class="text-center">{{ $installment->installment_date->format('d-m-Y') }}</td>
                                                    <td class="text-center">{{ $installment->invoice_remaining }}</td>
                                                    <td class="text-center">{{ $installment->paid_amount }}</td>
                                                    <td class="text-center">{{ $installment->remaining_amount }}</td>
                                                    <td class="text-center {{ $installment->status == true ? 'text-success' : 'text-danger' }}">
                                                        {{ $installment->status == true ?  'مفعل' : 'غير مفعل' }}
                                                    </td>
                                                    <td class="text-center">
														<div class="dropdown">
															<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm w-100"
															data-toggle="dropdown" id="dropdownMenuButton" type="button"><i class="si si-menu"></i></button>
															<div  class="dropdown-menu tx-13">
                                                                @if ($installment->status == false)
                                                                    <a class="dropdown-item" href="{{ route('installments.active',$installment->id) }}"><i class="fas fa-lightbulb"></i> تفعيل</a>
                                                                @else
                                                                    <a class="dropdown-item" href="{{ route('installments.deactive',$installment->id) }}"><i class="far fa-lightbulb"></i> إلغاء التفعيل</a>
                                                                @endif

                                                                <a class="dropdown-item" href="{{ route('installments.edit',$installment->id) }}"><i class="las la-pen"></i> تعديل</a>

                                                                <a class="dropdown-item" href="{{ route('installments.show',$installment->id) }}"><i class="fas fa-solid fa-binoculars"></i> عرض</a>

                                                                <a class="dropdown-item" href="{{ route('installments.softDelete',$installment->id) }}"><i class="far fa-trash-alt"></i> حذف</a>

                                                                <a class="dropdown-item" href="#"><i class="fas fa-print"></i> طباعة</a>

															</div>
														</div>														
													</td>
                                                </tr>
                                            @empty
                                                <tr class="thead-light text-center">
                                                    <td colspan="9">لا يوجد تحصيلات</td>
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
         
    </script>
@endsection
