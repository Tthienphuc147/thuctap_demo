@extends('admin/layout/index')

@section('admin_css')
        <link rel="stylesheet" href="admin/css/data-table/bootstrap-table.css">
  <style>
      /*jssor slider loading skin spin css*/
      .jssorl-009-spin {position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);}
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /*jssor slider bullet skin 05 css*/
        .jssorb050 {cursor:default;position:relative;top:0px;left:0px;width:350px;height:350px;overflow:hidden;}
        /*jssor slider bullet skin 053 css*/
        .jssorb053 {position:absolute;bottom:12px;right:12px;}
        .jssorb053 .i {position:absolute;cursor:pointer;}
        .jssorb053 .i .b {fill:#fff;fill-opacity:0.5;}
        .jssorb053 .i:hover .b {fill-opacity:.7;}
        .jssorb053 .iav .b {fill-opacity: 1;}
        .jssorb053 .i.idn {opacity:.3;}
        
        /*jssor slider arrow skin 093 css*/
        .jssora093 {display:block;position:absolute;cursor:pointer;}
        .jssora093 .c {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
        .jssora093 .a {fill:none;stroke:#fff;stroke-width:400;stroke-miterlimit:10;}
        .jssora093:hover {opacity:.8;}
        .jssora093.jssora093dn {opacity:.6;}
        .jssora093.jssora093ds {opacity:.3;pointer-events:none;}

        #jssor_1{
            position:relative;margin:0 auto;top:0px;left:0px;width:350px;height:350px;overflow:hidden;visibility:hidden;
        }
        .shadow-upload {
            -webkit-border-radius: 0% 0% 100% 100% / 0% 0% 8px 8px;
            -webkit-box-shadow: rgba(0, 0, 0,.30) 0 2px 3px;
        }
        .box-upload {
            margin: 0 auto;
            margin-top: 10px;
            background: #F2F2F2;
            border: 1px solid #ccc;
            box-shadow: 1px 1px 2px #fff inset,
                      -1px -1px 2px #fff inset;
            border-radius: 3px/6px;
        }
        #image_preview img{
          width: 200px;
          padding: 5px;
        }
        #image_preview-upload{
            padding: 10px;
        }
        #image_preview-upload img{
            width: 200px;
            padding: 5px;
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
                                        <li><a href="/quantri/trangchu">Admin</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><a href="/quantri/sanpham/danhsach">Sản phẩm</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">{{ $san_pham->ten }}</span>
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
                            <h3>{{$san_pham->ten}} <span><button class="btn btn-success pull-right" onclick="edit({{$san_pham->id}})">Chỉnh sửa</button></span></h3>
                            <hr>
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#thongtin">Thông tin</a></li>
                                <li><a href="#thongso">Thông số kỹ thuật</a></li>
                                <li><a href="#thongtinchitiet">Thông tin chi tiết</a></li>
                                <li><a href="#hinhanh">Hình ảnh</a></li>
                                <li><a href="#phanhoi">Phản hồi</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="thongtin">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <?php $check_img = false; ?>
                                                        @foreach($hinh_anh_sp as $hinh_anh)
                                                            <img src="uploads/images/products/{{$hinh_anh->ten}}" alt="" class="img-thumbnail">
                                                            <?php $check_img = true; ?>
                                                            @break
                                                        @endforeach
                                                        @if(!$check_img)
                                                            <img src="https://via.placeholder.com/1200x800" alt="" class="img-thumbnail">
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <p>{{ $san_pham->mo_ta}}</p>
                                                        <b>Giá gốc: </b>{{ number_format($san_pham->gia_goc, 0, '', '.') }}<strong>₫</strong><br>
                                                        <b>Khuyến mãi: </b>{{ number_format($san_pham->khuyen_mai, 0, '', '.') }}%<br>
                                                        <b>Giá bán: </b>{{ number_format($san_pham->gia_ban, 0, '', '.') }}₫<br>
                                                        <b>Ngày bắt đầu khuyến mãi: </b>{{ date("d/m/Y", strtotime($san_pham->ngay_bat_dau_khuyen_mai)) }}<br>
                                                        <b>Ngày kết thúc khuyến mãi: </b>{{ date("d/m/Y", strtotime($san_pham->ngay_ket_thuc_khuyen_mai)) }}<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="thongso">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        {!! $san_pham->thong_so !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="thongtinchitiet">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        {!! $san_pham->thong_tin_chi_tiet !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="hinhanh">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <!-- #endregion Slider Start -->
                                                        <div id="jssor_1">
                                                            <!-- Loading Screen -->
                                                            <div data-u="loading" class="jssorl-009-spin">
                                                                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="svg/loading/static-svg/spin.svg" />
                                                            </div>
                                                            <div data-u="slides" class="jssorb050">
                                                                @foreach($hinh_anh_sp as $hinh_anh)
                                                                <div>
                                                                    <img data-u="image" src="uploads/images/products/{{$hinh_anh->ten}}" />
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- Bullet Navigator -->
                                                            <div data-u="navigator" class="jssorb053" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                                                <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                                                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                                        <path class="b" d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <!-- Arrow Navigator -->
                                                            <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                                                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                                                    <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                                                                    <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                                                                </svg>
                                                            </div>
                                                            <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                                                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                                                    <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                                                                    <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <!-- #endregion Slider End -->
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="box-upload">
                                                            <div id="image_preview-upload">
                                                                @foreach($hinh_anh_sp as $hinh_anh)
                                                                <img src="uploads/images/products/{{$hinh_anh->ten}}" />
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="phanhoi">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
                                            <option value="">In trang hiện tại</option>
                                            <option value="all">In tất cả các trang</option>
                                            <option value="selected">In theo tùy chọn</option>
                                        </select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="name">Tên khách hàng</th>
                                                <th data-field="email">Email</th>
                                                <th data-field="phone">Nội dung</th>
                                                <th data-field="task">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($phan_hoi_sp as $phan_hoi)
                                            <tr>
                                                <td></td>
                                                <td>{{ $phan_hoi->id}}</td>
                                                <td>{{ $phan_hoi->ten_hien_thi}}</td>
                                                <td>{{ $phan_hoi->email}}</td>
                                                <td>{{ $phan_hoi->noi_dung}}</td>
                                                <td>
                                                    @if($phan_hoi->duyet)
                                                    <button title="Đã duyệt" class="btn btn-secondary btn-sm">Đã duyệt
                                                    </button>
                                                    @else
                                                    <button title="Chưa duyệt" class="btn btn-warning btn-sm">
                                                        Chưa duyệt
                                                    </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
        function edit(id){
            window.location.href = 'quantri/sanpham/chinhsua/' + id
        }
    </script>

    <script src="admin/js/jssor/jssor.slider.min.js"></script>
    <script src="admin/js/jssor/api-event-handling.js"></script>
    <!-- data table JS
        ============================================ -->
    <script src="admin/js/data-table/bootstrap-table.js"></script>
    <script src="admin/js/data-table/tableExport.js"></script>
    <script src="admin/js/data-table/data-table-active.js"></script>
    <script src="admin/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="admin/js/data-table/colResizable-1.5.source.js"></script>
    <script src="admin/js/data-table/bootstrap-table-export.js"></script>
@endsection