@extends('layouts.master')
@section('styles')
<!--Internal  Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
								<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">العمليات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تفاصيل المنتج</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body h-100">
								<div class="row row-sm ">
									<div class=" col-xl-5 col-lg-12 col-md-12">
										<div class="preview-pic tab-content">
										  <div class="tab-pane active" id="pic-1">
										  	@if ($product->image)
												<img src="{{ asset('storage/images/'.$product->image) }}" alt="{{ $product->name }}" />
											@else
												<img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" />
											@endif
										  </div>
										</div>
									</div>
									<div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
										<h4 class="product-title mb-1">{{ $product->name }}</h4>
										<p class="text-muted tx-13 mb-1">{{ $product->barcode }}</p>
										<span class="text-danger font-weight-normal tx-13 ml-1 prev-price {{ $product->discount == 0 ? 'd-none' : null}}"> {{ $product->price }} ج.م </span>
										<h6 class="price">السعر الحالي: <span class="h3 ml-2">{{ number_format((float)((float)$product->price - (float)$product->discount), 2,'.', '') }} ج.م </span></h6>
										
										<p class="product-description">{{ $product->description }}</p>
										<p class="product-description">{{ $product->section->name ?? null }}</p>
										<span class="tx-15 ml-auto">
											@if($product->trademark)
												@if ($product->trademark->image)
													<img src="{{ asset('storage/images/'.$product->trademark->image) }}" alt="{{ $product->trademark->name }}" style="height:45px" />
												@else
													{{ $product->trademark->name ?? null }}
												@endif
											@endif
										</span>
										<div  class=" ">
											@foreach($product->tags as $tag)
												<span class="badge" style="background-color:{{ $tag->color }}" >{{ $tag->name }}</span>
											@endforeach
										</div>
										<div class="d-flex  mt-2">
											<div class="mt-2 product-title">الكمية:</div>
											<div class="d-flex ml-2">
												<ul class=" mb-0 qunatity-list">
													<li>
														<div class="form-group">
															<select name="quantity" id="select-countries17" class="form-control nice-select wd-100">
																@for ($i = 1; $i <= 100; $i++)
																	<option value="{{$i}}" {{ $i == 1 ? 'selected' : null }} >{{$i}}</option>
																@endfor
															</select>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="action">
											{{-- <button class="add-to-cart btn btn-danger" type="button">أضف إلى قائمة الامنيات</button> --}}
											<button  type="button" class="add-to-cart btn btn-success"><i class="fa fa-shopping-cart"></i> أضف إلي السلة </button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					@foreach($suggested_products as $suggested_product)
						<div class="col-lg-3">
							<div class="card item-card">
								<div class="card-body pb-0 h-100">
									<div class="text-center">
										@if ($suggested_product->image)
											<img src="{{ asset('storage/images/'.$suggested_product->image) }}" alt="{{ $suggested_product->name }}" class="img-fluid" />
										@else
											<img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" class="img-fluid" />
										@endif
									</div>
									<div class="card-body cardbody relative">
										<div class="cardtitle">
											<span>{{ $suggested_product->section->name }}</span>
											<a href="{{ route('ecommerce.show', $suggested_product->id ) }}">{{ $suggested_product->name }}</a>
										</div>
										<div class="cardprice">
											<span class="type--strikethrough"> {{ $suggested_product->price }} </span>
											<span>{{ number_format((float)((float)$suggested_product->price - (float)$suggested_product->discount), 2,'.', '') }}</span>
										</div>
									</div>
								</div>
								<div class="text-center border-top pt-3 pb-3 pl-2 pr-2 ">
									<a href="#" class="btn btn-primary"> عرض التفاصيل</a>
									<a href="#" class="btn btn-success"><i class="fa fa-shopping-cart"></i>  أضف إلي السلة </a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-4 col-xs-12 col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="feature2">
									<i class="mdi mdi-airplane-takeoff bg-purple ht-50 wd-50 text-center brround text-white"></i>
								</div>
								<h5 class="mb-2 tx-16">الشحن مجانا</h5>
								<span class="fs-14 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua domenus orioneu.</span>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-xl-4 col-xs-12 col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="feature2">
									<i class="mdi mdi-headset bg-pink  ht-50 wd-50 text-center brround text-white"></i>
								</div>
								<h5 class="mb-2 tx-16">دعم العملاء</h5>
								<span class="fs-14 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua domenus orioneu.</span>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-xl-4 col-xs-12 col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="feature2">
									<i class="mdi mdi-refresh bg-teal ht-50 wd-50 text-center brround text-white"></i>
								</div>
								<div class="icon-return"></div>
								<h5 class="mb-2  tx-16">30 يومًا لاسترداد الأموال</h5>
								<span class="fs-14 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua domenus orioneu.</span>
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
@section('scripts')
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection