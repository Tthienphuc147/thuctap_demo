@extends('admin/layout/index')

@section('admin_css')
    <link rel="stylesheet" href="admin/css/data-table/bootstrap-table.css">
    <!-- modals CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/modals.css">
    <style>
        #mr-sort-asc .btn, #mr-sort-desc {
            padding: 2px 8px;
             margin-top: 0px;
        }
        .modal-edu-general .modal-body.modal-add {
            text-align: left;
            padding: 30px 50px;
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
                                        <li><a href="quantri/trangchu">Quản trị </a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">Chăm sóc khách hàng <span class="bread-slash">/</span></span>
                                        <li><span class="bread-blod"> Câu hỏi thường gặp</span>
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
                                             <h1>Danh sách câu hỏi thường gặp</h1>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown keep-open btn-group" id="mr-sort-asc">
                                                <button class="btn btn-default dropdown-toggle" title="Sắp xếp tăng" type="button" data-toggle="dropdown"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu animated zoomIn">
                                                  <li><a href="javascript:void(0)" onclick="orderByData('id', 'ASC')">ID</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('cau_hoi', 'ASC')">Câu hỏi</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('tra_loi', 'ASC')">Giải đáp</a></li>
                                                </ul>
                                            </div>

                                            <button class="btn btn-default dropdown-toggle" id="mr-sort-desc" title="Sắp xếp giảm" data-toggle="dropdown" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn" role="menu">
                                                  <li><a href="javascript:void(0)" onclick="orderByData('id', 'DESC')">ID</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('cau_hoi', 'DESC')">Câu hỏi</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('tra_loi', 'DESC')">Giải đáp</a></li>
                                                </ul>
                                             <button class="btn btn-success pull-right" onclick="showModalAdd()">Thêm mới</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                   
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-unique-id="id">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="cau_hoi">Câu hỏi</th>
                                                <th data-field="tra_loi">Trả lời</th>
                                                <th data-field="option">Tác vụ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($giai_dap as $gd)
                                            <tr>
                                            	<td></td>
                                            	<td>{{$gd->id}}</td>
                                            	<td>{{$gd->cau_hoi}}</td>
                                            	<td>{!!$gd->tra_loi!!}</td>
                                            	<td>
                                            		<button title="Chỉnh sửa" class="pd-setting-ed" onclick="editID({{$gd->id}}, this)">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$gd->id}});">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
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
        <div id="modaladd" class="modal modal-edu-general Customwidth-popup-WarningModal fade" role="dialog">
        </div>

        <div id="modaledit" class="modal modal-edu-general Customwidth-popup-WarningModal fade" role="dialog">

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

     <script src="js/admin/chamsockhachhang/cauhoithuonggap.js"></script>
    <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
    </script>
@endsection
