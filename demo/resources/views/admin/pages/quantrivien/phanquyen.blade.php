@extends('admin/layout/index')

@section('admin_css')
    <link rel="stylesheet" href="admin/css/data-table/bootstrap-table.css">
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
                                        <li><span class="bread-blod">Phân quyền chức năng</span>
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

        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15" id="hidden-loading" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <div class="row">
                                        <div class="col-md-12">
                                             <h1>Danh sách các quyền chức năng</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="basic-form-area mg-b-15" >
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="sparkline12-list">
                                                <div class="sparkline12-hd">
                                                    <div class="main-sparkline12-hd">
                                                        <h1>Chỉnh sửa phân quyền</h1>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="sparkline12-graph">
                                                    <form id="form-sua-phan-quyen" action="quantri/quantrivien/phanquyen/{{$permissions->id}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý danh mục sản phẩm</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="danh_muc_san_pham" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                        @if ($permissions->danh_muc_san_pham == 0)
                                                                            selected="selected"
                                                                        @endif>
                                                                        Không
                                                                    </option>
                                                                    <option value="1"
                                                                        @if ($permissions->danh_muc_san_pham == 1)
                                                                        selected="selected"
                                                                        @endif>
                                                                        Có
                                                                    </option>

                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý loại sản phẩm</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="loai_san_pham" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->loai_san_pham == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->loai_san_pham == 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý sản phẩm</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="san_pham" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->san_pham == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->san_pham == 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý danh mục tin tức</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="danh_muc_tin_tuc" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->danh_muc_tin_tuc == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->danh_muc_tin_tuc== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý loại tin tức</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="loai_tin_tuc" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->loai_tin_tuc == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->loai_tin_tuc== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý tin tức</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="tin_tuc" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->tin_tuc == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->tin_tuc== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý danh mục dịch vụ</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="danh_muc_dich_vu" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->danh_muc_dich_vu == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->danh_muc_dich_vu== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý loại dịch vụ</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="loai_dich_vu" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->loai_dich_vu == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->loai_dich_vu== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý dịch vụ</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="dich_vu" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->dich_vu == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->dich_vu== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý danh sách hóa đơn</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="danh_sach_hoa_don" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->danh_sach_hoa_don == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->danh_sach_hoa_don== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý phản hồi sản phẩm</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="phan_hoi_san_pham" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->phan_hoi_san_pham == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->phan_hoi_san_pham== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý quản trị viên</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="quan_tri_vien" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->quan_tri_vien == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->quan_tri_vien== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý người dùng</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="nguoi_dung" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->nguoi_dung == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->nguoi_dung== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý hỗ trợ</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="ho_tro" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->ho_tro == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->ho_tro== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Quyền quản lý giải đáp thắc mắc</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="giai_dap_thac_mac" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->giai_dap_thac_mac == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->giai_dap_thac_mac== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Cài đặt trang chủ</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="cai_dat_trang_chu" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->cai_dat_trang_chu == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->cai_dat_trang_chu== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Cài đặt sản phẩm</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="cai_dat_san_pham" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->cai_dat_san_pham == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->cai_dat_san_pham== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Cài đặt dịch vụ</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="cai_dat_dich_vu" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->cai_dat_dich_vu == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->cai_dat_dich_vu== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <h5>Cài đặt tin tức</h5>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <select class="form-control custom-select-value" name="cai_dat_tin_tuc" required="" oninvalid="this.setCustomValidity('Vui lòng chọn phân quyền')" oninput="setCustomValidity('')">
                                                                    <option value="0"
                                                                    @if ($permissions->cai_dat_tin_tuc == 0)
                                                                        selected="selected"
                                                                    @endif>
                                                                    Không
                                                                </option>
                                                                <option value="1"
                                                                    @if ($permissions->cai_dat_tin_tuc== 1)
                                                                    selected="selected"
                                                                    @endif>
                                                                    Có
                                                                </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <button type="submit" class="btn btn-success pull-right" name="save">Chỉnh sửa</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table End -->
@endsection

@section('admin_script')
    <!-- data table JS
        ============================================ -->

    <script>

    </script>
    <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
    </script>
@endsection
