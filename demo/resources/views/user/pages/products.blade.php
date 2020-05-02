@extends('user/layout/index')

@section('title')
Mọi sản phẩm - Phuc Store
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
@if($toan_bo_san_pham != null)
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
                        @if ($toan_bo_san_pham->lastPage() > 1)
						<?php
						$trang_dau = $toan_bo_san_pham->currentPage();
						$trang_cuoi = $toan_bo_san_pham->currentPage();
						$tong_trang = $toan_bo_san_pham->lastPage();
						if($trang_dau > 1){
							$trang_dau--;
						}
						if($trang_cuoi < $tong_trang){
							$trang_cuoi++;
						}
						?>
						<div class="toolbar-amount">
							<span>Hiển thị từ {{$trang_dau}} đến {{$trang_cuoi}} trên <b>{{$tong_trang}}</b> trang</span>
						</div>
						@endif
                    </div>
                </div>
                <!-- shop-top-bar end -->
                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    @if(count($toan_bo_san_pham) != 0)
                                    @foreach($toan_bo_san_pham as $sptl)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mt-60">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                            @if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
												@foreach($share_sp_toan_bo_hinh_anh_chinh as $ssptbhac)
												@if($ssptbhac->id_sp == $sptl->id)
												<a href="san-pham/{{changeTitle($sptl->ten)}}-a{{$sptl->id}}.html">
													@if ($sptl->so_luong == 0)
													<img src="/user/assets/images/soldout.png" alt="" class="soldout--image">
													@endif
													<img src="uploads/images/products/{{$ssptbhac->ten}}" alt="{{$sptl->mo_ta}}">
												</a>
												@break
												@endif
												@endforeach
												@else
												<a href="san-pham/{{changeTitle($sptl->ten)}}-a{{$sptl->id}}.html">
													@if ($sptl->so_luong == 0)
													<img src="/user/assets/images/soldout.png" alt="" class="soldout--image">
													@endif
													<img src="https://via.placeholder.com/300x300" alt="{{$sptl->mo_ta}}">
												</a>
												@endif

                                                @if($sptl->moi > 0)
                                                <span class="sticker">Mới</span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <h4><a class="product_name" href="san-pham/{{changeTitle($sptl->ten)}}-a{{$sptl->id}}.html">{{$sptl->ten}}</a></h4>
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
                                                        <li class="add-cart active"><a href="javascript:void(0)" onclick="themGioHang({{$sptl->id}})">Thêm giỏ hàng</a></li>
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
									@if ($toan_bo_san_pham->lastPage() > 1)
									<ul class="pagination-box pt-xs-20 pb-xs-15">
										@if($toan_bo_san_pham->currentPage() > 1)
										<li><a href="{{ $toan_bo_san_pham->url(1) }}" class="Previous">Đầu</a>
										</li>
										<li><a href="{{ $toan_bo_san_pham->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i></a>
										</li>
										@endif

										<?php
										$max_paginate = $toan_bo_san_pham->lastPage();
										$current_page = $toan_bo_san_pham->currentPage();
										?>

										@if($current_page - 1 > 1)
										<span>...</span>
										@endif

										@for ($i = 1; $i <= $toan_bo_san_pham->lastPage(); $i++)
										@if(($i == $current_page) || ($i == $current_page + 1) || ($i == $current_page - 1))
										<li class="{{ ($toan_bo_san_pham->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $toan_bo_san_pham->url($i) }}">{{$i}}</a></li>
										@endif
										@endfor

										@if($current_page + 1 < $max_paginate)
										<span>...</span>
										@endif

										@if ($toan_bo_san_pham->hasMorePages())
										<li>
											<a href="{{ $toan_bo_san_pham->nextPageUrl() }}" class="Next"><i class="fa fa-chevron-right"></i></a>
										</li>
										<li><a href="{{ $toan_bo_san_pham->url($toan_bo_san_pham->lastPage()) }}" class="Previous">Cuối</a>
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
