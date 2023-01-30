@extends('layouts.master')
@section('pageTitle','التحصيلات')
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
					<div class="col-lg-12 col-md-12">
						<div class="card" id="basic-alert">
							<div class="card-body">
								<div class="text-wrap">
									<div class="example">
										<div class="panel panel-primary tabs-style-2">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">معلومات الإيصال</a></li>
														<li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">إيصالات الفاتورة</a></li>
														<li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">المرفقات</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
												<div class="tab-content">
													<div class="tab-pane active" id="tab1">
														<div class="table-responsive">
                                                            <table class="table table-striped" >
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">رقم الفاتورة</th>
                                                                        <td>{{ $installment->invoice->invoice_number }}</td>
                                                                        <th scope="row">تاريخ الاصدار</th>
                                                                        <td>{{ $installment->installment_date->format('d-m-Y') }}</td>
                                                                        <th scope="row">تاريخ السداد</th>
                                                                        <td>{{ $installment->payment_date->format('d-m-Y') }}</td>
                                                                        <th scope="row">حالة التحصيل</th>
                                                                        <td class="text-center {{ $installment->status == true ? 'text-success' : 'text-danger' }}">
                                                                            {{ $installment->status == true ?  'مفعل' : 'غير مفعل' }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">الموظف</th>
                                                                        <td>{{ $installment->employee->first_name }} {{ $installment->employee->middle_name }} {{ $installment->employee->last_name }}</td>
                                                                        <th scope="row">متبقي من الفاتورة</th>
                                                                        <td>{{ $installment->invoice_remaining }}</td>
                                                                        <th scope="row">المدفوع</th>
                                                                        <td>{{ ($installment->paid_amount) }}</td>
                                                                        <th scope="row">المتبقي</th>
                                                                        <td>{{ $installment->remaining_amount }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">العميل</th>
                                                                        <td>{{ $installment->invoice->customer->first_name }} {{ $installment->invoice->customer->middle_name }} {{ $installment->invoice->customer->last_name }}</td>
                                                                        <th scope="row">ملاحظات</th>
                                                                        <td colspan="6">{{ $installment->note }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
													</div>
													<div class="tab-pane" id="tab2">
														<div class="table-responsive">
                                                            <table class="table text-md-nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="wd-5p border-bottom-0 text-center">#</th>
                                                                        <th class="wd-10p border-bottom-0">رقم التحصيل</th>
                                                                        <th class="wd-15p border-bottom-0 text-center">تاريخ السداد</th>
                                                                        <th class="wd-15p border-bottom-0 text-center">متبقي من الفاتورة</th>
                                                                        <th class="wd-15p border-bottom-0 text-center">المدفوع</th>
                                                                        <th class="wd-15p border-bottom-0 text-center">المتبقي</th>
                                                                        <th class="wd-5p border-bottom-0 text-center">الحالة</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($installments as $installment)
                                                                        <tr>
                                                                            <td class="text-center">{{ $loop->iteration }}</td>
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
													</div>
													<div class="tab-pane" id="tab3">

                                                        <div class="card card-statistics">
                                                            <div class="card-body">
                                                                <p class="text-danger">* صيغة المرفق pdf, jpeg, jpg, png </p>
                                                                
                                                                <form method="post" action="{{ route('installment_attachments.store') }}" enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden"  id="invoice_id" name="invoice_id" value="{{ $installment->id }}">
                                                                    <div class="row mb-3">
                                                                        <div class="col-lg-1 col-md-1">
                                                                                <h5 class="card-title mt-1">اضافة مرفقات</h5>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6">
                                                                                <input type="text" name="name" id="name" class="form-control text-center" placeholder="صورة الإيصال" value="{{ old('name') }}" >
                                                                                @error('name')
                                                                                    <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-lg-2 col-md-2">
                                                                                <div class=" d-flex justify-content-center ">
                                                                                    <div class="form-check form-switch mt-1 ">
                                                                                        <label class="form-check-label" for="status">الحالة</label>
                                                                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" checked>
                                                                                        @error('status')
                                                                                            <span class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="mb-3">
                                                                                <input type="file" name="attachment" id="attachment" class="dropify form-control @error('attachment') is-invalid @enderror" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                                                                @error('attachment')
                                                                                    <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">أضافة</button>
                                                                </form>
                                                            </div>
                                                        </div>

														<div class="table-responsive">
                                                            <table class="table text-md-nowrap table-hover table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>أسم المرفق</th>
                                                                        <th>المرفق</th>
                                                                        <th>حالة المرفق</th>
                                                                        <th>التحكم</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @forelse ($installment->installment_attachments as $attachment)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ $attachment->name }}</td>
                                                                            <td>
                                                                                @if ($attachment->attachment)
                                                                                    @if (in_array(pathinfo($attachment->attachment, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg'])  )
                                                                                        <img src="{{ asset('storage/uploads/'.$attachment->attachment) }}" alt="{{ $attachment->name }}" width="100" style="max-width:100px; max-height:80px" />
                                                                                    @else
                                                                                        <img src="{{ asset('storage/images/file.png') }}" alt="file" width="100" style="max-width:100px; max-height:80px" />
                                                                                    @endif
                                                                                @else
                                                                                    <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" width="100" style="max-width:100px; max-height:80px" />
                                                                                @endif
                                                                            </td>
                                                                             <td class="text-center {{ $attachment->status == 1 ? 'text-success' : 'text-danger' }}">
                                                                                {{ $attachment->status == 1 ? 'مفعل' : 'غير مفعل'}}
                                                                            </td>
                                                                            <td>                                                                                      

                                                                                @if ($attachment->status == 0)
                                                                                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('installment_attachments.active',$attachment->id) }}" title="تفعيل"><i class="fas fa-lightbulb"></i></a>
                                                                                @else
                                                                                    <a class="btn btn-secondary btn-sm" href="{{ route('installment_attachments.deactive',$attachment->id) }}" title="إلغاء التفعيل"><i class="far fa-lightbulb"></i></a>
                                                                                @endif
                                                                                
                                                                                <a class="btn btn-info btn-sm" href="{{ asset('storage/uploads/'.$attachment->attachment) }}" target="_block" title="عرض"><i class="fas fa-solid fa-binoculars"></i></a>

                                                                                
                                                                                <form action="{{ route('installment_attachments.download') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                                                                    @csrf()
                                                                                    @method('POST')
                                                                                    <input type="hidden" value="{{ $attachment->id }}" name="id" id="id">
                                                                                    <input type="hidden" value="{{ $attachment->attachment }}" name="attachment" id="attachment">
                                                                                    <button type="submit" class="btn btn-success btn-sm tbtn" title="تنزيل" > <i class="fas fa-solid fa-file-download"></i>
                                                                                    </button>
                                                                                </form>  

                                                                                <a class="btn btn-sm btn-danger modal-effect" data-effect="effect-sign" data-toggle="modal" href="#delete_Modal" title="حذف"
                                                                                    data-id="{{ $attachment->id }}" data-name="{{ $attachment->name }}"  >
                                                                                        <i class="far fa-trash-alt"></i>
                                                                                </a>



                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                        <tr class="thead-light text-center">
                                                                            <td colspan="5">لا يوجد مرفقات</td>
                                                                        </tr>
                                                                    @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<!-- /row -->
                </div>
                

			</div>
			<!-- Container closed -->

            <!-- Start Delete Modal effects-->

            <div class="modal fade" id="delete_Modal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">حذف المرفق</h6>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('installment_attachments.delete') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                <input type="hidden" name="id" id="id" value="">
                                <input class="form-control" name="name" id="name" type="text" readonly>
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
        $('#delete_Modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        })
    </script>

<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
