@extends('layouts.master')
@section('pageTitle','الفواتير')
@section('styles')
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
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

				<!-- row opened -->
				<div class="row row-sm justify-content-center">
					<div class="col-lg-12 col-md-12">
						<div class="card pt-5 pb-5 pl-5 pr-5" id="print">
                            <div class="card-header d-flex">
                                <h2>الفاتورة  {{ $invoice->invoice_number }}</h2>
                            </div>
							<div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>العميل</th>
                                            <td>{{ $invoice->customer->first_name }} {{ $invoice->customer->middle_name }} {{ $invoice->customer->last_name }}</td>
                                            <th>البريد الإلكتروني</th>
                                            <td>{{ $invoice->customer->user->email ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <th>الموبيل</th>
                                            <td>{{ $invoice->customer->mobile }}</td>
                                            <th>تاريخ الفاتورة</th>
                                            <td>{{ $invoice->invoice_date->format('d-m-Y')  }}</td>
                                        </tr>
                                        <tr>
                                            <th>الفاتورة</th>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <th class="{{ ($invoice->remaining_amount == 0) ? 'd-none' : null  }}">تاريخ الأستحقاق</th>
                                            <td class="{{ ($invoice->remaining_amount == 0) ? 'd-none' : null  }}">{{ $invoice->payment_date->format('d-m-Y')  }}</td>
                                        </tr>
                                    </table>

                                    <h3>تفاصيل الفاتورة</h3>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>القسم</th>
                                                <th>المنتج</th>
                                                <th>الوحدة</th>
                                                <th>الكمية</th>
                                                <th>السعر</th>
                                                <th>إجمالي المنتج</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($invoice->invoice_details as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->product->section->name  }}</td>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->product->unit->name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ $item->item_total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"></td>
                                                <th colspan="2">الإجمالي</th>
                                                <td>{{ $invoice->sub_total }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <th colspan="2">الخصم</th>
                                                <td>{{ $invoice->discount_percentage * 100  }}%</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <th colspan="2">الضريبة</th>
                                                <td>{{ $invoice->vat_value }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <th colspan="2">تكلفة التوصيل</th>
                                                <td>{{ $invoice->delivery_cost }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <th colspan="2">الصافي</th>
                                                <td>{{ $invoice->total_due }} ج.م</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <th colspan="2">المدفوع</th>
                                                <td>{{ $invoice->paid_amount }} ج.م</td>
                                            </tr>
                                            <tr class="{{ ($invoice->remaining_amount == 0) ? 'd-none' : null  }}">
                                                <td colspan="4"></td>
                                                <th colspan="2">المتبقي</th>
                                                <td>{{ ($invoice->remaining_amount != 0) ? ($invoice->remaining_amount . ' ج.م' ) : null  }}</td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                    
                                </div>

                                <div class="row d-print-none">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary btn-sm ml-auto" id="print_Button" onclick="printDev()"><i class="fa fa-print"></i> طباعة</button>
                                        <a href="{{ route('invoices.pdf', $invoice->id) }}" target="_blank" class="btn btn-secondary btn-sm ml-auto"><i class="fa fa-file-pdf"></i> تصدير إلي PDF</a>
                                        <a href="{{ route('invoices.send_to_email', $invoice->id) }}" class="btn btn-success btn-sm ml-auto"><i class="fa fa-envelope"></i> إرسال إلي إيميل</a>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				<!-- /row -->
                </div>
                

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
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

    <script>

       function printDev() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
       }

    </script>

@endsection
