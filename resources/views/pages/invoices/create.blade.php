@extends('layouts.master')
@section('pageTitle','أضافة فاتورة')
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

    <style>
        form.form label.error, label.error {
            color: red;
            font-style: italic;
        }
    </style>

@endsection
@section('page-header')

        <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضافة فاتورة</span>
                    </div>
                </div>
            </div>
        <!-- breadcrumb -->

@endsection
@section('content')

        @include('layouts.alerts')

                <div class="card">
                    <div class="card-body">
                        <form class="form" id="creation_invoice_form" action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="invoice_number" class="form-label">رقم الفاتورة</label>
                                        <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" id="invoice_number" name="invoice_number"
                                            placeholder="INV-500"  value="{{old('invoice_number')}}" autofocus  maxlength="50">
                                        @error('invoice_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="invoice_date" class="form-label">تاريخ الفاتورة</label>
                                        <input type="text" class="form-control datepicker @error('invoice_date') is-invalid @enderror" id="invoice_date" name="invoice_date"
                                            placeholder="YYYY-MM-DD"  value="{{ date('Y-m-d') }}" required>
                                        @error('invoice_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="delivery_date" class="form-label">تاريخ التسليم</label>
                                        <input type="text" class="form-control datepicker @error('delivery_date') is-invalid @enderror" id="delivery_date" name="delivery_date"
                                            placeholder="YYYY-MM-DD"  value="{{ date('Y-m-d') }}" required>
                                        @error('delivery_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div class=" d-flex justify-content-center ">
                                            <div class="form-check form-switch mt-4  pt-3 ">
                                                <label class="form-check-label" for="delivery_status">التسليم</label>
                                                <input class="form-check-input" type="checkbox" role="switch" id="delivery_status" name="delivery_status" {{ (old('delivery_status') != null)? (old('delivery_status') == true ? 'checked' : null) : 'checked' }}>
                                                @error('delivery_status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="customer_id" class="form-label">العميل</label>
                                        <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
                                            <option value="" selected>حدد العميل</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : null }}> {{ $customer->first_name }} {{ $customer->middle_name }} {{ $customer->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="employee_id" class="form-label">الموظف</label>
                                        <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                                            <option value="" selected>حدد الموظف</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : null }}> {{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table text-md-nowrap table-hover table-striped" id="invoice_detils">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p border-bottom-0 text-center">#</th>
                                            <th class="wd-20p border-bottom-0">القسم</th>
                                            <th class="wd-20p border-bottom-0">المنتج</th>
                                            <th class="wd-15p border-bottom-0">الوحدة</th>
                                            <th class="wd-10p border-bottom-0 text-center">الكمية</th>
                                            <th class="wd-10p border-bottom-0 text-center">السعر</th>
                                            <th class="wd-10p border-bottom-0 text-center">إجمالي المنتج</th>
                                            <th class="wd-10p border-bottom-0 text-center">إلغاء</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <tr class="cloning_row" id="0">
                                            <td class="text-center pb-0"><div class="input-table mt-2">1</div></td>
                                            <td class=" pb-0">
                                                <div class="input-table">
                                                    <select id="section_id" class="form-control section_id @error('section_id') is-invalid @enderror">
                                                        <option value="" selected>حدد القسم</option>
                                                        @foreach ($sections as $section)
                                                            <option value="{{ $section->id }}" {{  old('section_id[0]') ? (old('section_id[0]') == $section->id ? 'selected' : null) : null }}> {{ $section->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('section_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td class=" pb-0">
                                                <div class="input-table">
                                                    <select name="product_id[0]" id="product_id" class="form-control product_id @error('product_id') is-invalid @enderror">
                                                        <option value="" selected>حدد المنتج</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}" {{  old('product_id[0]') ? (old('product_id[0]') == $product->id ? 'selected' : null) : null }}> {{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td class=" pb-0">
                                                <div class="input-table">
                                                    <select name="unit_id[0]" id="unit_id" class="form-control unit_id @error('unit_id') is-invalid @enderror">
                                                        <option value="" selected>حدد الوحدة</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}" {{  old('unit_id[0]') ? (old('unit_id[0]') == $unit->id ? 'selected' : null) : null }}> {{ $unit->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('unit_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td class="text-center pb-0">
                                                <div class="input-table">
                                                    <input type="number" name="quantity[0]" id="quantity" class="form-control text-center quantity @error('quantity') is-invalid @enderror"
                                                        placeholder="0.00"  value={{ old("quantity[0]") ? old("quantity[0]") : "0.00" }}  min="0" step="0.01" >
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td class="text-center pb-0">
                                                <div class="input-table">
                                                    <input type="number" name="price[0]" id="price" class="form-control text-center price @error('price') is-invalid @enderror"
                                                        value={{ old("price[0]") ? old("price[0]") : "0.00" }} step="0.01" >
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td class="text-center pb-0">
                                                <div class="input-table">
                                                    <input type="number" name="item_total[0]" id="item_total" class="form-control-plaintext text-center item_total @error('item_total') is-invalid @enderror"
                                                        value={{ old("item_total[0]") ? old("item_total[0]") : "0.00" }}  min="0" step="0.01" readonly >
                                                    @error('item_total')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td class="text-center pb-0">
                                                <div class="input-table mt-2">
                                                    <button type="button" class="btn btn-danger btn-sm " title="إلغاء" disabled><i class="far fa-window-close"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="">
                                        <tr>
                                            <td colspan="8">
                                                <button type="button" class="btn_add_row btn btn-primary btn-sm">أضافة منتج أخر <i class="far fa-plus-square"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td colspan="1">الإجمالي</td>
                                            <td colspan="2" class="text-center">
                                                <div class="input-group input-table">
                                                    <input type="number" name="sub_total" id="sub_total" class="form-control text-center sub_total" value="0.00" readonly >
                                                    <div class="input-group-prepend"> <span class="input-group-text">ج.م</span> </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td colspan="1">الخصم</td>
                                            <td colspan="2" class="text-center">
                                                <div class="input-group input-table">
                                                    <div class="input-group-prepend">
                                                        <select id="discount_type" class="form-control">
                                                            <option value="value" selected>قيمة</option>
                                                            <option value="percentage">نسبة</option>
                                                        </select>
                                                    </div>
                                                    <input type="number" step="0.01"  class="form-control text-center discount" id="discount" value="0.00" >
                                                    <input type="hidden" name="discount_percentage" id="discount_percentage" value="0.00" >
                                                    <input type="hidden" name="discount_value" id="discount_value" value="0.00" >
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-white discount_info">ج.م</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td colspan="1">الضريبة (<span class="vat_percentage">5</span><span class="percentage">%</span>)</td>
                                            <td colspan="2" class="text-center">
                                                <div class="input-group input-table">
                                                    <input type="number" name="vat_value" id="vat_value" class="form-control text-center vat_value" value="0.00" readonly >
                                                    <input type="hidden" name="vat_percentage" id="vat_percentage" value="0.00" >
                                                    <div class="input-group-prepend"> <span class="input-group-text">ج.م</span> </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td colspan="1">خدمة التوصيل</td>
                                            <td colspan="2" class="text-center">
                                                <div class="input-group input-table">
                                                    <input type="number" name="delivery_cost" step="0.01"  id="delivery_cost" class="form-control text-center delivery_cost" value="0.00" >
                                                    <div class="input-group-prepend"> <span class="input-group-text bg-white">ج.م</span> </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td colspan="1">صافي المبلغ</td>
                                            <td colspan="2" class="text-center">
                                                <div class="input-group input-table">
                                                    <input type="number" name="total_due" id="total_due" class="form-control text-center total_due" value="0.00" readonly >
                                                    <div class="input-group-prepend"> <span class="input-group-text">ج.م</span> </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td colspan="1">المبلغ المدفوع</td>
                                            <td colspan="2" class="text-center">
                                                <div class="input-group input-table">
                                                    <input type="number" name="paid_amount" step="0.01"  id="paid_amount" class="form-control text-center paid_amount" value="0.00" >
                                                    <div class="input-group-prepend"> <span class="input-group-text bg-white">ج.م</span> </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="d-none">
                                            <td colspan="5"></td>
                                            <td colspan="1">المبلغ المتبقي</td>
                                            <td colspan="2" class="text-center">
                                                <div class="input-group input-table">
                                                    <input type="number" name="remaining_amount" id="remaining_amount" class="form-control text-center remaining_amount" value="0.00" readonly >
                                                    <div class="input-group-prepend"> <span class="input-group-text">ج.م</span> </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="d-none">
                                            <td colspan="5"></td>
                                            <td colspan="1">تاريخ الأستحقاق</td>
                                            <td colspan="2" class="text-center">
                                                <div class="input-table">
                                                    <input type="text" class="form-control text-center  datepicker" id="payment_date" name="payment_date"
                                                        placeholder="YYYY-MM-DD"  value="{{ date('Y-m-d') }}" required>
                                                </div>
                                            </td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="note" class="form-label">ملاحظات</label>
                                        <textarea class="form-control @error('note') is-invalid @enderror" placeholder="....." id="note" name="note" rows="3">{{old('note')}}</textarea>
                                        @error('note')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="attachment" class="form-label">المرفقات</label><span class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </span>
                                        <input type="file" name="attachment" id="attachment" class="dropify form-control @error('attachment') is-invalid @enderror" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                        @error('attachment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">حفظ الفاتورة</button>
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

            $('#invoice_detils').on('keyup blur', '.quantity' , function(){
                let $row = $(this).closest('tr');
                let quantity = $row.find('.quantity').val() || 0.00;
                let price = $row.find('.price').val() || 0.00;

                $row.find('.item_total').val((quantity * price).toFixed(2));
                $('#sub_total').val(sub_total('.item_total'));
                $('#vat_value').val(calculate_Vat());
                $('#total_due').val(calculate_Due_Total());
                $('#remaining_amount').val(calculate_Remaining_Amount());
            });

            $('#discount_type').on('change' , function(){
                (this.value == 'percentage')? $('.discount_info').text('%') : $('.discount_info').text('ج.م') ;
                $('#vat_value').val(calculate_Vat());
                $('#total_due').val(calculate_Due_Total());
                $('#remaining_amount').val(calculate_Remaining_Amount());
            });

            $('#discount').on('keyup blur' , function(){
                $('#vat_value').val(calculate_Vat());
                $('#total_due').val(calculate_Due_Total());
                $('#remaining_amount').val(calculate_Remaining_Amount());
            });

            $('#delivery_cost').on('keyup blur' , function(){
                $('#total_due').val(calculate_Due_Total());
                $('#remaining_amount').val(calculate_Remaining_Amount());
            });

            $('#paid_amount').on('keyup blur' , function(){
                $('#remaining_amount').val(calculate_Remaining_Amount());
                if(calculate_Remaining_Amount() > 0) {
                    $('#remaining_amount').parent().parent().parent().removeClass('d-none');
                    $('#payment_date').parent().parent().parent().removeClass('d-none');
                }else {
                    $('#remaining_amount').parent().parent().parent().addClass('d-none');
                    $('#payment_date').parent().parent().parent().addClass('d-none');
                }
            });

            let sub_total = function($selector){
                let sum = 0;
                $($selector).each(function(){
                    let selectorVal = $(this).val() || 0.00;
                    sum += parseFloat(selectorVal);
                });
                return sum.toFixed(2);
            };

            let calculate_Vat = function(){
                let sub_total = $('.sub_total').val() || 0.00;
                let discount_type = $('#discount_type').val();
                let discount = parseFloat($('.discount').val()) || 0.00;
                let discountVal = 0.00;
                let discountPre = 0.00;

                if(discount != 0)
                {
                    if(discount_type == 'percentage'){
                        discountVal = ( sub_total * (discount / 100) ).toFixed(2);
                        $('#discount_percentage').val((discount / 100).toFixed(2));
                        $('#discount_value').val(discountVal);
                    }
                    else{
                        discountPre = ((discount / sub_total) * 100).toFixed(2);
                        discountVal = discount ;
                        $('#discount_value').val(discount);
                        $('#discount_percentage').val(discountPre);
                    }
                }
                let vatPre = 0.05 ;
                let vatVal = (sub_total - discountVal) * vatPre ;
                $('#vat_percentage').val(vatPre);

                return vatVal.toFixed(2);
            };

            let calculate_Due_Total = function(){
                let sum = 0;
                let sub_total = parseFloat($('.sub_total').val()) || 0.00;
                let discount_type = $('#discount_type').val();
                let discount = parseFloat($('.discount').val()) || 0.00;

                let discountVal = ((discount != 0) ? ((discount_type == 'percentage')? (sub_total * (discount / 100)) : (discount)) : (0.00));

                let vat_value = parseFloat($('.vat_value').val()) || 0.00;
                let delivery_cost = parseFloat($('.delivery_cost').val()) || 0.00;

                sum += sub_total;
                sum -= discountVal;
                sum += vat_value;
                sum += delivery_cost;

                $('#paid_amount').val(sum.toFixed(2));

                return sum.toFixed(2);
            };

            let calculate_Remaining_Amount = function(){
                let total_due = parseFloat($('#total_due').val()) || 0.00;
                let paid_amount = parseFloat($('#paid_amount').val()) || 0.00;

                if (paid_amount > total_due) $('#paid_amount').val(total_due);

                let remaining_amount =  (paid_amount <  total_due)? parseFloat(total_due - paid_amount) : 0.00;

                return remaining_amount.toFixed(2);
            };



            $(document).on('click', '.btn_add_row', function(){
                let trCount = $('#invoice_detils').find('tr.cloning_row:last').length;
                let numberIncr = trCount > 0 ? parseInt($('#invoice_detils').find('tr.cloning_row:last').attr('id')) + 1 : 0 ;

                // let rowNum = numberIncr;
                $('#invoice_detils').find('tbody').append(
                    $('' +
                        '<tr class="cloning_row" id="' + numberIncr  + '">' +
                            '<td class="text-center pb-0"><div class="input-table mt-2">'+ parseInt(numberIncr + 1) +'</div></td>' +
                            '<td class=" pb-0">' +
                                '<div class="input-table">' +
                                    '<select class="form-control section_id">' +
                                        '<option value="" selected>حدد القسم</option>' +
                                        @foreach ($sections as $section)
                                            '<option value="{{ $section->id }}"> {{ $section->name }}</option>' +
                                        @endforeach
                                    '</select>' +
                                '</div>' +
                            '</td>' +
                            '<td class=" pb-0">' +
                                '<div class="input-table">' +
                                    '<select name="product_id[]" class="form-control product_id">' +
                                        '<option value="" selected>حدد المنتج</option>' +
                                        @foreach ($products as $product)
                                            '<option value="{{ $product->id }}" > {{ $product->name }}</option>' +
                                        @endforeach
                                    '</select>' +
                                '</div>' +
                            '</td>' +
                            '<td class=" pb-0">' +
                                '<div class="input-table">' +
                                    '<select name="unit_id[]" class="form-control unit_id">' +
                                        '<option value="" selected>حدد الوحدة</option>' +
                                        @foreach ($units as $unit)
                                            '<option value="{{ $unit->id }}"> {{ $unit->name }}</option>' +
                                        @endforeach
                                    '</select>' +
                                '</div>' +
                            '</td>' +
                            '<td class="text-center pb-0">' +
                                '<div class="input-table">' +
                                    '<input type="number" name="quantity[]" class="form-control text-center quantity" placeholder="0.00"  value={{ old("quantity[' + numberIncr  + ']") ? old("quantity[' + numberIncr  + ']") : "0.00" }}  min="0" step="0.01" >' +
                                '</div>' +
                            '</td>' +
                            '<td class="text-center pb-0">' +
                                '<div class="input-table">' +
                                    '<input type="number" name="price[]" class="form-control text-center price" value={{ old("price[' + numberIncr  + ']") ? old("price[' + numberIncr  + ']") : "0.00" }} step="0.01" >' +
                                '</div>' +
                            '</td>' +
                            '<td class="text-center pb-0">' +
                                '<div class="input-table">' +
                                    '<input type="number" name="item_total[]" class="form-control-plaintext text-center item_total" value={{ old("item_total[' + numberIncr  + ']") ? old("item_total[' + numberIncr  + ']") : "0.00" }}  min="0" step="0.01" readonly >' +
                                '</div>' +
                            '</td>' +
                            '<td class="text-center pb-0">' +
                                '<div class="input-table mt-2">' +
                                    '<button type="button" class="btn btn-danger btn-sm btn_delete_row" title="إلغاء"><i class="far fa-window-close"></i></button>' +
                                '</div>' +
                            '</td>' +
                        '</tr>'
                    )
                );
            });

            $(document).on('click', '.btn_delete_row', function(e){
                e.preventDefault();
                $(this).parent().parent().parent().remove();
                $('#sub_total').val(sub_total('.item_total'));
                $('#vat_value').val(calculate_Vat());
                $('#total_due').val(calculate_Due_Total());
                $('#remaining_amount').val(calculate_Remaining_Amount());
            });

            $('#creation_invoice_form').on('submit', function(e){
                $('select.section_id').each(function(){ $(this).rules("add", { required : true }); });
                $('select.product_id').each(function(){ $(this).rules("add", { required : true }); });
                $('select.unit_id').each(function(){ $(this).rules("add", { required : true }); });
                $('input.quantity').each(function(){ $(this).rules("add", { required : true, number : true }); });
                $('input.price').each(function(){ $(this).rules("add", { required : true, number : true }); });
                $('input.item_total').each(function(){ $(this).rules("add", { required : true, number : true }); });
                e.preventDefault();
            });

            $('#creation_invoice_form').validate({
                rules: {
                    '.invoice_date' : { required : true , date : true } ,
                    '.payment_date' : { required : true , date : true } ,
                    '.delivery_date' : { required : true , date : true } ,
                    // '.customer_mobile' : { required : true , digits : true , minlength : 10 , maxlength : 14 } ,
                    '.sub_total' : { required : true , number : true  } ,
                    '.discount' : { required : true , number : true } ,
                    '.vat_value' : { required : true , number : true } ,
                    '.delivery_cost' : { required : true , number : true } ,
                    '.total_due' : { required : true , number : true } ,
                },
                submitHandler : function (form) {
                    form.submit();
                }
            });


        });
    </script>


@endsection
