@extends('admin/layout/index')

@section('admin_css')
    <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/form/all-type-forms.css">
    <style>
        .cursor-none{
            cursor: default;
        }
        .btn-default:hover{
            background: white;
            border-color: black; 
        }
        .fa.fa-close:hover {
            color: red;
            cursor: pointer;
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
                                        <li>Cài đặt <span class="bread-slash">/</span>
                                        </li>
                                        <li><span class="bread-blod">Tin tức</span>
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
        <!-- Basic Form Start -->
        <div class="basic-form-area mg-b-15" id="hidden-loading" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list" style="padding-bottom: 0px;">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h1>Cài đặt tin tức</h1>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-success btn-sm pull-right" onclick="edit()" name="edit">Chỉnh sửa</button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="sparkline12-graph">
                                <form id="form-cai-dat-tin-tuc" method="POST" enctype="application/x-www-form-urlencoded">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Số lượng danh mục tin tức</label>
                                            <input type="number" readonly onKeyPress="return khongNhapKyTu(event);" class="form-control" placeholder="Nhập số lượng danh mục tin tức" required="" name="so_luong_danh_muc" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_tin_tuc->so_luong_danh_muc }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Số lượng thể loại tin tức</label>
                                            <input type="number" readonly onKeyPress="return khongNhapKyTu(event);" class="form-control" placeholder="Nhập số lượng thể loại tin tức" required="" name="so_luong_the_loai" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_tin_tuc->so_luong_the_loai }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Số lượng tất cả tin tức</label>
                                            <input type="number" readonly onKeyPress="return khongNhapKyTu(event);" class="form-control" placeholder="Nhập số lượng tất cả tin tức" required="" name="so_luong_tat_ca" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_tin_tuc->so_luong_tat_ca }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Số lượng tìm kiếm tin tức</label>
                                            <input type="number" readonly onKeyPress="return khongNhapKyTu(event);" class="form-control" placeholder="Nhập số lượng tìm kiếm tin tức" required="" name="so_luong_tim_kiem" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')" value="{{ $cai_dat_tin_tuc->so_luong_tim_kiem }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn btn-sm btn-success pull-right" name="save" style="display: none;">Lưu lại</button>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button type="button" class="btn btn-sm btn-danger" name="destroy" style="display: none;" onclick="destroyTinTuc()">Hủy bỏ</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic Form Start -->

        <!-- Basic Form Start -->
        <div class="data-table-area mg-b-15" id="hidden-loading1" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1>Cài đặt từ khóa</h1>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="sparkline12-graph">
                                 <form id="form-cai-dat-tu-khoa" method="POST" enctype="application/x-www-form-urlencoded">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Từ khóa</label>
                                            <input type="text" class="form-control" placeholder="Nhập từ khóa" required="" name="tu_khoa" oninvalid="this.setCustomValidity('Vui lòng điền trường này')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn btn-success" style="margin-top: 25px;">Thêm</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 style="margin-top: 20px;">Danh sách từ khóa</h5>
                                    </div>
                                </div>
                                <?php 
                                    $arrTuKhoa = explode(',', $cai_dat_tin_tuc->tu_khoa);
                                ?>
                                <div class="row">
                                    <div class="col-md-12" id="list-tu-khoa">
                                        @foreach($arrTuKhoa as $tu_khoa)
                                        @if($tu_khoa != '')
                                        <button class="btn btn-default" style="margin-right: 10px; margin-top: 5px; cursor: default;">{{ $tu_khoa }}
                                            <i class="fa fa-close" style="margin-left: 5px;" onclick="deleteTuKhoa('{{ $tu_khoa }}')"></i>
                                        </button>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic Form Start -->
@endsection

