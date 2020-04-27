<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Đăng nhập - Quản trị - Phuc Store</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="{{ asset('') }}">
	<link rel="shortcut icon" type="image/x-icon" href="user/assets/images/logo.png">

	<link rel="stylesheet" href="admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/style.css">
	<style>

		#checkbox-rmb{
			margin-left: 20px;
		}
		.error-pagewrap{
			margin-top: 100px;
		}
		.error{
			color: red;
		}
		#error_post_login{
			display: none;
		}
	</style>
</head>

<body>
	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<h2>ĐĂNG NHẬP HỆ THỐNG</h2>
				<p></p>
			</div>
			<div class="content-error">
				<div class="hpanel">
					<div class="panel-body">
						<div class="alert alert-danger" id="error_post_login">
                            <center>
                                <strong>Tài khoản chưa tồn tại!</strong> Vui lòng kiểm tra lại.
                            </center>
                        </div>
						<form method="post" id="loginForm">
							@csrf
							<div class="form-group">
								<label class="control-label" for="username">Tên tài khoản</label>
								<input maxlength="80" id="tai_khoan" name="tai_khoan" type="text" placeholder="Nhập tên tài khoản hoặc email" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">
								<span class="help-block small error" id="error_name"></span>
							</div>
							<div class="form-group">
								<label class="control-label" for="password">Mật khẩu</label>
								<input maxlength="30" id="mat_khau" name="mat_khau" type="password" placeholder="Nhập vào mật khẩu" required="" value="" name="password" id="password" class="form-control">
								<span class="help-block small error" id="error_pass"></span>
							</div>
							<div id="checkbox-rmb" class="checkbox login-checkbox">
								<label><input name="ghi_nho" type="checkbox" class="i-checks"> Ghi nhớ tài khoản</label>
							</div>
							<button type="button" id="loginbtn" class="btn btn-success btn-block loginbtn">Đăng nhập</button>
							<a class="btn btn-default btn-block" href="#">Quên tài khoản</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
<script src="admin/js/vendor/jquery-1.12.4.min.js"></script>
<script>
	function focus(){
		$('#error_name').text("");
		$('#error_pass').text("");
		$("#success_singin").css("display", "none");
	}
	$( "#tai_khoan" ).focus(function() {
		focus();
	});

	$( "#mat_khau" ).focus(function() {
		focus();
	});

	$('#loginbtn').click(function() {
		$('#error_name').text("");
		$('#error_pass').text("");
		$("#success_singin").css("display", "none");

		var check_name = /^[A-Za-z0-9@.]{6,80}$/;
		if(!$('#tai_khoan').val().match(check_name)){
			$('#error_name').text("Tên đăng nhập không hợp lệ");
			return false;
		}
		var check_pass = /^([a-zA-Z0-9@*#]{6,30})$/;
		if(!$('#mat_khau').val().match(check_pass)){
			$('#error_pass').text("Mật khẩu không hợp lệ");
			return false;
		}
        $.ajax({
            type: "POST",
            url: 'quantri/dangnhap',
            data: $('#loginForm').serialize(),
            success: function( msg ) {
                if(msg != "false"){
                    location.href = msg;
                }
                else{
                    $("#error_post_login").css("display", "block");
                }
            }
        });
        return false;
    });
</script>

</html>
