
@if(count($share_sp_tat_ca) != 0)
@foreach($share_sp_tat_ca as $tbsp)
<!-- Bắt đầu hiển thị sản phẩm xem nhanh -->
<div class="modal fade modal-wrapper" id="xemnhanhsanpham{{$tbsp->id}}" >
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-inner-area row">
					<div class="col-lg-5 col-md-6 col-sm-6">
						<!-- Product Details Left -->
						<div class="product-details-left">
							<div class="product-details-images slider-navigation-1">
								@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
								@foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp)
								@if($tbhasp->id_sp == $tbsp->id)
								<div class="lg-image">
									<img src="uploads/images/products/{{$tbhasp->ten}}" alt="product image">
								</div>
								@endif
								@endforeach
								@endif
							</div>
							<div class="product-details-thumbs slider-thumbs-1">
								@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
								@foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp)
								@if($tbhasp->id_sp == $tbsp->id)
								<div class="sm-image"><img src="uploads/images/products/{{$tbhasp->ten}}" alt="product image thumb"></div>
								@endif
								@endforeach
								@endif
							</div>
						</div>
						<!--// Product Details Left -->
						<div class="block-reassurance">
							<ul>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-check-square-o"></i>
										</div>
										<p>Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng.</p>
									</div>
								</li>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-truck"></i>
										</div>
										<p>Giao hàng nhanh chóng</p>
									</div>
								</li>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-exchange"></i>
										</div>
										<p>1 đổi 1 trong 30 ngày nếu có lỗi nhà sản xuất</p>
									</div>
								</li>
							</ul>
						</div>
					</div>



					<div class="col-lg-7 col-md-6 col-sm-6">
						<div class="product-details-view-content pt-60">
							<div class="product-info">
								<h2>{{$tbsp->ten}}</h2>
								<div class="product-additional-info pt-25">
									<div class="product-social-sharing pb-25">
										<ul>
											<li class="facebook"><a href="http://www.facebook.com/sharer.php?u={{url('/')}}'/san-pham/{{changeTitle($tbsp->ten)}}-a{{$tbsp->id}}.html'" onclick="window.open(this.href); return false;"><i class="fa fa-facebook"></i>Facebook</a></li>
											<li class="twitter"><a href="https://twitter.com/intent/tweet?url={{url('/')}}'/san-pham/{{changeTitle($tbsp->ten)}}-a{{$tbsp->id}}.html'"><i class="fa fa-twitter"></i>Twitter</a></li>
											<li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url={{url('/')}}'/san-pham/{{changeTitle($tbsp->ten)}}-a{{$tbsp->id}}.html'" onclick="window.open(this.href); return false;"><i class="fa fa-pinterest-p"></i>Pinterest</a></li>
											<li class="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&url={{url('/')}}'/san-pham/{{changeTitle($tbsp->ten)}}-a{{$tbsp->id}}.html'"><i class="fa fa-linkedin-square"></i>LinkedIn</a></li>
										</ul>
									</div>
								</div>
								<div class="price-box pt-20">
									<span class="new-price new-price-2">{{number_format($tbsp->gia_ban)}}₫</span>
								</div>
								<div class="product-desc">
									<p>
										<span>
											{{$tbsp->mo_ta}}
										</span>
									</p>
								</div>
								<div class="single-add-to-cart">
									<form method="POST" class="cart-quantity" id="form_them_hang_model">
										@csrf
										<div class="quantity">
											<label>Số lượng</label>
											<div class="cart-plus-minus">
												<input id="so_luong_sp_dat_hang{{$tbsp->id}}" class="cart-plus-minus-box" maxlength="10" value="1" type="text" onKeyPress="return khongNhapKyTu(event);">
												<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
												<div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
											</div>
										</div>
										<input name="id_sp" value="{{$tbsp->id}}" hidden>
										<button class="add-to-cart" type="button" onclick="themCoSoLuongModal({{$tbsp->id}})">Thêm giỏ hàng</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Kết thúc hiển thị sản phẩm xem nhanh -->
