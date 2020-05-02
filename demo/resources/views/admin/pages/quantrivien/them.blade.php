@extends('admin/layout/index')

@section('admin_css')
    <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/form/all-type-forms.css">
    <!-- summernote CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/summernote/summernote.css">
@endsection

@section('admin_content')
        <div class="breadcome-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcome-list single-page-breadcome" style="margin-top: 60px;     margin-bottom: 6px;">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcome-heading">
                                        <form role="search" class="sr-input-func">
                                            <input type="text" placeholder="Tìm kiếm..." class="search-int form-control">
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <ul class="breadcome-menu">
                                        <li><a href="quantri/trangchu">Admin</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><a href="quantri/tintuc/danhsach">Quản trị viên</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">Thêm</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Loading Start -->
        <div class="data-table-area mg-b-15" id="show-loading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="pt-5" style="min-height: 65vh;">
                                <div class="loading-spinner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loading End -->
        <!-- Basic Form Start -->
        <div class="basic-form-area mg-b-15" id="hidden-loading" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Thêm mới quản trị viên</h1>
                                </div>
                                <hr>
                            </div>
                            <div class="sparkline12-graph">
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
                                        <strong>Đăng ký thành công tài khoản cho nhân viên!</strong>
                                    </center>
                                </div>
                                <form id="form-them-quan-tri-vien" action="quantri/quantrivien/them" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Họ và tên</label>
                                            <input type="text" class="form-control" placeholder="Nhập họ và tên" required="" name="display_name" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Tên đăng nhập</label>
                                            <input id="ten_tai_khoan" type="text" class="form-control" placeholder="Nhập tên đăng nhập" required="" name="name" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="">
                                            <label id="loi_tai_Khoan" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input id="mail_tai_khoan" type="email" class="form-control" placeholder="Nhập email" required="" name="email" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="">
                                            <label id="loi_email" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Mật khẩu</label>
                                            <input id="mat_khau_tai_khoan" type="password" class="form-control" placeholder="Nhập mật khẩu" required="" name="password" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="">
                                            <label id="loi_mat_khau" class="error"></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Nhập lại mật khẩu</label>
                                            <input id="xac_nhan_tai_khoan" type="password" class="form-control" placeholder="Nhập lại mật khẩu" required="" name="password" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <button type="submit" id="sub_form_singin" class="btn btn-success pull-right" name="save">Thêm mới</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('admin_script')
    <!-- summernote JS
        ============================================ -->
    <script src="admin/js/summernote/summernote.min.js"></script>
   <script>


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
            url: 'quantri/quantrivien/them',
            data: $('#form-them-quan-tri-vien').serialize(),
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
                        $('#form-them-quan-tri-vien').trigger("reset");
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
    <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
    </script>
@endsection
