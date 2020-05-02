@extends('user/layout/index')

@section('title')
Đăng nhập _ Đăng ký - Phuc Store
@endsection

@section('content')
<!-- Begin Login Content Area -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                <!-- Login Form s-->
                <form method="post" id="form_login">
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Đăng nhập</h4>
                        <div class="alert alert-danger" id="error_post_login">
                            <center>
                                <strong>Tài khoản chưa tồn tại!</strong> Vui lòng kiểm tra lại.
                            </center>
                        </div>
                        @if(Session::has('thongbaoloifb'))
                        <div class="alert alert-danger">
                            <center>
                                <strong>{{ Session::get('thongbaoloifb')}}</strong> Vui lòng thử lại.
                            </center>
                        </div>
                        @endif
                        <div class="row">
                            <div hidden="" class="col-md-12 col-12 mb-20">
                                <input id="name_back_url" class="mb-0" type="text" name="back_link" value="{{$back_link}}">
                            </div>
                            <div class="col-md-12 col-12 mb-20">
                                <label>Tài khoản</label>
                                <label id="error_name" class="error"></label>
                                <input maxlength="100" id="name_login" class="mb-0" type="text" name="name" placeholder="Tên tài khoản hoặc email">
                            </div>
                            <div class="col-12 mb-20">
                                <label>Mật khẩu</label>
                                <label id="error_pass" class="error"></label>
                                <input maxlength="50" id="pass_login" class="mb-0" type="password" name="pass" placeholder="Nhập mật khẩu">
                            </div>
                            <div class="col-md-8">
                                <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                    <input type="checkbox" id="remember_me" name="remember">
                                    <label for="remember_me">Ghi nhớ tài khoản</label>
                                </div>
                            </div>
                            <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                <a href="quen-mat-khau"> Quên mật khẩu</a>
                            </div>
                            <div class="col-md-12">
                                <button id="sub_form_login" class="register-button mt-0" type="button">Đăng nhập</button>
                            </div>
                            {{-- <div class="col-md-12">
                                <button type="button" class="register-button mt-0" id="btn_loginfb" onclick="location.href='dangnhap/facebook'"><i id="btn_loginfb-icon" class="fa fa-facebook"></i> Đăng nhập với Facebook</button>
                            </div> --}}
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                <form method="post" id="form_singin">
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Đăng ký</h4>
                        <div class="alert alert-danger" id="error_post_singin" style="display: none;">
                            <center>
                                <strong>Đăng ký tài khoản thất bại!</strong> Vui lòng kiểm tra lại thông tin.
                            </center>
                        </div>
                        <div class="alert alert-danger" id="error_exist_user" style="display: none;">
                            <center>
                                <strong>Tài khoản đã tồn tại!</strong> Vui lòng kiểm tra lại thông tin.
                            </center>
                        </div>
                        <div class="alert alert-success" id="success_singin" style="display: none;">
                            <center>
                                <strong>Đăng ký thành công!</strong> Vui lòng đăng nhập để sử dụng.
                            </center>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20">
                                <label>Tên hiển thị *</label>
                                <input name="ten_hien_thi" class="mb-0" type="text" placeholder="Nhập tên hiển thị" maxlength="30">
                            </div>
                            <div class="col-md-12 col-12">
                                <label id="loi_tai_Khoan" class="error"></label>
                            </div>
                            <div class="col-md-12 col-12 mb-20">
                                <label>Tên tài khoản *</label>
                                <input id="ten_tai_khoan" name="ten_tai_khoan" class="mb-0" type="text" placeholder="Nhập tên tài khoản">
                            </div>
                            <div class="col-md-12 col-12">
                                <label id="loi_email" class="error"></label>
                            </div>
                            <div class="col-md-12 mb-20">
                                <label>Email *</label>
                                <input id="mail_tai_khoan" name="mail_tai_khoan" class="mb-0" type="email" placeholder="Nhập địa chỉ Email">
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
                                <button type="button" id="sub_form_singin" class="register-button mt-0">Đăng ký</button>
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

    $('#sub_form_login').click(function() {
        $('#error_name').text("");
        $('#error_pass').text("");
        $('#loi_tai_Khoan').text("");
        $('#loi_email').text("");
        $('#loi_mat_khau').text("");
        $("#success_singin").css("display", "none");

        var check_name = /^[A-Za-z0-9@.]{6,80}$/;
        if(!$('#name_login').val().match(check_name)){
            $('#error_name').text("Tên đăng nhập không hợp lệ");
            return false;
        }
        var check_pass = /^([a-zA-Z0-9@*#]{6,30})$/;
        if(!$('#pass_login').val().match(check_pass)){
            $('#error_pass').text("Mật khẩu không hợp lệ");
            return false;
        }
        $.ajax({
            type: "POST",
            url: 'dang-nhap',
            data: $('#form_login').serialize(),
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

    $('#sub_form_singin').click( function(){
        $('#error_name').text("");
        $('#error_pass').text("");
        $('#loi_tai_Khoan').text("");
        $('#loi_email').text("");
        $('#loi_mat_khau').text("");
        $("#success_singin").css("display", "none");

        var ten_tai_khoan = /^[A-Za-z0-9@.]{6,80}$/;
        if(!$('#ten_tai_khoan').val().match(ten_tai_khoan)){
            $('#loi_tai_Khoan').text("Tên tài khoản không hợp lệ");
            return false;
        }
        var email_dang_ky = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!$('#mail_tai_khoan').val().match(email_dang_ky)){
            $('#loi_email').text("Email không hợp lệ");
            return false;
        }
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
            url: 'dang-ky',
            data: $('#form_singin').serialize(),
            success: function( msg ) {
                switch(msg){
                    case 'exist':
                        $("#error_exist_user").css("display", "block");
                        setTimeout(function(){
                            $("#error_exist_user").css("display", "none");
                        }, 5000);
                        break;
                    case 'true':
                        $("#success_singin").css("display", "block");
                        $('#form_singin').trigger("reset");
                    break;
                    case 'false':
                        $("#error_post_singin").css("display", "block");
                        setTimeout(function(){
                            $("#error_post_singin").css("display", "none");
                        }, 5000);
                    break;
                }
            }
        });
        return false;
    });

</script>
@endsection
