@extends('user/layout/index')

@section('title')
Xác thực mật khẩu - Phuc Store
@endsection

@section('content')
<!-- Begin Login Content Area -->
<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3 col-xs-12">
				<form method="post" action="quen-mat-khau/nhap-ma">
					@csrf
					<div class="login-form">
						<h4 class="login-title"><center>Nhập mã xác thực tài khoản</center></h4>
						@if(Session::has('thong_bao_xac_thuc') && (!Session::has('loi_nhap_xac_thuc')) )
						<div class="alert alert-success">
							<center>
								{{Session::get('thong_bao_xac_thuc')}}
							</center>
						</div>
						@endif
						@if(Session::has('loi_nhap_xac_thuc'))
						<div class="alert alert-danger">
							<center>
								{{Session::get('loi_nhap_xac_thuc')}}
							</center>
						</div>
						@endif
						<div class="row">
							<div class="col-md-12 mb-20">
								<label>Nhập mã *</label>
								<input class="mb-0" type="text" placeholder="Nhập mã xác thực" name="ma_xac_thuc">
							</div>
							<div class="col-12">
								<button type="submit" class="register-button mt-0">Xác nhận</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Login Content Area End Here -->
@endsection

@section('script')
<script>

</script>
@endsection
