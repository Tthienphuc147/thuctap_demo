@extends('admin/layout/index')

@section('admin_css')
    <link rel="stylesheet" href="admin/css/data-table/bootstrap-table.css">
    <!-- modals CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/modals.css">
    <style>
        .modal-edu-general .modal-body.modal-add {
            text-align: left; 
            padding: 30px 50px;
        }
        .option-tt{
            min-width: 100px;
        }

        .tieu-de-tt{
            min-width: 150px;
        }

        .images-tt{
            width: 120px;
        }

        .tac-gia-tt{
            min-width: 100px;
        }
        #mr-sort-asc .btn, #mr-sort-desc {
            padding: 2px 8px;
             margin-top: 0px; 
        }

        @media only screen and (max-width: 480px){
            .option-sp{
                min-width: 100px;
            }
        }

        @media only screen and (max-width: 576px){
            .option-sp{
                min-width: 10px;
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
                                        <li><a href="quantri/trangchu">Admin</a> <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">Dịch vụ</span>
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
                                        <div class="col-md-7">
                                             <h1>Danh sách dịch vụ</h1>
                                        </div>
                                        <div class="col-md-5 class-display-none">
                                            <div class="dropdown keep-open btn-group" id="mr-sort-asc">
                                                <button class="btn btn-default dropdown-toggle" title="Sắp xếp tăng" type="button" data-toggle="dropdown"><i class="fa fa-arrow-up" aria-hidden="true"></i> 
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu animated zoomIn">
                                                  <li><a href="javascript:void(0)" onclick="orderByData('id', 'ASC')">ID</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('tieu_de', 'ASC')">Tiêu đề dịch vụ</a></li>
                                                  <li><a href="javascript:void(0)" onclick="orderByData('loai_ten', 'ASC')">Tên loại</a></li>
                                                </ul>
                                            </div>

                                            <button class="btn btn-default dropdown-toggle" id="mr-sort-desc" title="Sắp xếp giảm" data-toggle="dropdown" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn" role="menu">
                                                <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('id', 'DESC')">ID </a></li>
                                                <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('tieu_de', 'DESC')">Tiêu đề dịch vụ </a></li>
                                                <li role="menuitem"><a href="javascript:void(0)" onclick="orderByData('loai_ten', 'DESC')">Tên loại </a></li>
                                            </ul>
                                            <button class="btn btn-danger btn-sm pull-right m-l-10" onclick="deleteMulti()">Xóa hàng loạt</button>
                                            <button class="btn btn-info btn-sm pull-right m-l-10" onclick="refreshPage()">Làm mới</button>
                                            <button class="btn btn-success btn-sm pull-right m-l-10" onclick="add()">Thêm mới</button>
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
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-unique-id="id">
                                        <thead>
                                            <tr>
                                                <th data-field="id">ID</th>
                                                <th data-field="hinh_anh">Hình ảnh</th>
                                                <th data-field="tieu_de">Tiêu đề</th>
                                                <th data-field="mo_ta">Mô tả</th>
                                                <th data-field="loai_ten">Tên loại</th>
                                                <th data-field="created_at">Ngày tạo</th>
                                                <th data-field="option">Tùy chọn</th>
                                                <th data-field="state" data-checkbox="true"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dich_vu as $dich_vu)
                                            <tr>
                                                
                                                <td>{{ $dich_vu->id }}</td>
                                                <td class="images-tt">
                                                    <img src="uploads/images/services/{{ $dich_vu->hinh_anh }}" alt="">
                                                </td>
                                                <td class="tieu-de-tt">{{ $dich_vu->tieu_de }}</td>
                                                <td>{{ limitStrlen($dich_vu->mo_ta, 300) }}</td>
                                                <td>{{ $dich_vu->loai_ten }}</td>
                                                <td>{{ date("d/m/Y", strtotime($dich_vu->created_at))}} </td>
                                                <td class="option-tt">
                                                    <button title="Chỉnh sửa" class="pd-setting-ed" onclick="editID({{$dich_vu->id}}, this)">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$dich_vu->id }});">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
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
        function deleteMulti(){
            let data = $('#table').bootstrapTable('getData')
            let arrID = []
            for(let i = 0; i < data.length; i++){
                if(data[i].state) arrID.push(Number(data[i].id))
            }
            if(arrID.length > 0){
                $.ajax({
                    type: 'POST',
                    url:'quantri/dichvu/xoanhieu',
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

            if(column == 'tieu_de' && type == 'ASC'){
                data.sort((a, b) => {
                    return ('' + a.tieu_de).localeCompare(b.tieu_de)
                })
            }

            if(column == 'tieu_de' && type == 'DESC'){
                data.sort((a, b) => {
                    return ('' + b.tieu_de).localeCompare(a.tieu_de)
                })
            }

            if(column == 'admin_ten' && type == 'ASC'){
                data.sort((a, b) => {
                    return ('' + a.admin_ten).localeCompare(b.admin_ten)
                })
            }

            if(column == 'admin_ten' && type == 'DESC'){
                data.sort((a, b) => {
                    return ('' + b.admin_ten).localeCompare(a.admin_ten)
                })
            }

            if(column == 'loai_ten' && type == 'ASC'){
                data.sort((a, b) => {
                    return ('' + a.loai_ten).localeCompare(b.loai_ten)
                })
            }

            if(column == 'loai_ten' && type == 'DESC'){
                data.sort((a, b) => {
                    return ('' + b.loai_ten).localeCompare(a.loai_ten)
                })
            }

            // console.log(data)
            $('#table').bootstrapTable('load', {
                data: data
            })
        }
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };

        function editID(id){
            window.location.href="quantri/dichvu/chinhsua/" + id
        }
        function add(){
            window.location.href="quantri/dichvu/them"
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
                        url: 'quantri/dichvu/xoa/' + id,
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
    </script>
@endsection