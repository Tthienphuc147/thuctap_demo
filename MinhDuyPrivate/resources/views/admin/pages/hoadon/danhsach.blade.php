@extends('admin/layout/index')

@section('admin_css')
    <link rel="stylesheet" href="admin/css/data-table/bootstrap-table.css">
    <!-- modals CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/modals.css">
    <style>
    	.option-hd{
            width: 100px;
        }

        .ghichu-hd{
            width: 250px;
        }
        .select-hd{
        	background-color:white; color:black;
        }
        .show-detail {
        	margin-top: 10px;
        }
        .modal-edu-general .modal-body {
		    text-align: left;
		    padding: 30px 70px 0px 70px;
		}
		.form-group.form-group-soluong{
			margin-top: -5px;
		}
		.form-control.form-control-soluong {
		    height: 30px;
	        text-align: center;
		}
        #mr-sort-asc .btn, #mr-sort-desc {
            padding: 2px 8px;
             margin-top: 0px; 
        }
        @media (min-width: 768px){
			.modal-dialog.content-hdchitiet {
			    width: 1000px;
			    margin: 30px auto;
			}
		}
		#myInput {
			background-image: url('uploads/images/searchicon.png');
			background-position: 10px 10px;
			background-repeat: no-repeat;
			width: 100%;
			font-size: 16px;
			padding: 12px 20px 12px 40px;
			border: 1px solid #ddd;
			margin-bottom: 12px;
		}
		#searchtable{
			height: 350px;
			overflow: scroll;
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
                                        <li><span class="bread-blod">Danh sách hóa đơn</span>
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
                                        <div class="col-md-6">
                                            <h1>Danh sách hóa đơn</h1>
                                        </div>
                                        <div class="col-md-6 class-display-none">
                                            <div class="dropdown keep-open btn-group" id="mr-sort-asc">
                                                <button class="btn btn-default dropdown-toggle" title="Sắp xếp tăng" type="button" data-toggle="dropdown"><i class="fa fa-arrow-up" aria-hidden="true"></i> 
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu animated zoomIn">
                                                  <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('id', 'ASC')">ID </a></li>
                                                </ul>
                                            </div>

                                            <button class="btn btn-default dropdown-toggle" id="mr-sort-desc" title="Sắp xếp giảm" data-toggle="dropdown" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn" role="menu">
                                                <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('id', 'DESC')">ID </a></li>
                                            </ul>
                                            <button class="btn btn-danger btn-sm pull-right m-l-10" onclick="deleteMulti()">Xóa hàng loạt</button>
                                            <button class="btn btn-info btn-sm pull-right" onclick="refreshPage()">Làm mới</button>
                                            <select class="pull-right btn-sm" onchange="changeDataForTable(this)" style="margin-right: 10px; background: #fff;color: #000; font-size: 14px;">
                                                <option value="" class="select-hd" selected="">Chọn</option>
                                                <option value="1" class="select-hd">Đặt hàng</option>
                                                <option value="2" class="select-hd">Đang ship</option>
                                                <option value="3" class="select-hd">Đã thanh toán</option>
                                                <option value="4" class="select-hd">Hủy đơn hàng</option>
                                            </select>
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
                                                <th data-field="id">ID</th>
                                                <th data-field="ma_hoa_don">Mã hóa đơn</th>
                                                <th data-field="thong_tin">Thông tin khách hàng</th>
                                                <th data-field="ghi_chu">Ghi chú</th>
                                                <th data-field="created_at">Ngày tạo</th>
                                                <th data-field="phi_ship">Phí ship</th>
                                                <th data-field="trang_thai">Trạng thái</th>
                                                <th data-field="option">Tùy chọn</th>
                                                <th data-field="state" data-checkbox="true"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($hoa_don as $hoadon)
                                            <tr>
                                                <td>{{ $hoadon->id }}</td>
                                                <td>{{ $hoadon->ma_hoa_don }}</td>
                                                <td>
                                                	<strong>Tên khách hàng: </strong>{{ $hoadon->ten_khach_hang }}<br>
                                                	<strong>Số điện thoại: </strong>{{ $hoadon->so_dien_thoai }}<br>
                                                	<strong>Email: </strong>{{ $hoadon->email }}<br>
                                                	<strong>Địa chỉ: </strong>{{ $hoadon->dia_chi }}<br>
                                                	<strong>{{ $hoadon->wards_type}}: </strong>{{ $hoadon->wards_name }}<br>
                                                	<strong>{{ $hoadon->districts_type}}: </strong>{{ $hoadon->districts_name }}<br>
                                                	<strong>{{ $hoadon->provinces_type}}: </strong>{{ $hoadon->provinces_name }}<br>
                                                </td>
                                                <td class="ghichu-hd">{{ $hoadon->ghi_chu }}</td>
                                                <td>{{ date("d/m/Y", strtotime($hoadon->created_at))}} </td>
                                                <td>{{ number_format($hoadon->phi_ship, 0, '', '.') }}₫</td>
                                                <td>
                                            	@switch($hoadon->trang_thai)
                                            		@case(1)
                                                	<select class="form-control" onchange="changeTrangThaiHD(this, {{$hoadon->id}}, {{$hoadon->trang_thai}})" style="background: #2b982b; color: white;">
												        <option value="1" class="select-hd" selected="">Đặt hàng</option>
												        <option value="2" class="select-hd">Đang ship</option>
												        <option value="3" class="select-hd">Đã thanh toán</option>
												        <option value="4" class="select-hd">Hủy đơn hàng</option>
											      	</select>
											      	@break
											      	@case(2)
											      	<select class="form-control" onchange="changeTrangThaiHD(this, {{$hoadon->id}}, {{$hoadon->trang_thai}})" style="background: #ff9600; color: white;">
												        <option value="1" class="select-hd">Đặt hàng</option>
												        <option value="2" class="select-hd" selected="">Đang ship</option>
												        <option value="3" class="select-hd">Đã thanh toán</option>
												        <option value="4" class="select-hd">Hủy đơn hàng</option>
											      	</select>
											      	@break
											      	@case(3)
											      	<select class="form-control" onchange="changeTrangThaiHD(this, {{$hoadon->id}}, {{$hoadon->trang_thai}})" style="background: #795548; color: white;">
												        <option value="1" class="select-hd">Đặt hàng</option>
												        <option value="2" class="select-hd">Đang ship</option>
												        <option value="3" class="select-hd" selected="">Đã thanh toán</option>
												        <option value="4" class="select-hd">Hủy đơn hàng</option>
											      	</select>
											      	@break
											      	@case(4)
											      	<select class="form-control" onchange="changeTrangThaiHD(this, {{$hoadon->id}}, {{$hoadon->trang_thai}})" style="background: #fb483a; color: white;">
												        <option value="1" class="select-hd">Đặt hàng</option>
												        <option value="2" class="select-hd">Đang ship</option>
												        <option value="3" class="select-hd">Đã thanh toán</option>
												        <option value="4" class="select-hd" selected="">Hủy đơn hàng</option>
											      	</select>
											      	@break
											      	@default
											      	<select class="form-control" onchange="changeTrangThaiHD(this, {{$hoadon->id}}, {{$hoadon->trang_thai}})">
											      		<option value="" class="select-hd">Chọn</option>
												        <option value="1" class="select-hd">Đặt hàng</option>
												        <option value="2" class="select-hd">Đang ship</option>
												        <option value="3" class="select-hd">Đã thanh toán</option>
												        <option value="4" class="select-hd">Hủy đơn hàng</option>
											      	</select>
									      		@endswitch
                                                </td>
                                                <td class="option-hd">
                                                    <button title="Chỉnh sửa" class="pd-setting-ed" onclick="editID({{$hoadon->id}}, this)">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$hoadon->id }});">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button title="Xem chi tiết" class="pd-setting-ed show-detail" onclick="showDetails({{$hoadon->id }}, '{{ $hoadon->ma_hoa_don }}');">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                                <td></td>
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
        <div id="modalshowdetail" class="modal modal-edu-general Customwidth-popup-WarningModal fade" role="dialog">
        </div>
        <div id="showModal">
        </div>

        <div id="modalshowedit" class="modal modal-edu-general Customwidth-popup-WarningModal fade" role="dialog">
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
	<script src="js/admin/hoadon/danhsach.js"></script>
    <!-- <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
    </script>
 -->
 @endsection