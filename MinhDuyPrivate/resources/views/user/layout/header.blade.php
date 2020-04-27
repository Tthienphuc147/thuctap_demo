<!-- Begin Header Area -->
<header>
	<!-- Begin Header Top Area -->
	<div class="header-top">
		<div class="container">
			<div class="row">
				<!-- Begin Header Top Left Area -->
				<div class="col-lg-3 col-md-4">
					<div class="header-top-left">
						<ul class="phone-wrap">
							<li><b><span>Điện thoại: </span><a href="tel:+ {{preg_replace('/\s+/', '',$all_share_sp_cai_dat_trang_chu->dien_thoai)}}"><i class="fa fa-mobile" aria-hidden="true"></i> {{$all_share_sp_cai_dat_trang_chu->dien_thoai}}</a></b></li>
						</ul>
					</div>
				</div>
				<!-- Header Top Left Area End Here -->
				<!-- Begin Header Top Right Area -->
				<div class="col-lg-9 col-md-8">
					<div class="header-top-right">
						<ul class="ht-menu">
							<!-- Begin Setting Area -->
							<li>
								@if(Auth::guard('web')->check())
								<div class="ht-setting-trigger"> <i id="font_online_user" class="fa fa-user-circle-o"></i><span id="view_name_user"> {{Auth::guard('web')->user()->display_name}}</span></div>
								<div class="setting ht-setting">
									<ul class="ht-setting-list">
										@if(Auth::guard('web')->user()->role != 'fb')
										<li><a href="thong-tin-tai-khoan.html">Tài khoản</a></li>
										@endif
										<li><a href="dangxuat">Đăng xuất</a></li>
									</ul>
								</div>
								@else
								<div style="cursor: pointer;"><span onclick='location.href="dang-nhap"'><i class="fa fa-key" aria-hidden="true"></i> Đăng nhập</span></div>
								@endif
							</li>
							<!-- Setting Area End Here -->
							<!-- Begin Currency Area -->
							<li>
								<span class="currency-selector-wrapper">Tiền tệ :</span>
								<div class="ht-currency-trigger"><span>VNĐ $</span></div>
								<div class="currency ht-currency">
									<ul class="ht-setting-list">
										<li><a href="#">VNĐ $</a></li>
									</ul>
								</div>
							</li>
							<!-- Currency Area End Here -->
							<!-- Begin Language Area -->
							<li>
								<span class="language-selector-wrapper">Ngôn ngữ :</span>
								<div class="ht-language-trigger"><span>Việt Nam</span></div>
								<div class="language ht-language">
									<ul class="ht-setting-list">
										<li><a href="#"><img src="user/assets/images/menu/flag-icon/vietnam.png" alt="">Việt Nam</a></li>
									</ul>
								</div>
							</li>
							<!-- Language Area End Here -->
						</ul>
					</div>
				</div>
				<!-- Header Top Right Area End Here -->
			</div>
		</div>
	</div>
	<!-- Header Top Area End Here -->
	<!-- Begin Header Middle Area -->
	<div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
		<div class="container">
			<div class="row">
				<!-- Begin Header Logo Area -->
				<div class="col-lg-3">
					<div class="logo pb-sm-30 pb-xs-30">
						<a href="trang-chu.html">
							<img src="user/assets/images/menu/logo/logo.png" alt="logo-dai-dien">
						</a>
					</div>
				</div>
				<!-- Header Logo Area End Here -->
				<!-- Begin Header Middle Right Area -->
				<div class="col-lg-9">
					<!-- Begin Header Middle Searchbox Area -->
					<form action="tim-kiem.html" class="hm-searchbox" method="get">

						<select class="nice-select select-search-category" onchange="location.href= 'loai-san-pham/tim-kiem-a'+this.value+'.html' ">
							<option value="0" disabled selected>Lựa chọn</option>
							@if(count($all_share_loai_san_pham) != 0)
							@foreach($all_share_loai_san_pham as $all_lsp)
							<option value="{{$all_lsp->id}}">{{$all_lsp->ten}}</option>
							@endforeach
							@endif
						</select>
						<input name="tu_khoa" type="text" placeholder="Nhập từ khóa cần tìm ...">
						<button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
					<!-- Header Middle Searchbox Area End Here -->
					<!-- Begin Header Middle Right Area -->
					<div class="header-middle-right">
						<ul class="hm-menu">
							<!-- Bắt đầu giỏ hàng -->
							<li class="hm-minicart">
								<div class="hm-minicart-trigger">
									<span class="item-icon"></span>
									<span class="item-text"><i class="fa fa-eye" aria-hidden="true"></i>
										@if(Session::has('gio_hang_hien_tai'))
										<span id="so_luong_gio_hang" class="cart-item-count">{{Session::get('gio_hang_hien_tai')->tong_so_luong}}</span>
										@else
										<span id="so_luong_gio_hang" class="cart-item-count">0</span>
										@endif
									</span>
								</div>
								<span></span>
								<div class="minicart" id="hien_thi_gio_hang">
									<ul class="minicart-product-list">
										@if(Session::has('gio_hang_hien_tai'))
										<?php $gio_hang = Session::get('gio_hang_hien_tai')->san_phams; ?>
										@foreach($gio_hang as $gh => $san_pham)
										<?php $sl = $san_pham['so_luong']; ?>
										@foreach($san_pham as $sp => $item)
										@if($sp == 'san_pham')
										<li>
											<a href="san-pham/{{changeTitle($item->ten)}}-a{{$item->id}}.html" class="minicart-product-image">
												@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
												@foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp)
												@if($tbhasp->id_sp == $item->id)
												<img src="uploads/images/products/{{$tbhasp->ten}}" alt="{{$item->ten}}">
												@endif
												@endforeach
												@endif
											</a>
											<div class="minicart-product-details">
												<h6><a href="san-pham/{{changeTitle($item->ten)}}-a{{$item->id}}.html">{{$item->ten}}</a></h6>
												<span>{{number_format($item->gia_ban)}}₫ x {{$sl}} </span>
											</div>
											<button class="close" onclick="xoaMotGioHang({{$item->id}})">
												<i class="fa fa-close"></i>
											</button>
										</li>
										@endif
										@endforeach
										@endforeach
										@endif
									</ul>
									@if(Session::has('gio_hang_hien_tai'))
									<p class="minicart-total">Tổng: <span>{{number_format(Session::get('gio_hang_hien_tai')->tong_gia)}}₫</span></p>
									<div class="minicart-button">
										<a href="gio-hang.html" class="li-button li-button-dark li-button-fullwidth li-button-sm">
											<span>Xem giỏ hàng</span>
										</a>
										<a href="dat-hang.html" class="li-button li-button-fullwidth li-button-sm">
											<span>Thanh toán</span>
										</a>
									</div>
									@else
									<p class="minicart-total">Tổng: <span>0₫</span></p>
									@endif
								</div>
							</li>
							<!-- Kết thúc giỏ hàng -->
						</ul>
					</div>
					<!-- Header Middle Right Area End Here -->
				</div>
				<!-- Header Middle Right Area End Here -->
			</div>
		</div>
	</div>
	<!-- Header Middle Area End Here -->
	<!-- Begin Header Bottom Area -->
	<div class="header-bottom header-sticky stick d-none d-lg-block d-xl-block">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Begin Header Bottom Menu Area -->
					<div class="hb-menu hb-menu-2">
						<nav>
							<ul>
								<li><a href="trang-chu.html">Trang chủ</a>
								</li>
								<li class="megamenu-holder"><a href="san-pham.html">Sản phẩm</a>
									@if(count($all_share_danh_muc_san_pham) != 0)
									<ul class="megamenu hb-megamenu" id="megamenu_product">
										@foreach($all_share_danh_muc_san_pham as $all_dmsp)
										<li><a href='danh-muc-san-pham/<?php echo changeTitle($all_dmsp->ten); ?>-a{{$all_dmsp->id}}.html'>{{$all_dmsp->ten}}</a>
											@if(count($all_share_loai_san_pham) != 0)
											<ul>
												@foreach($all_share_loai_san_pham as $all_lsp)
												@if($all_lsp->id_danh_muc_sp == $all_dmsp->id)
												<li><a href='loai-san-pham/{{changeTitle($all_lsp->ten)}}-a{{$all_lsp->id}}.html'>{{$all_lsp->ten}} </a></li>
												@endif
												@endforeach
											</ul>
											@endif
										</li>
										@endforeach
									</ul>
									@endif
								</li>

								<li class="dropdown-holder"><a href="toan-bo-tin-tuc.html">Tin tức</a>
									<ul class="hb-dropdown">
										@if($share_tt_danh_muc_tin_tuc != null)
										@foreach($share_tt_danh_muc_tin_tuc as $sttdmtt)
										<li class="sub-dropdown-holder"><a href="danh-muc-tin-tuc/{{changeTitle($sttdmtt->ten)}}a{{$sttdmtt->id}}.html">{{$sttdmtt->ten}}</a>
											<ul class="hb-dropdown hb-sub-dropdown">
												@if($share_tt_loai_tin_tuc != null)
												@foreach($share_tt_loai_tin_tuc as $sttltt)
												@if($sttltt->id_danh_muc_tin_tuc == $sttdmtt->id)
												<li><a href="loai-tin-tuc/{{changeTitle($sttltt->ten)}}a{{$sttltt->id}}.html">{{$sttltt->ten}}</a></li>
												@endif
												@endforeach
												@endif
											</ul>
										</li>
										@endforeach
										@endif
									</ul>
								</li>
								<li class="dropdown-holder mr-4"><a href="toan-bo-dich-vu.html">Dịch vụ</a>
									<ul class="hb-dropdown">

										@if($share_tt_danh_muc_dich_vu != null)
										@foreach($share_tt_danh_muc_dich_vu as $sttdmdv)
										<li class="sub-dropdown-holder"<a href="danh-muc-dich-vu/{{changeTitle($sttdmdv->ten)}}a{{$sttdmdv->id}}.html">{{$sttdmdv->ten}}</a>
											<ul class="hb-dropdown hb-sub-dropdown">
												@if($share_tt_loai_dich_vu != null)
												@foreach($share_tt_loai_dich_vu as $sttldv)
												@if($sttldv->id_danh_muc_dich_vu == $sttdmdv->id)
												<li><a href="loai-dich-vu/{{changeTitle($sttldv->ten)}}a{{$sttldv->id}}.html">{{$sttldv->ten}}</a></li>
												@endif
												@endforeach
												@endif
											</ul>
										</li>
										@endforeach
										@endif
									</ul>
								</li>
								<li><a href="thong-tin.html">Thông tin</a></li>
								<li class="ml-2"><a href="lien-he.html">Liên hệ</a></li>
							</ul>
						</nav>
					</div>
					<!-- Header Bottom Menu Area End Here -->
				</div>
			</div>
		</div>
	</div>
	<!-- Header Bottom Area End Here -->
	<!-- Begin Mobile Menu Area -->
	<div class="mobile-menu-area d-lg-none d-xl-none col-12">
		<div class="container">
			<div class="row">
				<div class="mobile-menu">
				</div>
			</div>
		</div>
	</div>
	<!-- Mobile Menu Area End Here -->
</header>
<!-- Header Area End Here -->

@section('script')
@endsection
