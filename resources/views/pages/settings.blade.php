@extends('layouts.master')
@section('pageTitle','الإعدادات')
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
                        <h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الإعدادات </span>
                    </div>
                </div>
            </div>
        <!-- breadcrumb -->

@endsection
@section('content')

        @include('layouts.alerts')

                <div class="card">
                    <div class="card-body">
                        <form class="form" id="creation_invoice_form" action="{{ route('settings.update' ) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf()
                            @method('POST')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">الأسم</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                                            placeholder="Naser Cars"  value="{{old('title', $setting->title)}}"  maxlength="60" >
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sub_title" class="form-label">الأسم الفرعي</label>
                                        <input type="text" class="form-control @error('sub_title') is-invalid @enderror" name="sub_title" id="sub_title"
                                            placeholder="..."  value="{{old('sub_title', $setting->sub_title)}}"  maxlength="255" >
                                        @error('sub_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">العنوان</label>
                                        <textarea type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                            placeholder="..." rows="3" maxlength="255" >{{old('address', $setting->address)}}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="about" class="form-label">حولنا</label>
                                        <textarea type="text" class="form-control @error('about') is-invalid @enderror" name="about" id="about"
                                            placeholder="..." rows="3" maxlength="255" >{{old('about', $setting->about)}}</textarea>
                                        @error('about')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="currency" class="form-label">العملة</label>
                                        <input type="text" class="form-control @error('currency') is-invalid @enderror" name="currency" id="currency"
                                            placeholder='جنية مصري'  value="{{old('currency', $setting->currency)}}"  maxlength="50" >
                                        @error('currency')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="currency_symbol" class="form-label">رمز العملة</label>
                                        <input type="text" class="form-control @error('currency_symbol') is-invalid @enderror" name="currency_symbol" id="currency_symbol"
                                            placeholder='ج.م'  value="{{old('currency_symbol', $setting->currency_symbol)}}"  maxlength="50" >
                                        @error('currency_symbol')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="latitude" class="form-label">خط الطول</label>
                                        <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude"
                                            placeholder="1111"  value="{{ $setting->latitude }}" maxlength="50">
                                        @error('latitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="longitude" class="form-label">خط العرض</label>
                                        <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude"
                                            placeholder="20000"  value="{{ $setting->longitude }}" maxlength="50">
                                        @error('longitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">الهاتف</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                                            placeholder="(011) 2345-6789"  value="{{old('phone', $setting->phone)}}"  maxlength="15" >
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">الموبيل</label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile"
                                            placeholder="(011) 2345-6789"  value="{{old('mobile', $setting->mobile)}}"  maxlength="15" >
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">البريد الإلكتروني</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                            placeholder="company@domin.com"  value="{{ old('email', $setting->email) }}" maxlength="100">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">الشعار</label>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo"
                                            placeholder="Upload Image" accept="image/png, image/jpg, image/jpeg" onchange="document.getElementById('previewLogo').src = window.URL.createObjectURL(this.files[0])">
                                        @error('logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class=" d-flex justify-content-center ">
                                        @if ($setting->logo)
                                            <img src="{{ asset('storage/images/'.$setting->logo) }}" alt="{{ $setting->title }}"   id="previewLogo" width="90" height="60" />
                                        @else
                                            <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" width="90" height="60" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="favicon" class="form-label">صورة مصغرة</label>
                                        <input type="file" class="form-control @error('favicon') is-invalid @enderror" id="favicon" name="favicon"
                                            placeholder="Upload Image" accept="image/png, image/jpg, image/jpeg" onchange="document.getElementById('previewFavicon').src = window.URL.createObjectURL(this.files[0])">
                                        @error('favicon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class=" d-flex justify-content-center ">
                                        @if ($setting->favicon)
                                            <img src="{{ asset('storage/images/'.$setting->favicon) }}" alt="{{ $setting->title }}"   id="previewFavicon" width="90" height="60" />
                                        @else
                                            <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" width="90" height="60" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">تحديث البيانات </button>
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
