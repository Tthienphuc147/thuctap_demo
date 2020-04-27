@extends('user/layout/index')

@section('title')
Loại sản phẩm - Phuc Store
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">{{$danh_muc_theo_id->ten}}</li>
			</ul>
		</div>
	</div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60 pt-sm-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 order-1 order-lg-2">
				<!-- Begin Li's Banner Area -->
				<div class="single-banner shop-page-banner">
					<a href="sanpham">
						<img src="user/assets/images/bg-banner/2.jpg" alt="Li's Static Banner">
					</a>
				</div>
				<!-- Li's Banner Area End Here -->
				<!-- shop-top-bar start -->
				<div class="shop-top-bar mt-30">
					<div class="shop-bar-inner">
						<div class="product-view-mode">
							<!-- shop-item-filter-list start -->
							<ul class="nav shop-item-filter-list" role="tablist">
								<li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
								<li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
							</ul>
							<!-- shop-item-filter-list end -->
						</div>
						@if ($tat_ca_san_pham_theo_danh_muc->lastPage() > 1)
						<?php
						$trang_dau = $tat_ca_san_pham_theo_danh_muc->currentPage();
						$trang_cuoi = $tat_ca_san_pham_theo_danh_muc->currentPage();
						$tong_trang = $tat_ca_san_pham_theo_danh_muc->lastPage();
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
					<!-- product-select-box start -->
					<div class="product-select-box">
						<div class="product-short">
							<p>Lọc theo:</p>
							<?php $ten_khong_dau = changeTitle($danh_muc_theo_id->ten); ?>
							<select class="nice-select" onchange="locSanPham(this.value, {{$danh_muc_theo_id->id}}, '{{$ten_khong_dau}}')">
								<option value="0">Lựa chọn</option>
								<option value="1">Tên (A - Z)</option>
								<option value="2">Tên (Z - A)</option>
								<option value="3">Giá (thấp &gt; cao)</option>
								<option value="4">Giá (cao &gt; thấp)</option>
							</select>
						</div>
					</div>
					<!-- product-select-box end -->
				</div>
				<!-- shop-top-bar end -->
				<!-- shop-products-wrapper start -->
				<div class="shop-products-wrapper">
					<div class="tab-content">
						<div id="grid-view" class="tab-pane fade active show" role="tabpanel">
							<div class="product-area shop-product-area">
								<div class="row">
									@if(count($tat_ca_san_pham_theo_danh_muc) != 0)
									@foreach($tat_ca_san_pham_theo_danh_muc as $tcsptdm)
									<div class="col-lg-4 col-md-4 col-sm-6 mt-40">
										<!-- Bắt đầu menu sản phẩm -->
										<div class="single-product-wrap">
											<div class="product-image">
												@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
												@foreach($share_sp_toan_bo_hinh_anh_chinh as $ssptbhac)
												@if($ssptbhac->id_sp == $tcsptdm->id)
												<a href="san-pham/{{changeTitle($tcsptdm->ten)}}-a{{$tcsptdm->id}}.html">
													<img src="uploads/images/products/{{$ssptbhac->ten}}" alt="{{$tcsptdm->mo_ta}}">
												</a>
												@break
												@endif
												@endforeach
												@else
												<a href="san-pham/{{changeTitle($tcsptdm->ten)}}-a{{$tcsptdm->id}}.html">
													<img src="https://via.placeholder.com/300x300" alt="{{$tcsptdm->mo_ta}}">
												</a>
												@endif

												@if($tcsptdm->moi == 1)
												<span class="sticker">Mới</span>
												@endif
											</div>
											<div class="product_desc">
												<div class="product_desc_info">
													<h4><a class="product_name" href="sanpham">{{$tcsptdm->ten}}</a></h4>
													@if($tcsptdm->khuyen_mai != 0)
													<div class="price-box">
														<span class="new-price new-price-2">{{number_format($tcsptdm->gia_ban)}}₫</span>
														<span class="old-price">{{number_format($tcsptdm->gia_goc)}}₫</span>
													</div>
													@else
													<div class="price-box">
														<span class="new-price">{{number_format($tcsptdm->gia_goc)}}₫</span>
													</div>
													@endif

												</div>
												<div class="add-actions">
													<ul class="add-actions-link">
														<li class="add-cart active"><a href="javascript:void(0)" onclick="themGioHang({{$tcsptdm->id}})">Thêm giỏ hàng</a></li>
														<li><a class="links-details" href="javascript:void(0)" onclick="themSpYeuThich({{$tcsptdm->id}})"><i class="fa fa-heart-o"></i></a></li>
														<li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#xemnhanhsanpham{{$tcsptdm->id}}"><i class="fa fa-eye"></i></a></li>
													</ul>
												</div>
											</div>
										</div>
										<!-- Kết thúc menu sản phẩm -->
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
						<div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
							<div class="row">
								<div class="col">
									@if(count($tat_ca_san_pham_theo_danh_muc) != 0)
									@foreach($tat_ca_san_pham_theo_danh_muc as $tcsptdm)
									<div class="row product-layout-list">
										<div class="col-lg-3 col-md-5 ">
											<div class="product-image">
												@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
												@foreach($share_sp_toan_bo_hinh_anh_chinh as $ssptbhac)
												@if($ssptbhac->id_sp == $tcsptdm->id)
												<a href="san-pham/{{changeTitle($tcsptdm->ten)}}-a{{$tcsptdm->id}}.html">
													<img src="uploads/images/products/{{$ssptbhac->ten}}" alt="{{$tcsptdm->mo_ta}}">
												</a>
												@break
												@endif
												@endforeach
												@else
												<a href="san-pham/{{changeTitle($tcsptdm->ten)}}-a{{$tcsptdm->id}}.html">
													<img src="https://via.placeholder.com/300x300" alt="{{$tcsptdm->mo_ta}}">
												</a>
												@endif
												@if($tcsptdm->moi == 1)
												<span class="sticker">Mới</span>
												@endif
											</div>
										</div>
										<div class="col-lg-5 col-md-7">
											<div class="product_desc">
												<div class="product_desc_info">
													<h4><a class="product_name" href="san-pham/{{changeTitle($tcsptdm->ten)}}-a{{$tcsptdm->id}}.html">{{$tcsptdm->ten}}</a></h4>
													@if($tcsptdm->khuyen_mai != 0)
													<div class="price-box">
														<span class="new-price new-price-2">{{number_format($tcsptdm->gia_ban)}}₫</span>
														<span class="old-price">{{number_format($tcsptdm->gia_goc)}}₫</span>
													</div>
													@else
													<div class="price-box">
														<span class="new-price">{{number_format($tcsptdm->gia_goc)}}₫</span>
													</div>
													@endif
													<p><?php echo limitStrlen($tcsptdm->mo_ta, 300); ?></p>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="shop-add-action mb-xs-30">
												<ul class="add-actions-link">
													<li class="add-cart"><a href="javascript:void(0)" onclick="themGioHang({{$tcsptdm->id}})">Thêm giỏ hàng</a></li>
													<li class="wishlist"><a class="view-list-product" href="javascript:void(0)" onclick="themSpYeuThich({{$tcsptdm->id}})"><i class="fa fa-heart-o"></i>Thêm yêu thích</a></li>
													<li><a class="quick-view view-list-product" data-toggle="modal" data-target="#xemnhanhsanpham{{$tcsptdm->id}}" href="#"><i class="fa fa-eye"></i>Quick view</a></li>
												</ul>
											</div>
										</div>
									</div>
									@endforeach
									@else
									<div class="col-md-12">
										<div class="error404-area pt-30 pb-60">
											<div class="container">
												<div class="error-wrapper text-center ptb-50 pt-xs-20">
													<div class="error-text">
														<h2>Không tìm thấy sản phẩm nào</h2>
														<p>Xin lỗi! Không tìm thấy sản phẩm nào phù hợp với yêu cầu của bạn.</p>
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

						@if ($tat_ca_san_pham_theo_danh_muc->lastPage() > 1)
						<div class="paginatoin-area">
							<div class="row">
								<div class="col-lg-12 col-md-12">
									<ul class="pagination-box pt-xs-20 pb-xs-15">
										@if($tat_ca_san_pham_theo_danh_muc->currentPage() > 1)
										<li><a href="{{ $tat_ca_san_pham_theo_danh_muc->url(1) }}" class="Previous">Đầu</a>
										</li>
										<li><a href="{{ $tat_ca_san_pham_theo_danh_muc->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i></a>
										</li>
										@endif

										<?php
										$max_paginate = $tat_ca_san_pham_theo_danh_muc->lastPage();
										$current_page = $tat_ca_san_pham_theo_danh_muc->currentPage();
										?>

										@if($current_page - 1 > 1)
										<span>...</span>
										@endif

										@for ($i = 1; $i <= $tat_ca_san_pham_theo_danh_muc->lastPage(); $i++)
										@if(($i == $current_page) || ($i == $current_page + 1) || ($i == $current_page - 1))
										<li class="{{ ($tat_ca_san_pham_theo_danh_muc->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $tat_ca_san_pham_theo_danh_muc->url($i) }}">{{$i}}</a></li>
										@endif
										@endfor

										@if($current_page + 1 < $max_paginate)
										<span>...</span>
										@endif

										@if ($tat_ca_san_pham_theo_danh_muc->hasMorePages())
										<li>
											<a href="{{ $tat_ca_san_pham_theo_danh_muc->nextPageUrl() }}" class="Next"><i class="fa fa-chevron-right"></i></a>
										</li>
										<li><a href="{{ $tat_ca_san_pham_theo_danh_muc->url($tat_ca_san_pham_theo_danh_muc->lastPage()) }}" class="Previous">Cuối</a>
										</li>
										@endif
									</ul>
								</div>
							</div>
						</div>
						@endif

					</div>
				</div>
				<!-- shop-products-wrapper end -->
			</div>
			<div class="col-lg-3 order-2 order-lg-1">
				@if(count($all_share_danh_muc_san_pham) >= 2)
				<!--Bắt đầu các danh mục liên quan  -->
				<div class="sidebar-categores-box mt-sm-30 mt-xs-30">
					<div class="sidebar-title">
						<h2><center><b>Danh mục khác</b></center></h2>

					</div>

					<div class="category-sub-menu">
						<ul>
							<?php $count_max = 0; ?>
							@foreach($share_sp_danh_muc_san_pham_ngau_nhien as $sspdmspnn)
							@if($count_max < 3)
							@if($danh_muc_theo_id->id != $sspdmspnn->id)
							<li class="has-sub"><a href="# ">{{$sspdmspnn->ten}}</a>
								<ul>
									@foreach($muoi_loai_san_pham_ngau_nhien as $mlspnn)
									@if($mlspnn->id_danh_muc_sp == $sspdmspnn->id)
									<li><a href="loai-san-pham/{{changeTitle($mlspnn->ten)}}-a{{$mlspnn->id}}.html">{{$mlspnn->ten}}</a></li>
									@endif
									@endforeach
								</ul>
							</li>
							<?php $count_max++; ?>
							@endif
							@else
							@break
							@endif
							@endforeach
						</ul>
					</div>
				</div>
				<!--Kết thúc các danh mục liên quan  -->
				@endif
				<!--sidebar-categores-box start  -->
				<div class="sidebar-categores-box">
					<div class="sidebar-title">
						<h2><center><b>Thể loại liên quan</b></center></h2>
					</div>
					@if(count($all_share_danh_muc_san_pham))
					<!-- Bắt đầu thể loại sản phẩm liên quan -->
					@foreach($all_share_danh_muc_san_pham as $asdmsp)
					@if($danh_muc_theo_id->id == $asdmsp->id)
					<div class="filter-sub-area">
						<h5 class="filter-sub-titel">{{$asdmsp->ten}}</h5>
						<div class="categori-checkbox">
							<form action="#">
								<ul>
									@foreach($all_share_loai_san_pham as $aslsp)
									@if($asdmsp->id == $aslsp->id_danh_muc_sp)
									<?php $count_quantty = 0; ?>
									@foreach($share_sp_toan_bo as $tcsp)
									@if($tcsp->id_loai_sp == $aslsp->id)
									<?php $count_quantty++; ?>
									@endif
									@endforeach
									@if($count_quantty > 0)
									<li><input type="checkbox" name="product-categori"><a href="loai-san-pham/{{changeTitle($aslsp->ten)}}-a{{$aslsp->id}}.html">{{$aslsp->ten}} ({{$count_quantty}})</a></li>
									@endif
									@endif
									@endforeach
								</ul>
							</form>
						</div>
					</div>
					@break
					@endif
					@endforeach
					<!-- Kết thúc thể loại sản phẩm liên quan -->
					@endif
				</div>
				<!--sidebar-categores-box end  -->
				@if(count($all_share_tu_khoa) > 1)
				<!-- Bắt đầu từ khóa thông dụng -->
				<?php $tu_khoa_random = array_rand($all_share_tu_khoa, count($all_share_tu_khoa) / 2);
				$dem = 1;
				?>
				<div class="sidebar-categores-box mb-sm-0 mb-xs-0">
					<div class="sidebar-title">
						<h2><center><b>Sản phẩm thông dụng</b></center></h2>
					</div>
					<div class="category-tags">
						<ul>
							@foreach($tu_khoa_random as $key)
							@if($all_share_tu_khoa[$key] != "")
							<li><a href="tim-kiem.html?tu_khoa={{$all_share_tu_khoa[$key]}}">{{$all_share_tu_khoa[$key]}}</a></li>
							@endif
							@if($dem > 20)
							@break
							@endif
							<?php $dem++; ?>
							@endforeach
						</ul>
					</div>
				</div>
				<!-- Kết thúc từ khóa thông dụng -->
				@endif
			</div>
		</div>
	</div>
</div>
<!-- Content Wraper Area End Here -->
@endsection

@section('script')
<script>
	function locSanPham(status, id_danh_muc, ten_danh_muc){
		if(status != 0){
			window.location.href = 'loc-danh-muc-san-pham/'+ten_danh_muc+'-a'+id_danh_muc+'b'+status+'.html';
		}
	}
</script>
@endsection
