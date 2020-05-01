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
                                        <li><span class="bread-blod">Tài khoản quản trị viên</span>
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
                                             <h1>Danh sách tài khoản quản trị viên</h1>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown keep-open btn-group" id="mr-sort-asc">
                                                <button class="btn btn-default dropdown-toggle" title="Sắp xếp tăng" type="button" data-toggle="dropdown"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu animated zoomIn">
                                                  <li><a href="quantri/quantrivien/danhsach">ID</a></li>
                                                  <li><a href="quantri/quantrivien/danhsach/ten/asc">Tên</a></li>
                                                </ul>
                                            </div>

                                            <button class="btn btn-default dropdown-toggle" id="mr-sort-desc" title="Sắp xếp giảm" data-toggle="dropdown" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn" role="menu">
                                                <li role="menuitem"><a href="quantri/quantrivien/danhsach/id/desc">ID </a></li>
                                                <li role="menuitem"><a href="quantri/quantrivien/danhsach/ten/desc">Tên </a></li>
                                            </ul>
                                            <button class="btn btn-success pull-right" onclick="add()">Thêm mới</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">

                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="id">ID</th>
                                                <th data-field="name">Tên tài khoản</th>
                                                <th data-field="email">Email</th>
                                                <th data-field="role">Cấp bậc</th>
                                                <th data-field="option">Tùy chọn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($quan_tri_vien as $quan_tri)
                                            <tr>
                                                <td>{{ $quan_tri->id }}</td>
                                                <td>{{ $quan_tri->name }}</td>

                                                <td>{{ $quan_tri->email }}</td>
                                                <td>
                                                    @switch($quan_tri->role)
                                                        @case("admin")
                                                            Quản trị hệ thống
                                                            @break
                                                        @case("nv")
                                                            Nhân viên
                                                            @break
                                                        @default

                                                    @endswitch
                                                </td>
                                                <td>
                                                    <button title="Chỉnh sửa" class="pd-setting-ed" onclick="editID({{$quan_tri->id}})">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$quan_tri->id }});">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button title="Phân quyền" class="pd-setting-ed bg-red" onclick="getPermission({{$quan_tri->id }});">
                                                        <i class="fa fa-trello " aria-hidden="true"></i>
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

    <script>
        function add(){
            window.location.href="quantri/quantrivien/them"
        }

        function deleteID(id) {
            swal({
                title: "Bạn có chắc chắn muốn xóa dữ liệu?",
                text: "Sau khi xóa, dữ liệu sẽ không thể khôi phục!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isConfirm) => {
                if (isConfirm) {
                    $.ajax({
                        type: 'GET',
                        url: 'quantri/quantrivien/xoa/' + id,
                        success: (response) => {
                            console.log(response)
                            if(response.status){
                                $('#table').bootstrapTable('removeByUniqueId', id)
                                Lobibox.notify('success', {
                                    size: 'mini',
                                    msg: "Xóa dữ liệu thành công."
                                });
                            } else {
                                Lobibox.notify('error', {
                                    size: 'mini',
                                    msg: "Xóa dữ liệu thất bại."
                                });
                            }

                        },
                        error: (error) => {
                            Lobibox.notify('error', {
                                size: 'mini',
                                msg: "Lỗi không xóa được dữ liệu."
                            });
                        }
                    })
                } else {
                    swal("Dữ liệu không thay đổi!")
                }
            });
        }
        function editID(id){
            window.location.href="quantri/quantrivien/chinhsua/" + id
        }
        function getPermission(id){
            window.location.href="quantri/quantrivien/phanquyen/" + id
        }
    </script>
    <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
    </script>
@endsection
