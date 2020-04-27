@extends('user/layout/index')

@section('title')
Lỗi - Phuc Store
@endsection

@section('content')
<!-- Bắt đầu thẻ đường dẫn -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Lỗi 404</li>
			</ul>
		</div>
	</div>
</div>
<!-- Kết thúc thẻ đường dẫn -->
<!-- Error 404 Area Start -->
<div class="error404-area pt-30 pb-60">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="error-wrapper text-center ptb-50 pt-xs-20">
					<div class="error-text">
						<h1>404</h1>
						<h2>KHÔNG TÌM THẤY YÊU CẦU</h2>
						<p>Xin lỗi! Trang bạn yêu cầu không tồn tại, hoặc đã được thay đổi.</p>
					</div>
					<div class="error-button">
						<a href="trang-chu.html">Quay lại trang chủ</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Error 404 Area End -->
@endsection
