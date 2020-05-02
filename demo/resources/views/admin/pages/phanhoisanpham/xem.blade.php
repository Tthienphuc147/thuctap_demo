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

        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15" id="hidden-loading" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <div class="row">
                                        <div class="col-md-12">
                                             <h1>{{ $san_pham->ten }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="sparkline13-graph">
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
                            <hr>
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <div class="row">
                                        <div class="col-md-12">
                                             <h1>Phản hồi</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <table class="table hover-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên khách hàng</th>
                                            <th>Email</th>
                                            <th>Nội dung</th>
                                            <th>Trạng thái</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($phan_hoi_sp as $phan_hoi)
                                        <tr id="delete-phan-hoi{{$phan_hoi->id }}">
                                            <td>{{ $phan_hoi->id}}</td>
                                            <td>{{ $phan_hoi->ten_hien_thi}}</td>
                                            <td>{{ $phan_hoi->email}}</td>
                                            <td>{{ $phan_hoi->noi_dung}}</td>
                                            <td id="change-duyet{{$phan_hoi->id }}">
                                                @if($phan_hoi->duyet)
                                                <button title="Click để đổi trạng thái" class="btn btn-secondary btn-sm" onclick="changePhanHoiDuyet({{$phan_hoi->id}}, {{$phan_hoi->duyet}})">Đã duyệt
                                                </button>
                                                @else
                                                <button title="Click để đổi trạng thái" class="btn btn-warning btn-sm" onclick="changePhanHoiDuyet({{$phan_hoi->id}}, {{$phan_hoi->duyet}})">
                                                    Chưa duyệt
                                                </button>
                                                @endif
                                            </td>
                                            <td>
                                                <button title="Xóa" class="pd-setting-ed" onclick="deletePhanHoiID({{$phan_hoi->id }})">
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
        };

        function deletePhanHoiID(id){
            $.ajax({
                type: 'GET',
                url: 'quantri/phanhoisanpham/xoa/' + id,
                success: (response)=>{
                    if(response.status){
                        removeElement('delete-phan-hoi' + id)
                        Lobibox.notify('success', {
                            size: 'mini',
                            msg: 'Xóa dữ liệu thành công.'
                        });
                    } else {
                        Lobibox.notify('error', {
                            size: 'mini',
                            msg: 'Xóa dữ liệu thất bại.'
                        });
                    }
                }
            })        
        }

        function changePhanHoiDuyet(id, trangthai){
            $.ajax({
                type: 'POST',
                url: 'quantri/phanhoisanpham/changeduyet',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    duyet: trangthai
                },
                success: (response) => {
                    if(response.status){
                        str = ''
                        if(response.duyet){
                            str += '<button title="Click để đổi trạng thái" class="btn btn-secondary btn-sm" onclick="changePhanHoiDuyet(' + id + ', ' + response.duyet + ')"> Đã duyệt</button>'
                        } else {
                            str += '<button title="Click để đổi trạng thái" class="btn btn-warning btn-sm" onclick="changePhanHoiDuyet(' + id + ', ' + response.duyet + ')"> Chưa duyệt</button>'
                        }
                        $('#change-duyet' + id).html(str)
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
@endsection