@section('admin_script')
   <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
            document.getElementById('hidden-loading1').style.display = 'block'
        };

        function edit(){
            let listInputs = $('#form-cai-dat-tin-tuc input')
            $.each(listInputs, function( key, value ) {
                if(value.hasAttribute('readonly')){
                    value.removeAttribute('readonly')
                }
            })
            $('button[name*=save]').css('display', 'inline')
            $('button[name*=destroy]').css('display', 'inline')
            $('button[name*=edit]').css('display', 'none')
        }

        $('#form-cai-dat-tin-tuc').submit((e) => {
            $.ajax({
                type: 'POST',
                url: 'quantri/caidat/tintuc/chinhsua',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#form-cai-dat-tin-tuc').serialize(),
                success: (response) =>{
                    //console.log(response)
                    if(response.status){
                        let listInputs = $('#form-cai-dat-tin-tuc input')
                        $.each(listInputs, function( key, value ) {
                            if(!value.hasAttribute('readonly')){
                                value.setAttribute('readonly', '')
                            }
                        })
                        $('button[name*=save]').css('display', 'none')
                        $('button[name*=destroy]').css('display', 'none')
                        $('button[name*=edit]').css('display', 'inline')
                        Lobibox.notify('success', {
                            size: 'mini',
                            msg: "Thay đổi dữ liệu thành công."
                        });
                    } else {
                        Lobibox.notify('error', {
                            size: 'mini',
                            msg: "Thay đổi dữ liệu thất bại."
                        });
                    }
                },
                error: (error) => {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: "Lỗi không lấy được dữ liệu.\nVui lòng thử lại."
                    });
                }
            })
            e.preventDefault();
        })

        function destroyTinTuc(){
            location.reload()
        } 

        function deleteTuKhoa(tukhoa){
            $.ajax({
                type: 'POST',
                url: 'quantri/caidat/tintuc/xoatukhoa',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    tu_khoa: tukhoa
                },
                success: (response) =>{
                    //console.log(response)
                    if(response.status){
                        if(!response.check_str){
                            Lobibox.notify('warning', {
                                size: 'mini',
                                msg: "Từ khóa không tồn tại."
                            });
                        } else {
                            let str = ''
                            let arr = response.str_tu_khoa.split(',')
                            for (let i = 0; i < arr.length; i++) {
                                if(arr[i] != ''){
                                    str += '<button class="btn btn-default" style="margin-right: 10px; margin-top: 5px; cursor: default;">' + arr[i]
                                    str += '<i class="fa fa-close" style="margin-left: 5px;" onclick="deleteTuKhoa(\'' + arr[i] + '\')"></i>'
                                    str += '</button>'
                                }
                            }
                            $('#list-tu-khoa').html(str)

                            Lobibox.notify('success', {
                                size: 'mini',
                                msg: "Xóa từ khóa thành công."
                            });
                        }
                    } else {
                        Lobibox.notify('error', {
                            size: 'mini',
                            msg: "Xóa từ khóa thất bại."
                        });
                    }
                },
                error: (error) => {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: "Lỗi kết nối với cơ sở dữ liệu.\nVui lòng thử lại."
                    });
                }
            })
        }

        $('#form-cai-dat-tu-khoa').submit((e) => {
            $.ajax({
                type: 'POST',
                url: 'quantri/caidat/tintuc/themtukhoa',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#form-cai-dat-tu-khoa').serialize(),
                success: (response) =>{
                    //console.log(response)
                    if(response.status){
                        if(response.check_str){
                            Lobibox.notify('warning', {
                                size: 'mini',
                                msg: "Từ khóa đã tồn tại."
                            });
                        } else {
                            $('#form-cai-dat-tu-khoa input[name*=tu_khoa]').val('')
                            let str = ''
                            let arr = response.str_tu_khoa.split(',')
                            for (let i = 0; i < arr.length; i++) {
                                if(arr[i] != ''){
                                    str += '<button class="btn btn-default" style="margin-right: 10px; margin-top: 5px; cursor: default;">' + arr[i]
                                    str += '<i class="fa fa-close" style="margin-left: 5px;" onclick="deleteTuKhoa(\'' + arr[i] + '\')"></i>'
                                    str += '</button>'
                                }
                            }
                            $('#list-tu-khoa').html(str)

                            Lobibox.notify('success', {
                                size: 'mini',
                                msg: "Thêm từ khóa thành công."
                            });
                        }
                    } else {
                        Lobibox.notify('error', {
                            size: 'mini',
                            msg: "Thêm từ khóa thất bại."
                        });
                    }
                },
                error: (error) => {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: "Lỗi kết nối với cơ sở dữ liệu.\nVui lòng thử lại."
                    });
                }
            })
            e.preventDefault();
        })     
    </script>
@endsection