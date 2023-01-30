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
                                    <a class="btn btn-primary" href="{{ route('invoices') }}"> الفواتير <i class="fas fa-plus"></i></a>
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
												<th class="wd-5p border-bottom-0 text-center">الخصم</th>
												<th class="wd-10p border-bottom-0">الصافي</th>
												<th class="wd-5p border-bottom-0 text-center">التسليم</th>
												<th class="wd-10p border-bottom-0 text-center">السداد</th>
												<th class="wd-5p border-bottom-0 text-center">الحالة</th>
												<th class="wd-15p border-bottom-0 text-center">تاريخ الحذف</th>
												<th class="wd-10p border-bottom-0 text-center">التحكم</th>
											</tr>
										</thead>
										<tbody class="">
                                            @forelse ($invoices as $invoice)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a class="" href="{{ route('invoice_details.show',$invoice->id) }}">{{ $invoice->invoice_number }}</a>
                                                    </td>
                                                    <td class="text-center">{{ $invoice->invoice_date->format('d-m-Y') }}</td>
                                                    <td class="text-center">{{ $invoice->discount_percentage * 100 }}%</td>
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
													<td class="text-center">{{ $invoice->deleted_at->format('d-m-Y') }}</td>
                                                    <td class="text-center">

                                                        {{-- @can('class-show') --}}
                                                            <a class="btn btn-success btn-sm" href="{{ route('invoices.restore',$invoice->id) }}" title="أسترجاع"><i class="fas fa-trash-restore"></i></a>
                                                        {{-- @endcan --}}

                                                       {{-- @can('حذف قسم') --}}
                                                        <a class="btn btn-sm btn-danger modal-effect" data-effect="effect-sign" href="#delete_Modal" title="حذف"
                                                            data-id="{{ $invoice->id }}" data-invoice_number="{{ $invoice->invoice_number }}" data-invoice_date="{{ $invoice->invoice_date->format('d-m-Y') }}" data-total_due="{{ $invoice->total_due }}" data-customer="{{ $invoice->customer->first_name }} {{ $invoice->customer->middle_name }} {{ $invoice->customer->last_name }}" data-toggle="modal" >
                                                                <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                       {{-- @endcan --}}

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="thead-light text-center">
                                                    <td colspan="13">لا يوجد فواتير </td>
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

			<!-- Start Delete Modal effects-->

            <div class="modal fade" id="delete_Modal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">حذف الفاتورة</h6>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('invoices.delete') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                <input type="hidden" name="id" id="id" value="">
                                <textarea class="form-control" name="name" id="name" type="text" readonly></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>

            <!-- End Delete Modal effects-->


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
        $('#delete_Modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var invoice_number = button.data('invoice_number')
            var invoice_date = button.data('invoice_date')
            var total_due = button.data('total_due')
            var customer = button.data('customer')
            var modal = $(this)
			var msg = "الفاتورة رقم ("+invoice_number+" ) بتاريخ ( "+invoice_date+" ) وصافي المبلغ  ( "+total_due+" )" ;
			msg += (customer != null)? (" \n للعميل ( "+ customer+" ).") : null ;
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(msg);
        })
    </script>
@endsection
