@extends('user/layout/index')

@section('title')
Thông tin cá nhân - Phuc Store
@endsection

@section('content')
<!-- Begin Login Content Area -->
<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3 col-xs-12">
				<form method="post" id="form_singin">
					@csrf
					<div class="login-form">
						<h4 class="login-title"><center>Thông tin tài khoản</center></h4>
						<div class="alert alert-danger" id="error_post_singin" style="display: none;">
							<center>
								<strong>Thay đổi thông tin tài khoản thất bại!</strong> Vui lòng kiểm tra lại thông tin.
							</center>
						</div>
						<div class="alert alert-danger" id="error_exist_user" style="display: none;">
							<center>
								<strong>Tài khoản đã tồn tại!</strong> Vui lòng kiểm tra lại thông tin.
							</center>
						</div>
						<div class="alert alert-success" id="success_singin" style="display: none;">
							<center>
								<strong>Thành công!</strong> Thông tin đã được thay đổi.
							</center>
						</div>
						<div class="row">
							<div class="col-md-12 col-12 mb-20">
								<label>Tên hiển thị *</label>
								<input id="ten_hien_thi" name="ten_hien_thi" class="mb-0" type="text" placeholder="Nhập tên hiển thị" maxlength="30" value="{{Auth::guard('web')->user()->display_name}}">
							</div>
							<div class="col-md-12 col-12 mb-20">
								<label>Tên tài khoản *</label>
								<input id="ten_tai_khoan" class="mb-0" type="text" placeholder="Nhập tên tài khoản" value="{{Auth::guard('web')->user()->name}}" disabled>
							</div>
							<div class="col-md-12 mb-20">
								<label>Email *</label>
								<input id="mail_tai_khoan" class="mb-0" type="email" placeholder="Nhập địa chỉ Email" value="{{Auth::guard('web')->user()->email}}" disabled>
							</div>
							<div class="col-md-12 col-12">
								<label id="loi_mat_khau" class="error"></label>
							</div>
							<div class="col-md-6 mb-20">
								<label>Mật khẩu</label>
								<input id="mat_khau_tai_khoan" name="mat_khau_tai_khoan" class="mb-0" type="password" placeholder="Nhập mật khẩu">
							</div>
							<div class="col-md-6 mb-20">
								<label>Xác nhận mật khẩu</label>
								<input id="xac_nhan_tai_khoan" name="xac_nhan_tai_khoan" class="mb-0" type="password" placeholder="Nhập lại mật khẩu">
							</div>
							<div class="col-12">
								<button type="button" id="sub_form_singin" class="register-button mt-0">Thay đổi thông tin</button>
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
	$('#sub_form_singin').click( function(){
		$('#error_name').text("");
		$('#error_pass').text("");
		$('#loi_mat_khau').text("");
		$("#success_singin").css("display", "none");

		var mat_khau_dang_ky = /^([a-zA-Z0-9@*#]{6,30})$/;
		if(!$('#mat_khau_tai_khoan').val().match(mat_khau_dang_ky)){
			$('#loi_mat_khau').text("Mật khẩu không hợp lệ");
			return false;
		}
		if($('#mat_khau_tai_khoan').val() != $('#xac_nhan_tai_khoan').val()){
			$('#loi_mat_khau').text("Không khớp mật khẩu");
			return false;
		}
		$.ajax({
			type: "POST",
			url: 'thong-tin-tai-khoan.html',
			data: $('#form_singin').serialize(),
			success: function( msg ) {
				if(msg == '1') {
					$('#view_name_user').text(' '+$('#ten_hien_thi').val());
					$("#success_singin").css("display", "block");
				}
				else{
					$("#error_post_singin").css("display", "none");
				}
			}
		});
		return false;
	});

</script>
@endsection
