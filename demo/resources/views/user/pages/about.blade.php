@extends('user/layout/index')

@section('title')
Thông tin - Phuc Store
@endsection

@section('css')
<style>
	.icon-view-about{
		font-size: 50px;
	}
</style>
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Thông tin</li>
			</ul>
		</div>
	</div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- about wrapper start -->
<div class="about-us-wrapper pt-60 pb-40">
	<div class="container">
		<div class="row">
			<!-- About Text Start -->
			<div class="col-lg-12">
				<div class="about-text-wrap">
					<h2>Cửa hàng Phuc Store</h2>
					<p>Phuc Store là Chuỗi cửa hàng bán Lẻ giá Sỉ chính hãng với các sản phẩm công nghệ như Điện thoại di động, Máy tính bảng, Macbook, Phụ kiện điện thoại uy tín lâu năm tại TP.Đà Nẵng.</p>
					<p>Điện thoại di động chính hãng, giá rẻ: iPhone, điện thoại Samsung, điện thoại OPPO, điện thoại Sony, điện thoại BlackBerry, điện thoại HTC, điện thoại Vivo, điện thoại Nokia, điện thoại Xiaomi, điện thoại Lenovo, điện thoại LG, điện thoại Asus Zenfone…</p>
                    <p>Máy tính bảng giá rẻ: iPad Air, iPad Pro, iPad Mini, máy tính bảng Samsung, máy tính bảng Lenovo….</p>
                    <p>Macbook chính hãng Apple, bảo hành 12 tháng theo tiêu chuẩn Apple: Macbook Touchbar, Macbook Air…</p>
                    <p>Phụ kiện điện thoại giá rẻ nhất: ốp lưng, bao da, dán cường lực, dán màn hình điện thoại, cáp sạc, thẻ nhớ, tai nghe, gậy chụp hình, loa di động, đồng hồ thông minh, pin sạc dự phòng…</p>
                    <p>Điện thoại cũ giá rẻ, iPhone 6 99%, iPhone 6 plus 99%, iPhone 6s 99%, iPhone 6s plus 99%, iPhone 7 99%, iPhone 7 plus 99%...</p>
                    <p>Không chỉ bán lẻ với giá rẻ, Phuc Store còn cung cấp vô số dịch vụ chất lượng và tiện dụng nhất cho Quý khách:</p>
				</div>

				<div class="li-blog-blockquote">
					<blockquote>
						<p>Mặc thắc mắc xin vui lòng gửi đến hòm thư hổ trợ của Phuc Store. Chúng tôi trả lời cho bạn sớm nhất!</p>
						 <a href="giai-dap-thac-mac.html"><i class="fa fa-hand-o-right"></i> Câu hỏi thường gặp!</a>
					</blockquote>
				</div>

			</div>
			<!-- About Text End -->
		</div>
	</div>
</div>
<!-- about wrapper end -->
<!-- Begin Counterup Area -->
<div class="counterup-area">
	<div class="container-fluid p-0">
		<div class="row no-gutters">
			<div class="col-lg-3 col-md-6">
				<!-- Begin Limupa Counter Area -->
				<div class="limupa-counter white-smoke-bg">
					<div class="container">
						<div class="counter-img">
							<i class="icon-view-about fa fa-users"></i>
						</div>
						<div class="counter-info">
							<div class="counter-number">
								<h3 class="counter">{{count($all_share_users)}}</h3>
							</div>
							<div class="counter-text">
								<span>Tổng số người dùng</span>
							</div>
						</div>
					</div>
				</div>
				<!-- limupa Counter Area End Here -->
			</div>
			<div class="col-lg-3 col-md-6">
				<!-- Begin limupa Counter Area -->
				<div class="limupa-counter gray-bg">
					<div class="counter-img">
						<i class="icon-view-about fa fa-gift"></i>
					</div>
					<div class="counter-info">
						<div class="counter-number">
							<h3 class="counter">{{count($all_share_san_pham)}}</h3>
						</div>
						<div class="counter-text">
							<span>Sản phẩm</span>
						</div>
					</div>
				</div>
				<!-- limupa Counter Area End Here -->
			</div>
			<div class="col-lg-3 col-md-6">
				<!-- Begin limupa Counter Area -->
				<div class="limupa-counter white-smoke-bg">
					<div class="counter-img">
						<i class="icon-view-about fa fa-newspaper-o"></i>
					</div>
					<div class="counter-info">
						<div class="counter-number">
							<h3 class="counter">{{count($all_share_tin_tucs)}}</h3>
						</div>
						<div class="counter-text">
							<span>Tin tức tổng hợp</span>
						</div>
					</div>
				</div>
				<!-- limupa Counter Area End Here -->
			</div>
			<div class="col-lg-3 col-md-6">
				<!-- Begin limupa Counter Area -->
				<div class="limupa-counter gray-bg">
					<div class="counter-img">
						<i class="icon-view-about fa fa-building"></i>
					</div>
					<div class="counter-info">
						<div class="counter-number">
							<h3 class="counter">{{count($all_share_dich_vus)}}</h3>
						</div>
						<div class="counter-text">
							<span>Dịch vụ hiện có</span>
						</div>
					</div>
				</div>
				<!-- limupa Counter Area End Here -->
			</div>
		</div>
	</div>
</div>
<!-- Counterup Area End Here -->
<!-- team area wrapper start -->
<div class="team-area pt-60 pt-sm-44">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="li-section-title capitalize mb-25">
					<h2><span>Nhân sự</span></h2>
				</div>
			</div>
		</div> <!-- section title end -->
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-member mb-60 mb-sm-30 mb-xs-30">
					<div class="team-thumb">
						<img src="user/assets/images/team/1.png" alt="Our Team Member">
					</div>
					<div class="team-content text-center">
						<h3>Phan Đinh Thiên Phúc</h3>
						<p>Chủ cửa hàng</p>

					</div>
				</div>
			</div> <!-- end single team member -->
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-member mb-60 mb-sm-30 mb-xs-30">
					<div class="team-thumb">
						<img src="user/assets/images/team/2.png" alt="Our Team Member">
					</div>
					<div class="team-content text-center">
						<h3>Hoàng Thị Lam</h3>
						<p>Nhân viên bán hàng</p>

					</div>
				</div>
			</div> <!-- end single team member -->
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-member mb-30 mb-sm-60">
					<div class="team-thumb">
						<img src="user/assets/images/team/3.png" alt="Our Team Member">
					</div>
					<div class="team-content text-center">
						<h3>Lê Thái Hùng</h3>
						<p>Nhân viên sửa chửa</p>

					</div>
				</div>
			</div> <!-- end single team member -->
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="team-member mb-30 mb-sm-60 mb-xs-60">
					<div class="team-thumb">
						<img src="user/assets/images/team/4.png" alt="Our Team Member">
					</div>
					<div class="team-content text-center">
						<h3>Hà Thị Loan</h3>
						<p>Nhân viên bán hàng</p>

					</div>
				</div>
			</div> <!-- end single team member -->
		</div>
	</div>
</div>
<!-- team area wrapper end -->
@endsection
