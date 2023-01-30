@extends('layouts.master')
@section('pageTitle','تعديل إيصال سداد')
@section('styles')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">

    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">

    <!--Internal  date-picker css -->
    <link href="{{ URL::asset('assets/plugins/date-picker/css/default.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/date-picker/css/default.date.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/date-picker/css/default.time.css') }}" rel="stylesheet">
    @if(config('app.local') == 'ar')
         <link href="{{ URL::asset('assets/plugins/date-picker/css/rtl.css') }}" rel="stylesheet">
    @endif

@endsection
@section('page-header')

        <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        <h4 class="content-title mb-0 my-auto">التحصيلات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل إيصال سداد</span>
                    </div>
                </div>
            </div>
        <!-- breadcrumb -->

@endsection
@section('content')

        @include('layouts.alerts')

                <div class="card">
                    <div class="card-body">
                        <form class="form" id="creation_invoice_form" action="{{ route('installments.update', $installment->id ) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            {{ csrf_field() }}
                            @method('PATCH')
                            <input type="hidden" id="id" name="id" value="{{old('id', $installment->id)}}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="invoice_number" class="form-label">رقم الفاتورة</label>
                                        <input type="hidden" id="invoice_id" name="invoice_id" value="{{old('invoice_id',  $installment->invoice_id)}}">
                                        <input type="text" class="form-control-plaintext @error('invoice_number') is-invalid @enderror" id="invoice_number"
                                            placeholder="INV-500"  value="{{old('invoice_number', $invoice->invoice_number)}}" readonly >
                                        @error('invoice_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="installment_number" class="form-label">رقم إيصال السداد</label>
                                        <input type="number" class="form-control-plaintext @error('installment_number') is-invalid @enderror" id="installment_number" name="installment_number"
                                            placeholder="1"  value="{{old('installment_number', $installment->installment_number)}}" readonly >
                                        @error('installment_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <div class=" d-flex justify-content-center ">
                                            <div class="form-check form-switch mt-4  pt-3 ">
                                                <label class="form-check-label" for="status">الحالة</label>
                                                <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" {{ (old('status') != null)? (old('status') == true ? 'checked' : null) : ($installment->status == true ? 'checked' : null) }}>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="installment_date" class="form-label">تاريخ الأيصال</label>
                                        <input type="text" class="form-control datepicker @error('installment_date') is-invalid @enderror" id="installment_date" name="installment_date"
                                            placeholder="YYYY-MM-DD"  value="{{  old('installment_date', $installment->installment_date->format('d-m-Y') ) }}" required>
                                        @error('installment_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="payment_date" class="form-label">تاريخ السداد</label>
                                        <input type="text" class="form-control datepicker @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date"
                                            placeholder="YYYY-MM-DD"  value="{{ old('payment_date', $installment->payment_date->format('d-m-Y') ) }}" required>
                                        @error('payment_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="invoice_remaining" class="form-label">المبلغ المتبقي من الفاتورة</label>
                                        <input type="number" class="form-control-plaintext @error('invoice_remaining') is-invalid @enderror" id="invoice_remaining" name="invoice_remaining"
                                            placeholder="0.00"  value="{{old('invoice_remaining', number_format($installment->invoice_remaining , 2,'.', '')  )}}" readonly >
                                        @error('invoice_remaining')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="paid_amount" class="form-label">المدفوع</label>
                                        <input type="number" class="form-control @error('paid_amount') is-invalid @enderror" id="paid_amount" name="paid_amount"
                                            placeholder="0.00" step="0.01"  value="{{old('paid_amount', $installment->paid_amount )}}" >
                                        @error('paid_amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="remaining_amount" class="form-label">المتبقي النهائي</label>
                                        <input type="number" class="form-control-plaintext @error('remaining_amount') is-invalid @enderror" id="remaining_amount" name="remaining_amount"
                                            placeholder="0.00"  value="{{old('remaining_amount', $installment->remaining_amount)}}" readonly >
                                        @error('remaining_amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="employee_id" class="form-label">الموظف</label>
                                        <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                                            <option value="" selected>حدد الموظف</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : ($installment->employee_id == true ? 'selected' : null) }}> {{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="note" class="form-label">ملاحظات</label>
                                        <textarea class="form-control @error('note') is-invalid @enderror" placeholder="....." id="note" name="note" rows="3">{{old('note', $installment->note)}}</textarea>
                                        @error('note')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">تعديل الإيصال</button>
                            </div>


                        </form>
                    </div>
                </div>

            </div>
            <!-- Container closed -->
        </div>
		<!-- main-content closed -->

@endsection
@section('scripts')
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
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  jquery-validation js-->
    <script src="{{ URL::asset('assets/plugins/jquery-validation/jquery.form.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    @if(config('app.local') == 'ar')
        <script src="{{ URL::asset('assets/plugins/jquery-validation/messages_ar.min.js') }}"></script>
    @endif
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    {{-- <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script> --}}
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <!--Internal  date-picker js -->
    <script src="{{ URL::asset('assets/plugins/date-picker/js/picker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/date-picker/js/picker.date.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/date-picker/js/picker.time.js') }}"></script>
    @if(config('app.local') == 'ar')
        <script src="{{ URL::asset('assets/plugins/date-picker/js/ar.js') }}"></script>
    @endif

    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>

    <script>
        $(document).ready(function() {

            $('.datepicker').pickadate({
                format: 'yyyy-mm-dd',
                selectMonth: true,
                selectYear: true,
                clear: 'Clear',
                close: 'Ok',
                today: 'Today',
                closeOnSelect: true,
                labelMonthNext: 'Go to the next month',
                labelMonthPrev: 'Go to the previous month',
                labelMonthSelect: 'Pick a month from the dropdown',
                labelYearSelect: 'Pick a year from the dropdown',
                selectMonths: true,
                selectYears: true
            });

            $('#paid_amount').on('keyup blur' , function(){
                let invoice_remaining =  $('#invoice_remaining').val() || 0.00;
                let paid_amount =  parseFloat($(this).val()) || 0.00;
                let remaining_amount = invoice_remaining - paid_amount;
                $('#remaining_amount').val(remaining_amount.toFixed(2));
            });


        });
    </script>


@endsection
