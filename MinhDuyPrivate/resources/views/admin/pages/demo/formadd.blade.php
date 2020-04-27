@extends('admin/layout/index')

@section('admin_css')

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
                                        <li><a href="quantri/sanpham/danhsach">Sản phẩm</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">demo</span>
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
        <!-- Content Start -->
        <div class="single-pro-review-area mt-t-30 mg-b-15" id="hidden-loading" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Thông tin</a></li>
                                <li><a href="#tab-two">Thông số kỹ thuật</a></li>
                                <li><a href="#INFORMATION">Hình ảnh</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <img src="https://via.placeholder.com/1200x800" alt="" class="img-thumbnail">
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="tab-two">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                    <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="hpanel shadow-inner responsive-mg-b-30">
                            <div class="panel-body">
                                <button class="btn btn-success compose-btn btn-block m-b-md">Gợi ý</button>
                                <ul class="mailbox-list">
                                    <li>
                                        <a href="#"><i class="fa fa-paper-plane text-warning"></i> Click Sent</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-paper-plane text-warning"></i> Click Sent 1</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-paper-plane text-warning"></i> Click Sent 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="row">
                            <form action="">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên chi tiết thông số</label>
                                        <input type="text" class="form-control" placeholder="Tên chi tiết thông số" required="" name="ten" oninvalid="this.setCustomValidity('Vui lòng điền dữ liệu')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn btn-primary pull-right">Lưu lại</button>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button type="button" class="btn btn-danger" onclick="destroy()">Hủy bỏ</button>
                                        </div>
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
                                <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        d
    
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
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
        <!-- Content End -->
@endsection

@section('admin_script')

   <script>

        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
        $('#myTabedu1 li:eq(<?php echo "1"; ?>) a').tab('show')
    </script>
@endsection