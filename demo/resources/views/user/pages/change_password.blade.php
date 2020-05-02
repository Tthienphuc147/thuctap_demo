@extends('user/layout/index')

@section('title')
Thông tin tài khoản - Phuc Store
@endsection

@section('content')
<!-- Begin Login Content Area -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                <!-- Login Form s-->
                <center>

                </center>
                <form method="post" id="form_login">
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Đăng nhập</h4>
                        <div class="alert alert-danger" id="error_post_login">
                            <center>
                                <strong>Tài khoản chưa tồn tại!</strong> Vui lòng kiểm tra lại.
                            </center>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20">
                                <label>Tài khoản</label>
                                <label id="error_name" class="error"></label>
                                <input id="name_login" class="mb-0" type="text" name="name" placeholder="Tên tài khoản hoặc email">
                            </div>
                            <div class="col-12 mb-20">
                                <label>Mật khẩu</label>
                                <label id="error_pass" class="error"></label>
                                <input id="pass_login" class="mb-0" type="password" name="pass" placeholder="Nhập mật khẩu">
                            </div>
                            <div class="col-md-8">
                                <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                    <input type="checkbox" id="remember_me" name="remember">
                                    <label for="remember_me">Ghi nhớ tài khoản</label>
                                </div>
                            </div>
                            <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                <a href="#"> Quên mật khẩu</a>
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
        </div>
    </div>
</div>
<!-- Login Content Area End Here -->
@endsection

@section('script')

@endsection
