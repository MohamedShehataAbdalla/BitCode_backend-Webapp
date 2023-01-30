@extends('layouts.master')
@section('pageTitle','الفواتير')
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
							<h4 class="content-title mb-0 my-auto">العمليات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير</span>
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
                                    <a class="btn btn-primary" href="{{ route('invoices.create') }}"> أضافة جديد <i class="fas fa-plus"></i></a>
                                    <a class="btn btn-secondary" href="{{ route('invoices.trash') }}"> الأرشيف <i class="fas fa-trash"></i></a>
                                    <div class="float-left">
                                        <a class="btn btn-outline-primary" href="{{ route('invoices.paid') }}">  الفواتير المدفوعة <i class="fas fa-solid fa-receipt"></i></a>
                                        <a class="btn btn-outline-primary" href="{{ route('invoices.unpaid') }}">  الفواتير الغير مدفوعة <i class="fas fa-solid fa-receipt"></i></a>
                                        <a class="btn btn-outline-primary" href="{{ route('invoices.partial') }}">  الفواتير المدفوعة جزئيأ <i class="fas fa-solid fa-receipt"></i></a>
                                    </div>
                                </div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap table-hover table-striped" id="example1">
										<thead>
											<tr>
												<th class="wd-1p border-bottom-0">#</th>
												<th class="wd-10p border-bottom-0">رقم الفاتورة</th>
												<th class="wd-15p border-bottom-0 text-center">تاريخ الفاتورة</th>
												<th class="wd-5p border-bottom-0 text-center">القطع</th>
												<th class="wd-10p border-bottom-0">الإجمالي</th>
												<th class="wd-5p border-bottom-0 text-center">الخصم</th>
												<th class="wd-5p border-bottom-0 text-center">الضريبة</th>
												<th class="wd-5p border-bottom-0 text-center">التوصيل</th>
												<th class="wd-10p border-bottom-0">الصافي</th>
												<th class="wd-5p border-bottom-0 text-center">التسليم</th>
												<th class="wd-10p border-bottom-0 text-center">السداد</th>
												<th class="wd-5p border-bottom-0 text-center">الحالة</th>
												<th class="wd-10p border-bottom-0 text-center">التحكم</th>
											</tr>
										</thead>
										<tbody class="">
                                            @forelse ($invoices as $invoice)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a class="" href="{{ route('invoices.show',$invoice->id) }}">{{ $invoice->invoice_number }}</a>
                                                    </td>
                                                    <td class="text-center">{{ $invoice->invoice_date->format('d-m-Y') }}</td>
                                                    <td class="text-center">{{ $invoice->invoice_detalils->count() }}</td>
                                                    <td>{{ $invoice->sub_total }}</td>
                                                    <td class="text-center">{{ $invoice->discount_percentage * 100 }}%</td>
                                                    <td class="text-center">{{ $invoice->vat_value }}</td>
                                                    <td class="text-center">{{ $invoice->delivery_cost }}</td>
                                                    <td>{{ $invoice->total_due }}</td>
                                                    <td class="text-center {{ $invoice->delivery_status == true ? 'text-success' : 'text-danger' }}">
                                                        {{ $invoice->delivery_status == true ?  'مستلمة' : 'غير مستلمة' }}
                                                    </td>
                                                    <td class="text-center {{ $invoice->payment_status == 'paid' ? 'text-success' : ($invoice->payment_status == 'partial' ? 'text-warning' : 'text-danger') }}">
                                                        {{ $invoice->payment_status == 'paid' ? 'مدفوعة' : ($invoice->payment_status == 'partial' ? 'مدفوعة جزئياً' : 'غير مدفوعة') }}
                                                    </td>
                                                    <td class="text-center {{ $invoice->status == true ? 'text-success' : 'text-danger' }}">
                                                        {{ $invoice->status == true ?  'مفعل' : 'غير مفعل' }}
                                                    </td>
                                                    <td class="text-center">
														<div class="dropdown">
															<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm w-100"
															data-toggle="dropdown" id="dropdownMenuButton" type="button"><i class="si si-menu"></i></button>
															<div  class="dropdown-menu tx-13">
                                                                @if ($invoice->status == false)
                                                                    <a class="dropdown-item" href="{{ route('invoices.active',$invoice->id) }}"><i class="fas fa-lightbulb"></i> تفعيل</a>
                                                                @else
                                                                    <a class="dropdown-item" href="{{ route('invoices.deactive',$invoice->id) }}"><i class="far fa-lightbulb"></i> إلغاء التفعيل</a>
                                                                @endif

                                                                <a class="dropdown-item" href="{{ route('invoices.edit',$invoice->id) }}"><i class="las la-pen"></i> تعديل</a>

                                                                <a class="dropdown-item" href="{{ route('invoices.show',$invoice->id) }}"><i class="fas fa-solid fa-binoculars"></i> عرض</a>

                                                                <a class="dropdown-item" href="{{ route('invoices.softDelete',$invoice->id) }}"><i class="far fa-trash-alt"></i> حذف</a>

                                                                <a class="dropdown-item" href="#"><i class="fas fa-money-bill"></i> تغير حالة الدفع</a>
                                                                <a class="dropdown-item" href="#"><i class="fas fa-money-bill"></i> تغير حالة الاستلام</a>

                                                                <a class="dropdown-item" href="#"><i class="fas fa-print"></i> طباعة</a>

															</div>
														</div>														
													</td>
                                                </tr>
                                            @empty
                                                <tr class="thead-light text-center">
                                                    <td colspan="13">لا يوجد فواتير</td>
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