@endforeach
@endif
<!-- Begin Footer Area -->
<div class="footer">
	<!-- Begin Footer Static Top Area -->
	<div class="footer-static-top">
		<div class="container">
			<!-- Begin Footer Shipping Area -->
			<div class="footer-shipping pt-60 pb-55 pb-xs-25">
				<div class="row">
					<!-- Begin Li's Shipping Inner Box Area -->
					<div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
						<div class="li-shipping-inner-box">
							<div class="shipping-icon">
								<img src="user/assets/images/shipping-icon/1.png" alt="Shipping Icon">
							</div>
							<div class="shipping-text">
								<h2>Giao hàng toàn quốc</h2>
								<p>Kinh doanh toàn quốc, giao hàng tận nơi.</p>
							</div>
						</div>
					</div>
					<!-- Li's Shipping Inner Box Area End Here -->
					<!-- Begin Li's Shipping Inner Box Area -->
					<div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
						<div class="li-shipping-inner-box">
							<div class="shipping-icon">
								<img src="user/assets/images/shipping-icon/2.png" alt="Shipping Icon">
							</div>
							<div class="shipping-text">
								<h2>Thanh toán an toàn</h2>
								<p>Chính sách giao hàng thanh toán khi nhận.</p>
							</div>
						</div>
					</div>
					<!-- Li's Shipping Inner Box Area End Here -->
					<!-- Begin Li's Shipping Inner Box Area -->
					<div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
						<div class="li-shipping-inner-box">
							<div class="shipping-icon">
								<img src="user/assets/images/shipping-icon/3.png" alt="Shipping Icon">
							</div>
							<div class="shipping-text">
								<h2>Sản phẩm uy tín</h2>
								<p>Chúng tôi chỉ kinh doanh những mặt hàng chính hãng.</p>
							</div>
						</div>
					</div>
					<!-- Li's Shipping Inner Box Area End Here -->
					<!-- Begin Li's Shipping Inner Box Area -->
					<div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
						<div class="li-shipping-inner-box">
							<div class="shipping-icon">
								<img src="user/assets/images/shipping-icon/4.png" alt="Shipping Icon">
							</div>
							<div class="shipping-text">
								<h2>Hổ trợ 24/7</h2>
								<p>Liên hệ đường dây nóng - thư điện tử - fanpage.</p>
							</div>
						</div>
					</div>
					<!-- Li's Shipping Inner Box Area End Here -->
				</div>
			</div>
			<!-- Footer Shipping Area End Here -->
		</div>
	</div>
	<!-- Footer Static Top Area End Here -->
	<!-- Begin Footer Static Middle Area -->
	<div class="footer-static-middle">
		<div class="container">
			<div class="footer-logo-wrap pt-50 pb-35">
				<div class="row">
					<!-- Begin Footer Logo Area -->
					<div class="col-lg-4 col-md-6">
						<div class="footer-logo">
							<img src="user/assets/images/menu/logo/logo.png" alt="Footer Logo">
							<p class="info">
								Cửa hàng Phuc Store chuyên sửa chữa, cung cấp, lắp đặt: thiết bị văn phòng, máy vi tính, nhà thông minh, camera an ninh....
							</p>
						</div>
						<ul class="des">
							<li>
								<span><i class="fa fa-home"></i> Địa chỉ: </span>
								<a href="{{$all_share_sp_cai_dat_trang_chu->dia_chi_map}}" onclick="window.open(this.href); return false;">{{$all_share_sp_cai_dat_trang_chu->dia_chi}}</a>
							</li>
							<li>
								<span><i class="fa fa-phone" aria-hidden="true"></i> Điện thoại: </span>
								<a href="tel:+ {{preg_replace('/\s+/', '',$all_share_sp_cai_dat_trang_chu->dien_thoai)}}">{{$all_share_sp_cai_dat_trang_chu->dien_thoai}}</a>
							</li>
							<li>
								<span><i class="fa fa-envelope-o" aria-hidden="true"></i> Email: </span>
								<a href="mailto://{{$all_share_sp_cai_dat_trang_chu->email}}">{{$all_share_sp_cai_dat_trang_chu->email}}</a>
							</li>
						</ul>
					</div>
					<!-- Footer Logo Area End Here -->


					<!-- Begin Footer Block Area -->
					<div class="col-lg-4">
						<div class="footer-block">
							<h3 class="footer-block-title">Theo dõi chúng tôi</h3>
							<ul class="social-link">
								<li class="twitter">
									<a href="{{$all_share_sp_cai_dat_trang_chu->twitter}}" data-toggle="tooltip" target="_blank" title="Twitter">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<li class="rss">
									<a href="https://rss.com/" data-toggle="tooltip" target="_blank" title="RSS">
										<i class="fa fa-rss"></i>
									</a>
								</li>
								<li class="facebook">
									<a href="{{$all_share_sp_cai_dat_trang_chu->facebook}}" data-toggle="tooltip" target="_blank" title="Facebook">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
								<li class="youtube">
									<a href="{{$all_share_sp_cai_dat_trang_chu->youtube}}" data-toggle="tooltip" target="_blank" title="Youtube">
										<i class="fa fa-youtube"></i>
									</a>
								</li>
								<li class="instagram">
									<a href="{{$all_share_sp_cai_dat_trang_chu->instagram}}" data-toggle="tooltip" target="_blank" title="Instagram">
										<i class="fa fa-instagram"></i>
									</a>
								</li>
							</ul>
						</div>
						<!-- Begin Footer Newsletter Area -->
						<div class="footer-newsletter">
							<h4>Đăng ký nhận thông báo</h4>
							<form method="post" id="subscribe-form"  class="footer-subscribe-form validate" target="_blank" novalidate>
								@csrf
								<div id="mc_embed_signup_scroll">
									<div id="mc-form" class="mc-form subscribe-form form-group" >
										<input id="mc-email" type="email" autocomplete="off" placeholder="Nhập vào Email" name="sub_mail">
										<button onclick="clickDangKyNhanMail();" type="button" class="btn" id="mc-submit">Xác nhận</button>
									</div>
								</div>
							</form>
						</div>
						<!-- Footer Newsletter Area End Here -->
                    </div>
                    <div class="col-lg-4">
						<div class="footer-block">
							<h3 class="footer-block-title">Bản đồ</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d245368.26105001228!2d107.93803908361146!3d16.07176349225733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219c792252a13%3A0x1df0cb4b86727e06!2zxJDDoCBO4bq1bmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1587573479975!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Static Middle Area End Here -->
	@if(count($all_share_tu_khoa) > 1)
	<!-- Bắt đầu từ khóa thông dụng -->
	<div class="footer-static-bottom pt-55 pb-55">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Begin Footer Links Area -->
					<div class="footer-links">
						<ul>
							@foreach($all_share_tu_khoa as $tk)
							@if($tk != "")
							<li><a href="tim-kiem.html?tu_khoa={{$tk}}">{{$tk}}</a></li>
							@endif
							@endforeach
						</ul>
					</div>
					<!-- Footer Links Area End Here -->
					<!-- Begin Footer Payment Area -->
					<div class="copyright text-center">
						<a href="jajascript:void(0)">
							<img src="user/assets/images/payment/1.png" alt="">
						</a>
					</div>
					<!-- Footer Payment Area End Here -->
					<!-- Begin Copyright Area -->

					<!-- Copyright Area End Here -->
				</div>
			</div>
		</div>
	</div>
	<!-- Kết thúc từ khóa thông dụng -->
	@endif
</div>
<!-- Footer Area End Here -->

