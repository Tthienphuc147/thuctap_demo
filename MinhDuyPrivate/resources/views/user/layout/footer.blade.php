

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

