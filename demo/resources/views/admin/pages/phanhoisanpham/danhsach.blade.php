@extends('admin/layout/index')

@section('admin_css')
    <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/form/all-type-forms.css">
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
                                            <input type="text" placeholder="Search..." class="search-int form-control">
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
                            <div class="pt-5" style="min-height: 50vh;">
                                <div class="loading-spinner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loading End -->
        <!-- Basic Form Start -->
        <div class="mailbox-view-area mg-b-15" id="hidden-loading" style="display: none;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="hpanel shadow-inner responsive-mg-b-30">
                            <div class="panel-body">
                                <?php $temploai = -1; ?>
                                @for($i = 0; $i < count($loai_sp); $i++)
                                @if($loai_sp[$i]->danhmucid != $temploai && $i != 0)
                                </ul>
                                @endif
                                @if($loai_sp[$i]->danhmucid != $temploai)
                                <button class="btn btn-success compose-btn btn-block m-b-md">{{$loai_sp[$i]->danhmucten}}</button>
                                <ul class="mailbox-list">
                                @endif
                                    <li>
                                        <a href="javascript:void(0)" onclick="ajaxPhanHoi({{$loai_sp[$i]->loaiid}})"><i class="fa fa-paper-plane text-warning"></i>{{ $loai_sp[$i]->loaiten }}</a>
                                    </li>
                                @if($i == count($loai_sp) - 1)
                                </ul>
                                @endif
                                <?php $temploai = $loai_sp[$i]->danhmucid; ?>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="sparkline13-graph">
                            <div class="sparkline13-list">
                                <div class="sparkline13-hd">
<div class="admin-pro-accordion-wrap shadow-inner responsive-mg-b-30">
    <div class="panel-group edu-custon-design" id="accordion">
        <?php $temp = -1; ?>
        @for($i = 0; $i < count($phan_hoi_sp); $i++)
        @if($temp != $phan_hoi_sp[$i]->spid && $i != 0)
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        @if($temp != $phan_hoi_sp[$i]->spid)
        <div class="panel panel-default">
            <div class="panel-heading accordion-head">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$phan_hoi_sp[$i]->spid}}">{{$phan_hoi_sp[$i]->spten}}</a>
                </h4>
            </div>
            <div id="collapse{{$phan_hoi_sp[$i]->spid}}" class="panel-collapse panel-ic collapse">
                <div class="panel-body admin-panel-content animated bounce">
                    <table class="table hover-table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Nội dung</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
        @endif
                            <tr id="column{{$phan_hoi_sp[$i]->phanhoiid }}">
                                <td>
                                    <p><strong>{{$phan_hoi_sp[$i]->ten_hien_thi}} </strong><span class="pointed"><i class="text-primary" onclick="copyText(this, '{{$phan_hoi_sp[$i]->email}}')">{{$phan_hoi_sp[$i]->email}}</i></span>
                                        <br>
                                        {{$phan_hoi_sp[$i]->noi_dung}}
                                    </p>
                                </td>
                                <td id="change-duyet{{$phan_hoi_sp[$i]->phanhoiid }}">
                                    @if($phan_hoi_sp[$i]->duyet)
                                    <button title="Click để đổi trạng thái" class="btn btn-secondary btn-sm" onclick="changePhanHoiDuyet({{$phan_hoi_sp[$i]->phanhoiid}}, {{$phan_hoi_sp[$i]->duyet}})">Đã duyệt
                                    </button>
                                    @else
                                    <button title="Click để đổi trạng thái" class="btn btn-warning btn-sm" onclick="changePhanHoiDuyet({{$phan_hoi_sp[$i]->phanhoiid}}, {{$phan_hoi_sp[$i]->duyet}})">
                                        Chưa duyệt
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    <button title="Xóa" class="pd-setting-ed" onclick="deleteID({{$phan_hoi_sp[$i]->phanhoiid }});">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
        @if($temp == count($phan_hoi_sp) - 1)
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        <?php $temp = $phan_hoi_sp[$i]->spid; ?>
        @endfor
    </div>
    
