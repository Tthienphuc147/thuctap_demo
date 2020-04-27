@extends('admin/layout/index')

@section('admin_css')
    <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/form/all-type-forms.css">
    <style>
        .cursor-none{
            cursor: default;
        }
        .btn-default:hover{
            background: white;
            border-color: black; 
        }
        .fa.fa-close:hover {
            color: red;
            cursor: pointer;
        }
        #radioBtn .notActive{
            color: green;
            background-color: #fff;
        }
        #radioBtn a.disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
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
                                        <li>Cài đặt <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">Trang chủ</span>
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
                        <div class="sparkline12-list" style="padding-bottom: 0px;">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h1>Cài đặt trang chủ</h1>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-success btn-sm pull-right" onclick="editThongTin()" name="edit">Chỉnh sửa</button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="sparkline12-graph">
                                <form id="form-cai-dat-trang-chu" method="POST" enctype="application/x-www-form-urlencoded">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Địa chỉ</label>
                                            <input type="text" readonly class="form-control" placeholder="Nhập địa chỉ" required="" name="dia_chi" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->dia_chi }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Email</label>
                                            <input type="email" readonly class="form-control" placeholder="Nhập email" required="" name="email" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->email }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Số điện thoại</label>
                                            <input type="text" readonly class="form-control" placeholder="Nhập số điện thoại" required="" name="dien_thoai" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->dien_thoai }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Bản quyền thuộc về</label>
                                            <input type="text" readonly class="form-control" placeholder="Nhập bản quyền thuộc về" required="" name="ban_quyen" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->ban_quyen }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Địa chỉ youtube</label>
                                            <input type="text" readonly class="form-control" placeholder="Nhập địa chỉ youtube" required="" name="youtube" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->youtube }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Địa chỉ twitter</label>
                                            <input type="text" readonly class="form-control" placeholder="Nhập địa chỉ twitter" required="" name="twitter" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->twitter }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Địa chỉ facebook</label>
                                            <input type="text" readonly class="form-control" placeholder="Nhập địa chỉ facebook" required="" name="facebook" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->facebook }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Địa chỉ instagram</label>
                                            <input type="text" readonly class="form-control" placeholder="Nhập địa chỉ instagram" required="" name="instagram" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->instagram }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Cho phép hiển thị ngẫu nhiên</label>
                <div class="input-group">
                    @if($cai_dat_trang_chu->hien_thi_loai_ngau_nhien)
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-success active disabled" data-toggle="hien_thi_loai_ngau_nhien" data-title="1">Có</a>
                        <a class="btn btn-success notActive disabled" data-toggle="hien_thi_loai_ngau_nhien" data-title="0">Không</a>
                    </div>
                    <input type="hidden" name="hien_thi_loai_ngau_nhien" id="hien_thi_loai_ngau_nhien" value="1">
                    @else
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-success disabled notActive" data-toggle="hien_thi_loai_ngau_nhien" data-title="1">Có</a>
                        <a class="btn btn-success disabled active" data-toggle="hien_thi_loai_ngau_nhien" data-title="0">Không</a>
                    </div>
                    <input type="hidden" name="hien_thi_loai_ngau_nhien" id="hien_thi_loai_ngau_nhien" value="0">
                    @endif
                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Địa chỉ app facebook</label>
                                            <input type="text" readonly class="form-control" placeholder="Nhập địa chỉ app facebook" required="" name="app_facebook" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->app_facebook }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Địa chỉ bản đồ</label>
                                            <input type="text" readonly class="form-control" placeholder="Nhập địa chỉ bản đồ" required="" name="dia_chi_map" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_trang_chu->dia_chi_map }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Chọn hình ảnh</label>
                                            <input class="form-control" type='file' onchange="readURL(this);" id="file" name="file" readonly="" disabled="" />
                                            <div id="preview">
                                                <img src="uploads/images/logo/{{ $cai_dat_trang_chu->logo}}" alt="Hình ảnh" style="margin-top: 20px; max-width: 400px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn btn-sm btn-success pull-right" name="save" style="display: none;">Lưu lại</button>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button type="button" class="btn btn-sm btn-danger" name="destroy" style="display: none;" onclick="destroyTinTuc()">Hủy bỏ</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic Form Start -->
@endsection

@section('admin_script')
    <script src="js/admin/caidat/trangchu.js"></script>
@endsection