@extends('admin/layout/index')

@section('admin_css')
    <link rel="stylesheet" href="admin/css/data-table/bootstrap-table.css">
    <style>
        #mr-sort-asc .btn, #mr-sort-desc {
            padding: 2px 8px;
             margin-top: 0px;
        }
        .width-150{
            min-width: 150px;
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
                                        <li><span class="bread-blod">Chăm sóc khách hàng /</span></li>
                                        <li><span class="bread-blod">Hỗ trợ</span></li>
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
                                        <div class="col-md-8">
                                            <h1>Danh sách hỗ trợ</h1>
                                        </div>
                                        <div class="col-md-4 class-display-none">
                                            <div class="dropdown keep-open btn-group" id="mr-sort-asc">
                                                <button class="btn btn-default dropdown-toggle" title="Sắp xếp tăng" type="button" data-toggle="dropdown"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu animated zoomIn">
                                                  <li><a href="javascript:void(0)" onclick="orderByData('id', 'ASC')">ID</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('ten', 'ASC')">Tên</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('email', 'ASC')">Email</a></li>
                                                </ul>
                                            </div>

                                            <button class="btn btn-default dropdown-toggle" id="mr-sort-desc" title="Sắp xếp giảm" data-toggle="dropdown" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn" role="menu">
                                                <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('id', 'DESC')">ID </a></li>
                                                <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('ten', 'DESC')">Tên </a></li>
                                                <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('email', 'DESC')">Email </a></li>
                                            </ul>
                                            <button class="btn btn-danger btn-sm pull-right m-l-10" onclick="deleteMulti()">Xóa hàng loạt</button>
                                            <button class="btn btn-info btn-sm pull-right m-l-10" onclick="refreshPage()">Làm mới</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">

                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-unique-id="id">
                                        <thead>
                                            <tr>
                                                <th data-field="id">ID</th>
                                                <th data-field="ten">Tên</th>
                                                <th data-field="email">Email</th>
                                                <th data-field="lien_he">Liên hệ</th>
                                                <th data-field="noi_dung">Nội dung</th>
                                                <th data-field="option">Xóa</th>
                                                <th data-field="state" data-checkbox="true"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ho_tro as $ho_tro)
                                            @if(!$ho_tro->is_read)
                                            <tr class="info">
                                                <td>{{ $ho_tro->id }}</td>
                                                <td class="width-150">{{ $ho_tro->ho_ten }}</td>
                                                <td>{{ $ho_tro->email }}</td>
                                                <td>{{ $ho_tro->lien_he }}</td>
                                                <td>{{ $ho_tro->noi_dung }}</td>
                                                <td>
                                                    <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$ho_tro->id }});">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                                <td></td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td>{{ $ho_tro->id }}</td>
                                                <td class="width-150">{{ $ho_tro->ho_ten }}</td>
                                                <td>{{ $ho_tro->email }}</td>
                                                <td>{{ $ho_tro->lien_he }}</td>
                                                <td>{{ $ho_tro->noi_dung }}</td>
                                                <td>
                                                    <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$ho_tro->id }});">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                                <td></td>
                                            </tr>
                                            @endif
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
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
            $.ajax({
                type: 'POST',
                url: 'quantri/chamsockhachhang/hotro/changeisread',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    // if(response.status){
                    //     Lobibox.notify('success', {
                    //         size: 'mini',
                    //         msg: "Xóa dữ liệu thành công."
                    //     });
                    // }
                },
                error: (error) => {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: "Lỗi kết nối với cơ sở dữ liệu."
                    });
                }
            })

        };
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

            if(column == 'ten' && type == 'ASC'){
                data.sort((a, b) => {
                    return ('' + a.ten).localeCompare(b.ten)
                })
            }

            if(column == 'ten' && type == 'DESC'){
                data.sort((a, b) => {
                    return ('' + b.ten).localeCompare(a.ten)
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

            // console.log(data)
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
                        url: 'quantri/chamsockhachhang/hotro/xoa/' + id,
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

        function deleteMulti(){
            let data = $('#table').bootstrapTable('getData')
            let arrID = []
            for(let i = 0; i < data.length; i++){
                if(data[i].state) arrID.push(Number(data[i].id))
            }
            if(arrID.length > 0){
                $.ajax({
                    type: 'POST',
                    url:'quantri/chamsockhachhang/hotro/xoanhieu',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        arrID: arrID
                    },
                    success: function(response){
                        console.log(response)
                        if(response.status){
                            for(let i = 0; i < arrID.length; i++){
                                $('#table').bootstrapTable('removeByUniqueId', arrID[i])
                            }
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
                            msg: "Lỗi kết nối cơ sở dữ liệu.\nVui lòng thử lại."
                        });
                    }
                })
            } else {
                Lobibox.notify('warning', {
                    size: 'mini',
                    msg: "Chọn dữ liệu trước khi xóa hàng loạt."
                });
            }
        }
    </script>
@endsection
