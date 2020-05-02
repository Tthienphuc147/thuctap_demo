@extends('user/layout/index')

@section('title')
Quên mật khẩu - Phuc Store
@endsection

@section('content')
<!-- Begin Login Content Area -->
<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3 col-xs-12">
				<form method="post" action="quen-mat-khau">
					@csrf
					<div class="login-form">
						<h4 class="login-title"><center>Nhập email xác thực tài khoản</center></h4>
						@if(Session::has('loi_email_xac_thuc'))
						<div class="alert alert-danger" id="error_post_singin">
							<center>
								{{Session::get('loi_email_xac_thuc')}}
							</center>
						</div>
						@endif
						<div class="row">
							<div class="col-md-12 mb-20">
								<label>Nhập Email của bạn *</label>
								<input id="mail_tai_khoan" class="mb-0" type="email" placeholder="Nhập địa chỉ Email" name="email">
							</div>
							<div class="col-12">
								<button type="submit" class="register-button mt-0">Nhận mã xác thực</button>
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
