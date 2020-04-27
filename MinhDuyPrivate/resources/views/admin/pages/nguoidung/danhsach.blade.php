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
                                        <li><span class="bread-blod">Tài khoản người dùng</span>
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
                                            <h1>Danh sách tài khoản người dùng</h1>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown keep-open btn-group" id="mr-sort-asc">
                                                <button class="btn btn-default dropdown-toggle" title="Sắp xếp tăng" type="button" data-toggle="dropdown"><i class="fa fa-arrow-up" aria-hidden="true"></i> 
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu animated zoomIn">
                                                  <li><a href="javascript:void(0)" onclick="orderByData('id', 'ASC')">ID</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('name', 'ASC')">Tên tài khoản</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('displayname', 'ASC')">Tên hiển thị</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('email', 'ASC')">Email</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('lock', 'ASC')">Khóa</a></li>
                                                </ul>
                                            </div>

                                            <button class="btn btn-default dropdown-toggle" id="mr-sort-desc" title="Sắp xếp giảm" data-toggle="dropdown" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn" role="menu">
                                                <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('id', 'DESC')">ID </a></li>
                                                <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('name', 'DESC')">Tên tài khoản </a></li>
                                                <li><a href="javascript:void(0)" onclick="orderByData('displayname', 'DESC')">Tên hiển thị</a></li>
                                                <li><a href="javascript:void(0)" onclick="orderByData('email', 'DESC')">Email</a></li>
                                                <li><a href="javascript:void(0)" onclick="orderByData('lock', 'DESC')">Khóa</a></li>
                                            </ul>
                                            <button class="btn btn-success pull-right" onclick="return location.reload();">Làm mới</button>
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
                                                <th data-field="name">Tên tài khoản</th>
                                                <th data-field="displayname">Tên hiển thị</th>
                                                <th data-field="email">Email</th>
                                                <th data-field="lock">Khóa</th>
                                                <th data-field="option">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($nguoi_dung as $nguoidung)
                                            <tr>
                                                <td></td>
                                                <td>{{ $nguoidung->id }}</td>
                                                <td>{{ $nguoidung->name }}</td>
                                                <td>{{ $nguoidung->display_name }}</td>
                                                <td>{{ $nguoidung->email }}</td>
                                                <td>
                                                    @if($nguoidung->locked)
                                                    <button title="Click để đổi trạng thái" class="btn btn-warning btn-sm" onclick="changeKhoa({{$nguoidung->id}}, {{$nguoidung->locked}}, this)">
                                                        Đã khóa
                                                    </button>
                                                    @else
                                                    <button title="Click để đổi trạng thái" class="btn btn-secondary btn-sm" onclick="changeKhoa({{$nguoidung->id}}, {{$nguoidung->locked}}, this)">Không
                                                    </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$nguoidung->id }})">
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
        // Sắp xếp dữ liệu trong bảng
        function orderByData(column, type){
            let data = $('#table').bootstrapTable('getData')

            if(column == 'id' && type == 'ASC'){
                data.sort((a, b) => {
                    return a.id - b.id
                    // return ('' + a.id).localeCompare(b.id)
                })
            }
            if(column == 'id' && type == 'DESC'){
                data.sort((a, b) => {
                    return b.id - a.id
                    // return ('' + b.id).localeCompare(a.id)
                })
            }

            if(column == 'name' && type == 'ASC'){
                data.sort((a, b) => {
                    return ('' + a.name).localeCompare(b.name)
                })
            }

            if(column == 'name' && type == 'DESC'){
                data.sort((a, b) => {
                    return ('' + b.name).localeCompare(a.name)
                })
            }

            if(column == 'displayname' && type == 'ASC'){
                data.sort((a, b) => {
                    return ('' + a.displayname).localeCompare(b.displayname)
                })
            }

            if(column == 'displayname' && type == 'DESC'){
                data.sort((a, b) => {
                    return ('' + b.displayname).localeCompare(a.displayname)
                })
            }

            if(column == 'email' && type == 'ASC'){
                data.sort((a, b) => {
                    return ('' + a.email).localeCompare(b.email)
                })
            }

            if(column == 'email' && type == 'DESC'){
                data.sort((a, b) => {
                    return ('' + b.email).localeCompare(a.email)
                })
            }

            if(column == 'lock' && type == 'ASC'){
                data.sort((a, b) => {
                    return ('' + a.lock).localeCompare(b.lock)
                })
            }

            if(column == 'lock' && type == 'DESC'){
                data.sort((a, b) => {
                    return ('' + b.lock).localeCompare(a.lock)
                })
            }

            $('#table').bootstrapTable('load', {
                data: data
            })
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
                        url: 'quantri/nguoidung/xoa/' + id,
                        success: (response) => {
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

        function changeKhoa(id, trangthai, thisbutton){
            $.ajax({
                type: 'POST',
                url: 'quantri/nguoidung/changekhoa',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    locked: trangthai
                },
                success: (response) => {
                    if(response.status){
                        str = ''
                        if(response.locked){
                            str += '<button title="Click để đổi trạng thái" class="btn btn-warning btn-sm" onclick="changeKhoa(' + id + ', ' + response.locked + ', this)"> Đã khóa </button>'
                        } else {
                            str += '<button title="Click để đổi trạng thái" class="btn btn-secondary btn-sm" onclick="changeKhoa(' + id + ', ' + response.locked + ', this)"> Không</button>'
                        }
                        $('#table').bootstrapTable(
                            'updateRow', 
                            {
                                index: $(thisbutton).parent().parent().data("index"), 
                                row: {
                                    'lock': str
                                }
                            })
                        Lobibox.notify('success', {
                            size: 'mini',
                            msg: 'Thay đổi trạng thái thành công.'
                        });
                    } else {
                        Lobibox.notify('error', {
                            size: 'mini',
                            msg: 'Thay đổi trạng thái thất bại.'
                        });
                    }                        
                }
            })
        }
    </script>
    <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
    </script>
@endsection