@extends('user/layout/index')

@section('title')
Thay đổi mật khẩu - Phuc Store
@endsection

@section('content')
<!-- Begin Login Content Area -->
<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3 col-xs-12">
				<form method="post" id="form_doi_pass">
					@csrf
					<div class="login-form">
						<h4 class="login-title"><center>Thay đổi mật khẩu</center></h4>
						<div class="alert alert-danger" id="error_post_login">
							<center>
								<strong>Thay đổi mật khẩu thất bại!</strong> Vui lòng kiểm tra lại.
							</center>
						</div>
						<div class="alert alert-success" id="success_setpass" style="display: none;">
							<center>
								Đăng ký thành công! Vui lòng <strong><a style="color: #155724" href="dang-nhap">đăng nhập </a></strong>để sử dụng.
							</center>
						</div>
						<div class="row">
							<div class="col-md-12 col-12">
								<label id="loi_mat_khau" class="error"></label>
							</div>
							<div class="col-md-12 mb-20">
								<label>Nhập mật khẩu mới *</label>
								<input onfocus="onFocusPass()" class="mb-0" type="password" placeholder="Nhập mật khẩu mới" name="mat_khau_moi" id="new_password">
							</div>
							<div class="col-md-12 mb-20">
								<label>Nhập lại mật khẩu mới *</label>
								<input onfocus="onFocusPass()" class="mb-0" type="password" placeholder="Xác nhận mật khẩu mới" id="set_new_password">
							</div>
							<input name="email" value="{{Session::get('email_doi_pass')}}" hidden>
							<div class="col-12">
								<button type="button" id="sub_form_doi_pass" class="register-button mt-0">Xác nhận</button>
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
	$('#sub_form_doi_pass').click(function(){
		$('#loi_mat_khau').text("");
		var check_pass = /^([a-zA-Z0-9@*#]{6,30})$/;
		if(!$('#new_password').val().match(check_pass)){
			$('#loi_mat_khau').text("Mật khẩu không hợp lệ");
			return false;
		}
		if($('#new_password').val() != $('#set_new_password').val()){
			$('#loi_mat_khau').text("Không khớp mật khẩu");
			return false;
		}
		$.ajax({
			type: "POST",
			url: 'quen-mat-khau/thay-doi-mat-khau.html',
			data: $('#form_doi_pass').serialize(),
			success: function( msg ) {
				if(msg == "true"){
					$("#success_setpass").css("display", "block");
					$('#form_doi_pass').trigger("reset");
				}
				else{
					$("#error_post_login").css("display", "block");
				}
			}
		});
		return false;
	});
	function onFocusPass(){
		$('#loi_mat_khau').text("");
	}
</script>
@endsection
