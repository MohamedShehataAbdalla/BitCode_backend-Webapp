@extends('layouts.master')
@section('styles')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">العمليات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ بحث المنتجات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->


@endsection
@section('content')
				@include('layouts.alerts')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">
						<form action="{{ route('ecommerce') }}" method="post" id="searchForm">
							@csrf
							<div class="card">
								<div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">الفئات</div>
								<div class="card-body pb-0">
									<div class="form-group mt-2">
										<label class="form-label">الشركات</label>
										<select name="trademark" id="select-trademark_id" class="form-control  nice-select  custom-select">
											<option value="">--أختار--</option>
											@foreach ($trademarks as $trademark)
												<option value="{{ $trademark->id }}"  {{ isset($selected_trademark) && $selected_trademark == $trademark->id ? 'selected' : '' }}> {{ $trademark->name }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label class="form-label">الأقسام</label>
											@foreach ($sections as $section)
											<div class="p-1 d-flex align-items-center">
												<label class="rdiobox">
													<input type="radio" class="form-check-input" name="section" value="{{ $section->id }}" {{ isset($selected_section) && $selected_section == $section->id ? 'checked' : '' }}>
													<span class="mr-3">{{ $section->name }}</span>
												</label>
											</div>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label class="form-label">العلامات</label>
											@foreach ($tags as $tag)
											<div class="p-1 d-flex align-items-center">
												<label class="ckbox">
													<input type="checkbox" class="form-check-input" name="tags[]" value="{{ $tag->id }}" {{ isset($selected_tags) && in_array($tag->id, $selected_tags) ? 'checked' : '' }}>
													<span class="mr-3">{{ $tag->name }}</span>
												</label>
											</div>
											@endforeach
										</select>
									</div>
								</div>
								<div class="card-header border-bottom border-top pt-3 pb-3 mb-0 font-weight-bold text-uppercase">الفلتر</div>
								<div class="card-body">
									<div class="form-group mt-2">
										<label class="form-label">الوحدات</label>
										<select name="unit" id="select-unit_id" class="form-control  nice-select">
											<option value="">--أختار--</option>
											@foreach ($units as $unit)
												<option value="{{ $unit->id }}" {{ isset($selected_unit) && $selected_unit == $unit->id ? 'selected' : '' }}> {{ $unit->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="card-header border-bottom border-top pt-3 pb-3 mb-0 font-weight-bold text-uppercase">التسعير</div>
								<div class="py-2 px-3">
									<div class="p-1 mt-2">
										<label class="rdiobox">
											<input type="radio" class="form-check-input" name="price" value="price_0_500" {{ isset($selected_price) && $selected_price == 'price_0_500' ? 'checked' : '' }}>
											<span class="mr-3">أقل من -  500</span>
										</label>
										<label class="rdiobox">
											<input type="radio" class="form-check-input" name="price" value="price_501_2500" {{ isset($selected_price) && $selected_price == 'price_501_2500' ? 'checked' : '' }}>
											<span class="mr-3">501 - 2500</span>
										</label>
										<label class="rdiobox">
											<input type="radio" class="form-check-input" name="price" value="price_2501_6000" {{ isset($selected_price) && $selected_price == 'price_2501_6000' ? 'checked' : '' }}>
											<span class="mr-3">2501 - 6000</span>
										</label>
										<label class="rdiobox">
											<input type="radio" class="form-check-input" name="price" value="price_6001_12000" {{ isset($selected_price) && $selected_price == 'price_6001_12000' ? 'checked' : '' }}>
											<span class="mr-3">6001 - 12000</span>
										</label>
										<label class="rdiobox">
											<input type="radio" class="form-check-input" name="price" value="price_12001" {{ isset($selected_price) && $selected_price == 'price_12001' ? 'checked' : '' }}>
											<span class="mr-3">أكبر من - 12001</span>
										</label>
									</div>
									<button  type="submit" name="filtering" class="btn btn-primary-gradient mt-2 mb-2 pb-2">تصفية</button>
                    				<a href="{{ route('ecommerce') }}" class="btn btn-danger-gradient  mt-2 mb-2 pb-2 float-left">إعادة</a>
								</div>
							</div>
						</form>
					</div>
					<div class="col-xl-9 col-lg-9 col-md-12">
						<div class="card">
							<div class="card-body p-2">
								<div class="input-group">
									<input type="search" form="searchForm" name="keyword" value="{{ old('keyword', $keyword) }}" class="form-control" placeholder="كلمة البحث هنا ...">
									<span class="input-group-append">
										<button  type="submit" name="search"  form="searchForm" class="btn btn-primary">بحث</button>
									</span>
								</div>
							</div>
						</div>
						<div class="row row-sm">
							@forelse($products as $product)
								<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
									<div class="card">
										<div class="card-body">
											<div class="pro-img-box">
												<div class="d-flex product-sale">
													<div class="badge bg-pink">{{ $product->section->name ?? null }}</div>
													<i class="mdi  ml-auto wishlist {{ $product->status == true ? 'mdi-heart text-danger' : 'mdi-heart-outline' }}"></i>
												</div>
												<div class="text-center">
													@if ($product->image)
														<img src="{{ asset('storage/images/'.$product->image) }}" alt="{{ $product->name }}"  class="w-100" />
													@else
														<img src="{{ asset('storage/images/noImage.png') }}" alt="Empty"  class="w-100" />
													@endif
												</div>
												<a href="{{ route('ecommerce.show', $product->id ) }}" class="adtocart"> <i class="fab fa-osi"></i>
												{{-- <i class="las la-shopping-cart "></i> --}}
												</a>
											</div>
											<div class="text-center pt-3">
												<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">{{ $product->name }}</h3>
												<span class="tx-15 ml-auto">
													@if($product->trademark)
														@if ($product->trademark->image)
															<img src="{{ asset('storage/images/'.$product->trademark->image) }}" alt="{{ $product->trademark->name }}" style="height:45px" />
														@else
															{{ $product->trademark->name ?? null }}
														@endif
													@endif
												</span>
												<h4 class="h5 mb-2 mt-2 text-center font-weight-bold text-danger">ج.م {{ number_format((float)((float)$product->price - (float)$product->discount), 2,'.', '') }}
													<span class="text-secondary font-weight-normal tx-13 ml-1 prev-price {{ $product->discount == 0 ? 'd-none' : null}}">ج.م {{ $product->price }}</span>
												</h4>
												<div>
													@foreach($product->tags as $tag)
														<span class="badge" style="background-color:{{ $tag->color }}" >{{ $tag->name }}</span>
													@endforeach
												</div>
											</div>
										</div>
									</div>
								</div>
							@empty
								<div>لا توجد منتجات</div>
							@endforelse

						</div>
						<ul class="pagination product-pagination m-auto d-flex justify-content-center">
								{{ $products->appends(request()->input())->links() }}
						</ul>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('scripts')
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection
