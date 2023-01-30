@extends('layouts.master')
@section('pageTitle','تغيير حالة الدفع')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تغيير حالة الدفع</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

        @if (session()->has('Edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif


        <!-- row -->
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('Status_Update', ['id' => $invoices->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            {{ csrf_field() }}
                            {{-- 1 --}}

                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="invoice_id" value="{{ $invoices->id }}">
                                    <label for="inputName" class="control-label">رقم الفاتورة</label>
                                    <input type="text" class="form-control" id="inputName" name="invoice_number"
                                        title="يرجي ادخال رقم الفاتورة" value="{{ $invoices->invoice_number }}" readonly>
                                </div>

                                <div class="col">
                                    <label>تاريخ الفاتورة</label>
                                    <input class="form-control" name="invoice_Date" placeholder="YYYY-MM-DD"
                                        type="text" value="{{ $invoices->invoice_Date }}" readonly>
                                </div>

                                <div class="col">
                                    <label>تاريخ الاستحقاق</label>
                                    <input class="form-control" name="Due_date" placeholder="YYYY-MM-DD"
                                        type="text" readonly value="{{ $invoices->Due_date }}">
                                </div>

                            </div>

                            {{-- 2 --}}
                            <div class="row">
                                <div class="col">
                                    <label for="Section" class="control-label">القسم</label>
                                    <input class="form-control" name="Section" type="text" readonly value="{{ $invoices->section->section_name }}">
                                </div>

                                <div class="col">
                                    <label for="product" class="control-label">المنتج</label>
                                    <input class="form-control" name="product" id="product" type="text" readonly value="{{ $invoices->product }}">
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                    <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $invoices->Amount_collection }}" readonly>
                                </div>
                            </div>


                            {{-- 3 --}}

                            <div class="row">

                                <div class="col">
                                    <label for="inputName" class="control-label">مبلغ العمولة</label>
                                    <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                        name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        readonly value="{{ $invoices->Amount_Commission }}">
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">الخصم</label>
                                    <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                        title="يرجي ادخال مبلغ الخصم "
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        readonly value="{{ $invoices->Discount }}">
                                </div>

                                <div class="col">
                                    <label for="Rate_VAT" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                    <input class="form-control" name="Rate_VAT" id="Rate_VAT" type="text" readonly value="{{ $invoices->Rate_VAT}}">
                                </div>

                            </div>

                            {{-- 4 --}}

                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                    <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" value="{{ $invoices->Value_VAT }}" readonly>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                    <input type="text" class="form-control" id="Total" name="Total" value="{{ $invoices->Total }}" readonly>
                                </div>
                            </div>

                            {{-- 5 --}}
                            <div class="row">
                                <div class="col">
                                    <label for="exampleTextarea">ملاحظات</label>
                                    <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>{{ $invoices->note }}</textarea>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col">
                                    <label for="exampleTextarea">حالة الدفع</label>
                                    <select class="form-control" id="Status" name="Status" required>
                                        <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
                                        <option value="مدفوعة">مدفوعة</option>
                                        <option value="مدفوعة جزئيا">مدفوعة جزئيا</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>تاريخ الدفع</label>
                                    <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                        type="text" required>
                                </div>
                            </div><br>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            
        </div>

        </div>

        <!-- row closed -->
        </div>
        <!-- Container closed -->
        </div>
        <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>


@endsection