</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('admin_script')
    <script>
        window.onload = function () {
            document.getElementById('show-loading').style.display = 'none'
            document.getElementById('hidden-loading').style.display = 'block'
        };
        function copyText(ele, str){
            const el = document.createElement('textarea');
            el.value = str;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            ele.setAttribute('data-tooltip-el', 'copied')
            setTimeout(() => {
                ele.removeAttribute('data-tooltip-el', 'copied')
            }, 1000)
        }

        function ajaxPhanHoi(loaiid){
            $.ajax({
                type: 'POST',
                url: 'quantri/phanhoisanpham/changephanhoi',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    loaiid: loaiid,
                },
                success: function(response){
                    if(response.status){
                        var str = ''
                        var temp = -1;
                        for(let i = 0; i < response.phan_hoi_sp.length; i++){
                            if(i != 0 && temp != response.phan_hoi_sp[i].spid){
                                str += '</tbody></table></div></div></div>'
                            }
                            if(temp != response.phan_hoi_sp[i].spid){
                                str += '<div class="panel panel-default">'
                                str += '<div class="panel-heading accordion-head">'
                                str += '<h4 class="panel-title">'
                                str += '<a data-toggle="collapse" data-parent="#accordion" href="#collapse' + response.phan_hoi_sp[i].spid + '">' + response.phan_hoi_sp[i].spten + '</a>'
                                str += '</h4></div>'
                                str += '<div id="collapse' + response.phan_hoi_sp[i].spid + '" class="panel-collapse panel-ic collapse">'
                                str += '<div class="panel-body admin-panel-content animated bounce">'
                                str += '<table class="table hover-table table-bordered">'
                                str += '<thead><tr>'
                                str += '<th class="text-center">Nội dung</th>'
                                str += '<th class="text-center">Trạng thái</th>'
                                str += '<th class="text-center">Xóa</th>'
                                str += '</tr>'
                                str += '</thead>'
                                str += '<tbody>'
                            }
                            
                            str += '<tr id="column' + response.phan_hoi_sp[i].phanhoiid + '">'
                            str += '<td>'
                            str += '<p><strong>' + response.phan_hoi_sp[i].ten_hien_thi + '</strong><span class="pointed"><i class="text-primary" onclick="copyText(this, \'' + response.phan_hoi_sp[i].email + '\')">' + response.phan_hoi_sp[i].email + '</i></span>'
                            str += '<br>' + response.phan_hoi_sp[i].noi_dung + '</p>'
                            str += '</td>'
                            str += '<td id="change-duyet' + response.phan_hoi_sp[i].phanhoiid + '">'
                            if(response.phan_hoi_sp[i].duyet){
                                str += '<button title="Click để đổi trạng thái" class="btn btn-secondary btn-sm" onclick="changePhanHoiDuyet(' + response.phan_hoi_sp[i].phanhoiid + ', ' + response.phan_hoi_sp[i].duyet + ')"> Đã duyệt</button>'
                            } else {
                                str += '<button title="Click để đổi trạng thái" class="btn btn-warning btn-sm" onclick="changePhanHoiDuyet(' + response.phan_hoi_sp[i].phanhoiid + ', ' + response.phan_hoi_sp[i].duyet + ')"> Chưa duyệt</button>'
                            }
                            
                            str += ''
                            str += '</td>'
                            str += '<td><button title="Xóa" class="pd-setting-ed" onclick="deleteID(' + response.phan_hoi_sp[i].phanhoiid + ')">'
                            str += '<i class="fa fa-trash-o" aria-hidden="true"></i>'
                            str += '</button></td>'
                            str += '</tr>'
                            if(temp == response.phan_hoi_sp.length - 1){
                                str += '</tbody></table></div></div></div>' 
                            }

                            temp = response.phan_hoi_sp[i].spid
                        }
                                
                        $('#accordion').html(str)
                    } else {
                        alert('in ra man hinh ko co du lieu')
                    }
                }
            })

        }

        function deleteID (phanhoiid){
            $.ajax({
                type: 'GET',
                url: 'quantri/phanhoisanpham/xoa/' + phanhoiid,
                success: function(response){
                    if(response.status){
                        removeElement('column' + phanhoiid)
                        Lobibox.notify('success', {
                            size: 'mini',
                            msg: "Xóa dữ liệu thành công"
                        });
                    } else {
                        Lobibox.notify('error', {
                            size: 'mini',
                            msg: "Xóa dữ liệu thất bại"
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