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
                                        <li><span class="bread-blod">Kho hàng</span>
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
                                             <h1>Kho hàng</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-unique-id="id">
                                        <thead>
                                            <tr>
                                                <th data-field="id">ID</th>
                                                <th data-field="name">Tên</th>
                                                <th data-field="soluong">Số lượng</th>
                                                <th data-field="trangthai">Trạng thái hàng</th>
                                                <th data-field="option">Tùy chọn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($kho_hang as $sp)
                                            <tr>
                                                <td>{{ $sp->id }}</td>
                                                <td class="name-sp"><a href="quantri/sanpham/xem/{{$sp->id}}"><b>{{ $sp->ten }}</b></a></td>
                                                <td class="type-sp">{{$sp->so_luong}}</td>
                                                <td>
                                                    @if ($sp->so_luong>5)
                                                    <div class="status-product status-product--1">
                                                        còn hàng
                                                    </div>
                                                    @endif
                                                    @if ($sp->so_luong >0 && $sp->so_luong<5)
                                                    <div class="status-product status-product--3">
                                                       sắp hết hàng
                                                    </div>
                                                    @endif
                                                    @if ($sp->so_luong == 0)
                                                    <div class="status-product status-product--2">
                                                        hết hàng
                                                    </div>
                                                    @endif
                                                </td>
                                                <td class="option-sp">
                                                    {{-- <button title="Thêm hàng" class="pd-setting-ed" onclick="editID({{$sp->id}})">
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    </button> --}}
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
