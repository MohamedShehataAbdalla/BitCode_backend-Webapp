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
                                    <a class="btn btn-primary" href="{{ route('installments') }}"> التحصيلات <i class="fas fa-plus"></i></a>
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
												<th class="wd-10p border-bottom-0 text-center">متبقي من الفاتورة</th>
												<th class="wd-10p border-bottom-0 text-center">المدفوع</th>
												<th class="wd-10p border-bottom-0 text-center">المتبقي</th>
												<th class="wd-5p border-bottom-0 text-center">الحالة</th>
												<th class="wd-15p border-bottom-0 text-center">تاريخ الحذف</th>
												<th class="wd-10p border-bottom-0 text-center">التحكم</th>
											</tr>
										</thead>
										<tbody class="">
                                            @forelse ($installments as $installment)
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
													<td class="text-center">{{ $installment->deleted_at->format('d-m-Y') }}</td>
                                                    <td class="text-center">

                                                        {{-- @can('class-show') --}}
                                                            <a class="btn btn-success btn-sm" href="{{ route('installments.restore',$installment->id) }}" title="أسترجاع"><i class="fas fa-trash-restore"></i></a>
                                                        {{-- @endcan --}}

                                                       {{-- @can('حذف قسم') --}}
                                                        <a class="btn btn-sm btn-danger modal-effect" data-effect="effect-sign" href="#delete_Modal" title="حذف"
                                                            data-id="{{ $installment->id }}" data-installment_number="{{ $installment->installment_number }}" data-installment_date="{{ $installment->installment_date->format('d-m-Y') }}" data-invoice_id ="{{ $installment->invoice->invoice_number  }}" data-invoice_remaining="{{ $installment->invoice_remaining }}" data-toggle="modal" >
                                                                <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                       {{-- @endcan --}}

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="thead-light text-center">
                                                    <td colspan="10">لا يوجد تحصيلات </td>
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
                            <h6 class="modal-title">حذف الإيصال</h6>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('installments.delete') }}" method="post">
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
            var installment_number = button.data('installment_number')
            var installment_date = button.data('installment_date')
            var invoice_id  = button.data('invoice_id')
            var invoice_remaining = button.data('invoice_remaining')
            var modal = $(this)
			var msg = "الإيصال رقم ("+installment_number+" ) بتاريخ ( "+installment_date+" ) من المبلغ المتبقي  ( "+invoice_remaining+" )" ;
			msg += " من الفاتورة رقم ( "+ invoice_id+" ).";
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(msg);
        })
    </script>
@endsection
