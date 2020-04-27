@extends('admin/layout/index')

@section('admin_css')
    <link rel="stylesheet" href="admin/css/data-table/bootstrap-table.css">
    <style>
        .name-sp{
            min-width: 120px;
        }
        .option-sp{
            min-width: 100px;
        }
        .type-sp{
            min-width: 80px;
        }
        .checkbox-noi-bat{
            position: relative;
            display: block;
            margin-left: 10px;
        }
        .gui-email {
            margin-top: 10px;
        }
        @media only screen and (max-width: 480px){
            .name-sp{
                min-width: 120px;
            }
            .option-sp{
                min-width: 100px;
            }
            .type-sp{
                min-width: 80px;
            }
            .checkbox-noi-bat{
                position: relative;
                display: block;
                margin-left: 10px;
            }
            .gui-email {
                margin-top: 10px;
            }
        }

        @media only screen and (max-width: 576px){
            .name-sp{
                min-width: 10px;
            }
            .option-sp{
                min-width: 10px;
            }
            .type-sp{
                min-width: 8px;
            }
            .checkbox-noi-bat{
                position: relative;
                display: block;
                margin-left: 0px;
            }
            .gui-email {
                margin-top: 0px;
            }
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
                                        <li><span class="bread-blod">Sản phẩm</span>
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
                                        <div class="col-md-9">
                                             <h1>Danh sách sản phẩm</h1>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown keep-open btn-group" id="mr-sort-asc">
                                                <button class="btn btn-default dropdown-toggle" title="Sắp xếp tăng" type="button" data-toggle="dropdown"><i class="fa fa-arrow-up" aria-hidden="true"></i> 
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu animated zoomIn">
                                                  <li><a href="quantri/sanpham/danhsach">ID</a></li>
                                                  <li><a href="quantri/sanpham/danhsach/ten/asc">Tên </a></li>
                                                  <li><a href="quantri/sanpham/danhsach/moi/asc">Sản phẩm mới </a></li>
                                                  <li><a href="quantri/sanpham/danhsach/noi_bat/asc">Sản phẩm nổi bật </a></li>
                                                  <li><a href="quantri/sanpham/danhsach/gia_goc/asc">Giá gốc</a></li>
                                                  <li><a href="quantri/sanpham/danhsach/khuyen_mai/asc">Khuyến mãi</a></li>
                                                  <li><a href="quantri/sanpham/danhsach/khuyen_mai/asc">Giá bán</a></li>
                                                  <li><a href="quantri/sanpham/danhsach/loai_san_phams.ten/asc">Tên loại sản phẩm</a></li>
                                                </ul>
                                            </div>

                                            <button class="btn btn-default dropdown-toggle" id="mr-sort-desc" title="Sắp xếp giảm" data-toggle="dropdown" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn" role="menu">
                                                <li role="menuitem"><a href="quantri/sanpham/danhsach/id/desc">ID </a></li>
                                                <li role="menuitem"><a href="quantri/sanpham/danhsach/ten/desc">Tên </a></li>
                                                <li role="menuitem"><a href="quantri/sanpham/danhsach/moi/desc">Sản phẩm mới </a></li>
                                                <li role="menuitem"><a href="quantri/sanpham/danhsach/noi_bat/desc">Sản phẩm nổi bật </a></li>
                                                <li role="menuitem"><a href="quantri/sanpham/danhsach/gia_goc/desc">Giá gốc </a></li>
                                                <li role="menuitem"><a href="quantri/sanpham/danhsach/khuyen_mai/desc">Khuyến mãi </a></li>
                                                <li role="menuitem"><a href="quantri/sanpham/danhsach/gia_ban/desc">Giá bán </a></li>
                                                <li role="menuitem"><a href="quantri/sanpham/danhsach/loai_san_phams.ten/desc">Tên loại sản phẩm </a></li>
                                            </ul>
                                            <button class="btn btn-success pull-right" onclick="add()">Thêm mới</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
                                            <option value="">In trang hiện tại</option>
                                            <option value="all">In tất cả các trang</option>
                                            <option value="selected">In theo tùy chọn</option>
                                        </select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-unique-id="id">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="name">Tên</th>
                                                <th data-field="mota">Thông tin sản phẩm</th>
                                                <th data-field="moi">Mới</th>
                                                <th data-field="noibat">Nổi bật</th>
                                                <th data-field="banchay">Bán chạy</th>
                                                <th data-field="loai">Loại</th>
                                                <th data-field="option">Tùy chọn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($san_pham as $sp)
                                            <tr>
                                                <td></td>
                                                <td>{{ $sp->id }}</td>
                                                <td class="name-sp"><a href="quantri/sanpham/xem/{{$sp->id}}"><b>{{ $sp->ten }}</b></a></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <?php $check_img = false; ?>
                                                             @foreach($hinh_anh_sp as $hinh_anh)
                                                                @if($hinh_anh->id_sp == $sp->id)
                                                                    <img src="uploads/images/products/{{$hinh_anh->ten}}" alt="" class="img-thumbnail">
                                                                    <?php $check_img = true; ?>
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                            @if(!$check_img)
                                                                <img src="https://via.placeholder.com/1800x800" alt="" class="img-thumbnail">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-9">
                                                            <p>{{ limitStrlen($sp->mo_ta, 300) }}</p>
                                                            <b>Giá gốc: </b>{{ number_format($sp->gia_goc, 0, '', '.') }}₫<br>
                                                            <b>Khuyến mãi: </b>{{ number_format($sp->khuyen_mai, 0, '', '.') }}%<br>
                                                            <b>Giá bán: </b>{{ number_format($sp->gia_ban, 0, '', '.') }}₫<br>
                                                            <b>Ngày bắt đầu khuyến mãi: </b>{{ date("d/m/Y", strtotime($sp->ngay_bat_dau_khuyen_mai)) }}<br>
                                                            <b>Ngày kết thúc khuyến mãi: </b>{{ date("d/m/Y", strtotime($sp->ngay_ket_thuc_khuyen_mai)) }}<br>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($sp->moi)
                                                    <input type="checkbox" value="" checked="" onclick="changeNew({{$sp->id}}, this)">
                                                    @else
                                                    <input type="checkbox" value="" onclick="changeNew({{$sp->id}}, this)">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($sp->noi_bat)
                                                    <div class="checkbox-noi-bat">
                                                        <input type="checkbox" value="" checked="" onclick="changeNoiBat({{$sp->id}}, this)">
                                                    </div>
                                                    @else
                                                    <div class="checkbox-noi-bat">
                                                        <input type="checkbox" value="" onclick="changeNoiBat({{$sp->id}}, this)">
                                                    </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($sp->ban_chay)
                                                    <div class="checkbox-noi-bat">
                                                        <input type="checkbox" value="" checked="" onclick="changeBanChay({{$sp->id}}, this)">
                                                    </div>
                                                    @else
                                                    <div class="checkbox-noi-bat">
                                                        <input type="checkbox" value="" onclick="changeBanChay({{$sp->id}}, this)">
                                                    </div>
                                                    @endif
                                                </td>
                                                <td class="type-sp">{{$sp->ten_loai}}</td>
                                                <td class="option-sp">
                                                    <button title="Chỉnh sửa" class="pd-setting-ed" onclick="editID({{$sp->id}})">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$sp->id }});">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                    @if(!$sp->gui_mail)
                                                    <button title="Gửi email" class="pd-setting-ed gui-email" onclick="sendMail({{$sp->id }});">
                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
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
        <!-- Static Table End -->
@endsection

@section('admin_script')
    <!-- data table JS
        ============================================ -->
    <script src="admin/js/data-table/bootstrap-table.js"></script>
    <script src="admin/js/data-table/tableExport.js"></script>
    <script src="admin/js/data-table/data-table-active.js"></script>
    <script src="admin/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="admin/js/data-table/colResizable-1.5.source.js"></script>
    <script src="admin/js/data-table/bootstrap-table-export.js"></script>
    <script src="js/sanpham/danhsach.js"></script>
    <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
    </script>
@endsection