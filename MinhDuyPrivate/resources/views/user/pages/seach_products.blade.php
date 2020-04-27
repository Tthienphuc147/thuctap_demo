@extends('user/layout/index')

@section('title')
Tìm kiếm sản phẩm - Phuc Store
@endsection
@section('css')
<style>
	#tu-khoa{
		color: red;
	}
</style>
@endsection

@section('content')
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Danh sách sản phẩm</li>
			</ul>
		</div>
	</div>
</div>
<!-- Bắt đầu phần nội dung loại sản phẩm -->
@if($san_pham_tim_kiem != null)
<div class="content-wraper pt-10 pb-10">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- shop-top-bar start -->
				<div class="shop-top-bar mt-30">
					<div class="shop-bar-inner">
						<div class="product-view-mode">
							<!-- shop-item-filter-list start -->
							<ul class="nav shop-item-filter-list" role="tablist">
								<li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
							</ul>
							<!-- shop-item-filter-list end -->
						</div>
						<div class="toolbar-amount">
							<span>Tìm thấy <b>{{count($san_pham_tim_kiem)}}</b> sản phẩm.</span>
						</div>
					</div>
				</div>
				<!-- shop-top-bar end -->
				<!-- shop-products-wrapper start -->
				<div class="shop-products-wrapper">
					<div class="tab-content">
						<div id="grid-view" class="tab-pane fade active show" role="tabpanel">
							<div class="product-area shop-product-area">
								<div class="row">
									@if(count($san_pham_tim_kiem) != 0)
									@foreach($san_pham_tim_kiem as $sptl)
									<div class="col-lg-3 col-md-4 col-sm-6 mt-40">
										<!-- single-product-wrap start -->
										<div class="single-product-wrap">
											<div class="product-image">
												@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
												@foreach($share_sp_toan_bo_hinh_anh_chinh as $ssptbhac)
												@if($ssptbhac->id_sp == $sptl->id)
												<a href="single-product.html">
													<img src="uploads/images/products/{{$ssptbhac->ten}}" alt="{{$sptl->mo_ta}}">
												</a>
												@break
												@endif
												@endforeach
												@else
												<a href="single-product.html">
													<img src="https://via.placeholder.com/300x300" alt="{{$sptl->mo_ta}}">
												</a>
												@endif

												@if($sptl->moi > 0)
												<span class="sticker">Mới</span>
												@endif
											</div>
											<div class="product_desc">
												<div class="product_desc_info">
													<h4><a class="product_name" href="single-product.html">{{$sptl->ten}}</a></h4>
													@if($sptl->khuyen_mai != 0)
													<div class="price-box">
														<span class="new-price new-price-2">{{number_format($sptl->gia_ban)}}₫</span>
														<span class="old-price">{{number_format($sptl->gia_goc)}}₫</span>
													</div>
													@else
													<div class="price-box">
														<span class="new-price">{{number_format($sptl->gia_goc)}}₫</span>
													</div>
													@endif
												</div>
												<div class="add-actions">
													<ul class="add-actions-link">
                                                        @if ($sptl->so_luong == 0)
                                                        <li class="add-cart active"><a href="javascript:void(0)" onclick="hethang()">Hết hàng</a></li>
                                                        @else
                                                        <li class="add-cart active"><a href="shopping-cart.html">Thêm giỏ hàng</a></li>
                                                        @endif

													</ul>
												</div>
											</div>
										</div>
										<!-- single-product-wrap end -->
									</div>
									@endforeach
									@else
									<div class="col-md-12">
										<div class="error404-area pt-30 pb-60">
											<div class="container">
												<div class="error-wrapper text-center ptb-50 pt-xs-20">
													<div class="error-text">
														<h2>Không tìm thấy sản phẩm nào</h2>
														<p>Xin lỗi! Không tìm thấy sản phẩm nào phù hợp với yêu cầu của bạn</p>
													</div>
													<div class="error-button">
														<a href="trang-chu.html">Quay lại trang chủ</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif
								</div>
							</div>
						</div>
						<div class="paginatoin-area">
							<div class="row">
								<div class="col-lg-12 col-md-12">
									@if ($san_pham_tim_kiem->lastPage() > 1)
									<ul class="pagination-box pt-xs-20 pb-xs-15">
										@if($san_pham_tim_kiem->currentPage() > 1)
										<li><a href="{{ $san_pham_tim_kiem->url(1) }}" class="Previous">Đầu</a>
										</li>
										<li><a href="{{ $san_pham_tim_kiem->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i></a>
										</li>
										@endif

										<?php
										$max_paginate = $san_pham_tim_kiem->lastPage();
										$current_page = $san_pham_tim_kiem->currentPage();
										?>

										@if($current_page - 1 > 1)
										<span>...</span>
										@endif

										@for ($i = 1; $i <= $san_pham_tim_kiem->lastPage(); $i++)
										@if(($i == $current_page) || ($i == $current_page + 1) || ($i == $current_page - 1))
										<li class="{{ ($san_pham_tim_kiem->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $san_pham_tim_kiem->url($i) }}">{{$i}}</a></li>
										@endif
										@endfor

										@if($current_page + 1 < $max_paginate)
										<span>...</span>
										@endif

										@if ($san_pham_tim_kiem->hasMorePages())
										<li>
											<a href="{{ $san_pham_tim_kiem->nextPageUrl() }}" class="Next"><i class="fa fa-chevron-right"></i></a>
										</li>
										<li><a href="{{ $san_pham_tim_kiem->url($san_pham_tim_kiem->lastPage()) }}" class="Previous">Cuối</a>
										</li>
										@endif
									</ul>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- shop-products-wrapper end -->
			</div>
		</div>
	</div>
</div>
@else
<div class="error404-area pt-30 pb-60">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="error-wrapper text-center ptb-50 pt-xs-20">
					<div class="error-text">
						<h1>404</h1>
						<h2>KHÔNG TÌM THẤY YÊU CẦU</h2>
						<p>Xin lỗi! Không tìm thấy sản phẩm phù hợp với yêu cầu của bạn.</p>
					</div>
					<div class="error-button">
						<a href="trang-chu.html">Quay lại trang chủ</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<!-- Kết thúc phần nội dung loại sản phẩm -->
@endsection

@section('javascript')
<script>
</script>
@endsection
