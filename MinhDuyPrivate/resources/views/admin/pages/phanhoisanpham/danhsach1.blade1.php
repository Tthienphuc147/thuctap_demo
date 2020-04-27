@extends('admin/layout/index')

@section('admin_css')
    <link rel="stylesheet" href="admin/css/data-table/bootstrap-table.css">
    <style>
        [data-tooltip-el] {
          position: absolute;
          z-index: 10;
        }

        /* Positioning and visibility settings of the tooltip */
        [data-tooltip-el]:before,
        [data-tooltip-el]:after {
          position: absolute;
          visibility: hidden;
          opacity: 0;
          left: 50%;
          bottom: calc(100% + 5px);
          pointer-events: none;
          transition: 0.2s;
          will-change: transform;
        }

        /* The actual tooltip with a dynamic width */
        [data-tooltip-el]:before {
          content: attr(data-tooltip-el);
          padding: 1px 9px;
          min-width: 50px;
          max-width: 300px;
          width: max-content;
          width: -moz-max-content;
          border-radius: 6px;
          font-size: 14px;
          background-color: rgba(59, 72, 80, 0.9);
          background-image: linear-gradient(30deg,
            rgba(59, 72, 80, 0.44),
            rgba(59, 68, 75, 0.44),
            rgba(60, 82, 88, 0.44));
          box-shadow: 0px 0px 24px rgba(0, 0, 0, 0.2);
          color: #fff;
          text-align: center;
          white-space: pre-wrap;
          transform: translate(-50%, -5px) scale(0.5);
        }

        /* Tooltip arrow */
        [data-tooltip-el]:after {
          content: '';
          border-style: solid;
          border-width: 5px 5px 0px 5px;
          border-color: rgba(55, 64, 70, 0.9) transparent transparent transparent;
          transition-duration: 0s;
          transform-origin: top;
          transform: translateX(-50%) scaleY(0);
        }

        [data-tooltip-el]:before,
        [data-tooltip-el]:after {
          visibility: visible;
          opacity: 1
        }

        [data-tooltip-el]:before {
          transition-delay: 0.3s;
          transform: translate(-50%, -5px) scale(1);
        }
        /* Slide down effect only on mouseenter (NOT on mouseleave) */
        [data-tooltip-el]:after {
          transition-delay: 0.5s; /* Starting after the grow effect */
          transition-duration: 0.2s;
          transform: translateX(-50%) scaleY(1);
        }

        .pointed{
            cursor: pointer;
        }
        .custom-datatable-overright table tbody tr td a {
            color: white;
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
                                        <li><span class="bread-blod">Phản hồi sản phẩm</span>
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
                                             <h1>Danh sách phản hồi sản phẩm</h1>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="dropdown keep-open btn-group" id="mr-sort-asc">
                                                <button class="btn btn-default dropdown-toggle" title="Sắp xếp tăng" type="button" data-toggle="dropdown"><i class="fa fa-arrow-up" aria-hidden="true"></i> 
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu animated zoomIn">
                                                  <li><a href="quantri/danhmucsanpham/danhsach">ID</a></li>
                                                  <li><a href="quantri/danhmucsanpham/danhsach/ten/asc">Tên</a></li>
                                                </ul>
                                            </div>

                                            <button class="btn btn-default dropdown-toggle" id="mr-sort-desc" title="Sắp xếp giảm" data-toggle="dropdown" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn" role="menu">
                                                <li role="menuitem"><a href="quantri/danhmucsanpham/danhsach/id/desc">ID </a></li>
                                                <li role="menuitem"><a href="quantri/danhmucsanpham/danhsach/ten/desc">Tên </a></li>
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
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="name">Tên loại sản phẩm</th>
                                                <th data-field="noidung">Nội dung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php $temploai = -1;?>
@for($i = 0; $i < count($loai_sp); $i++)

@if($temploai != $loai_sp[$i]->id && $i != 0)
        </div>
    </td>
</tr>
        @endif              
@if($temploai != $loai_sp[$i]->id)
<tr>
    <td></td>
    <td>
        {{ $loai_sp[$i]->id }}
    </td>
    <td>{{ $loai_sp[$i]->ten }}</td>
    <td>
        
@endif
            <?php $tempsp = -1; ?>
            @for($j = 0; $j < count($phan_hoi_sp); $j++)
            @if($phan_hoi_sp[$j]->loaiid == $loai_sp[$i]->id)
            @if($tempsp != $phan_hoi_sp[$j]->spid && $j != 0)
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                @endif
                @if($tempsp != $phan_hoi_sp[$j]->spid)
            <div class="panel-group edu-custon-design" id="accordionn">
                <div class="panel panel-default">
                    <div class="panel-heading accordion-head">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordionn" href="#collapse1">{{$phan_hoi_sp[$j]->spten}}</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse panel-ic collapse">
                        <div class="panel-body admin-panel-content animated bounce">
                            <table class="table hover-table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nội dung</th>
                                        <th class="text-center">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                @endif
                                    <tr>
                                        <td>
                                            <p><strong>Nguyễn Văn A </strong><span class="pointed"><i class="text-primary" onclick="copyText(this, '123123')">nguyenvana@gmail.com</i></span>
                                                <br>
                                                Đây là bình luận của anh A
                                            </p>
                                        </td>
                                        <td>
                                            <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$loai_sp[$i]->id }});">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                @if($tempsp == count($phan_hoi_sp) - 1)
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                @endif
                <?php $tempsp = $phan_hoi_sp[$j]->spid; ?>
            @endif
            @endfor
@if($i == count($loai_sp) - 1)
        
    </td>
</tr>
@endif  
<?php 
    $temploai = $loai_sp[$i]->id;
?>
@endfor
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
    <script src="js/phanhoisp/danhsach.js"></script>
    <script>
        function editID(id){
            window.location.href="quantri/danhmucsanpham/chinhsua/" + id
        }

        function add(){
            window.location.href="quantri/danhmucsanpham/them"
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
                    window.location.href = "quantri/danhmucsanpham/xoa/" + id
                } else {
                    swal("Dữ liệu không thay đổi!")
                }
            });
        }   
    </script>
    <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };

    </script>
@endsection