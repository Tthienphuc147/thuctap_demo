<div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="quantri/trangchu"><img class="main-logo" src="admin/image/logo.png" alt="" /></a>
                <strong><a href="quantri/trangchu"><img src="uploads/favicon.png" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li>
                            <a class="has-arrow" href="javascript:void(0)">
                               <span class="icon-wrap"><i class="fa fa-home"></i></span>
                               <span class="mini-click-non">Trang chủ</span>
                            </a>
                        </li>
                        @if (request()->session()->get('quyen_danh_muc_san_pham') == 1 || request()->session()->get('quyen_loai_san_pham') == 1
                        || request()->session()->get('quyen_san_pham') == 1 || request()->session()->get('quyen_phan_hoi_san_pham') == 1)
                            <li>
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <span class="icon-wrap"><i class="fa fa-cubes"></i></span>
                                    <span class="mini-click-non">Sản phẩm </span>
                                </a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    @if (request()->session()->get('quyen_danh_muc_san_pham') == 1)
                                    <li><a title="Danh mục sản phẩm" href="quantri/danhmucsanpham/danhsach"><span class="mini-sub-pro">Danh mục sản phẩm</span></a></li>
                                    @endif
                                    @if (request()->session()->get('quyen_loai_san_pham') == 1)
                                    <li><a title="Loại sản phẩm" href="quantri/loaisanpham/danhsach"><span class="mini-sub-pro">Loại sản phẩm</span></a></li>
                                    @endif
                                    @if (request()->session()->get('quyen_san_pham') == 1)
                                    <li><a title="Sản phẩm" href="quantri/sanpham/danhsach"><span class="mini-sub-pro">Sản phẩm</span></a></li>
                                    @endif
                                    @if (request()->session()->get('quyen_phan_hoi_san_pham') == 1)
                                    <li><a title="Phản hồi sản phẩm" href="quantri/phanhoisanpham/danhsach"><span class="mini-sub-pro">Phản hồi sản phẩm</span></a></li>
                                    @endif



                                </ul>
                            </li>
                        @endif

                        @if (request()->session()->get('quyen_danh_sach_hoa_don') == 1)
                        <li>
                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon-wrap"><i class="fa fa-address-card"></i></span>
                                <span class="mini-click-non">Hóa đơn </span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                @if (request()->session()->get('quyen_danh_sach_hoa_don') == 1)
                                <li><a title="Danh mục sản phẩm" href="quantri/hoadon/danhsach"><span class="mini-sub-pro">Danh sách hóa đơn</span></a></li>
                                @endif

                            </ul>
                        </li>
                        @endif
                        <li>
                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon-wrap"><i class="fa fa-dropbox"></i></span>
                                <span class="mini-click-non">Kho hàng </span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Kho hàng" href="quantri/khohang/danhsach"><span class="mini-sub-pro">Quản lý kho hàng</span></a></li>
                            </ul>
                        </li>
                        @if (request()->session()->get('quyen_danh_muc_tin_tuc') == 1 || request()->session()->get('quyen_loai_tin_tuc') == 1
                        || request()->session()->get('quyen_tin_tuc') == 1)
                          <li>
                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon-wrap"><i class="fa fa-edit"></i></span>
                                <span class="mini-click-non">Tin tức </span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                @if (request()->session()->get('quyen_danh_muc_tin_tuc') == 1)
                                <li><a title="Danh mục tin tức" href="quantri/danhmuctintuc/danhsach"><span class="mini-sub-pro">Danh mục tin tức</span></a></li>
                                @endif
                                @if (request()->session()->get('quyen_loai_tin_tuc') == 1)
                                <li><a title="Loại tin tức" href="quantri/loaitintuc/danhsach"><span class="mini-sub-pro">Loại tin tức</span></a></li>
                                @endif
                                @if (request()->session()->get('quyen_tin_tuc') == 1)
                                <li><a title="Tin tức" href="quantri/tintuc/danhsach"><span class="mini-sub-pro">Tin tức</span></a></li>
                                @endif



                            </ul>
                        </li>
                        @endif
                        @if (request()->session()->get('quyen_danh_muc_dich_vu') == 1 || request()->session()->get('quyen_loai_dich_vu') == 1 || request()->session()->get('quyen_dich_vu') == 1)
                        <li>
                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon-wrap"><i class="fa fa-sellsy"></i></span>
                                <span class="mini-click-non">Dịch vụ </span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                @if (request()->session()->get('quyen_danh_muc_dich_vu') == 1)
                                <li><a title="Danh mục dịch vụ" href="quantri/danhmucdichvu/danhsach"><span class="mini-sub-pro">Danh mục dịch vụ</span></a></li>
                                @endif
                                @if (request()->session()->get('quyen_loai_dich_vu') == 1)
                                <li><a title="Loại dịch vụ" href="quantri/loaidichvu/danhsach"><span class="mini-sub-pro">Loại dịch vụ</span></a></li>
                                @endif
                                @if (request()->session()->get('quyen_dich_vu') == 1)
                                <li><a title="Dịch vụ" href="quantri/dichvu/danhsach"><span class="mini-sub-pro">Dịch vụ</span></a></li>
                                @endif



                            </ul>
                        </li>
                        @endif
                        @if (request()->session()->get('quyen_quan_tri_vien') == 1 || request()->session()->get('quyen_nguoi_dung') == 1)
                        <li>
                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon-wrap"><i class="fa fa-users"></i></span>
                                <span class="mini-click-non">Tài khoản </span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                @if (request()->session()->get('quyen_quan_tri_vien') == 1)
                                <li><a title="Danh mục sản phẩm" href="quantri/quantrivien/danhsach"><span class="mini-sub-pro">Quản trị viên</span></a></li>
                                @endif
                                @if (request()->session()->get('quyen_nguoi_dung') == 1)
                                <li><a title="Loại sản phẩm" href="quantri/nguoidung/danhsach"><span class="mini-sub-pro">Người dùng</span></a></li>
                                @endif


                            </ul>
                        </li>
                        @endif
                        @if (request()->session()->get('quyen_ho_tro') == 1 ||  request()->session()->get('quyen_giai_dap_thac_mac') == 1)
                        <li>
                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon-wrap"><i class="fa fa-user-circle"></i></span>
                                <span class="mini-click-non">Chăm sóc KH </span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                @if (request()->session()->get('quyen_ho_tro') == 1)
                                <li><a title="Hỗ trợ" href="quantri/chamsockhachhang/hotro"><span class="mini-sub-pro">Hỗ trợ</span></a></li>
                                @endif
                                @if (request()->session()->get('quyen_giai_dap_thac_mac') == 1)
                                <li><a title="Giải đáp thắc mắc" href="quantri/chamsockhachhang/giaidapthacmac"><span class="mini-sub-pro">Giải đáp thắc mắc</span></a></li>
                                @endif

                            </ul>
                        </li>
                        @endif
                        @if (request()->session()->get('quyen_cai_dat_trang_chu') == 1 || request()->session()->get('quyen_cai_dat_san_pham') == 1
                        || request()->session()->get('quyen_cai_dat_tin_tuc') == 1 || request()->session()->get('quyen_cai_dat_dich_vu') == 1)
                        <li>
                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="icon-wrap"><i class="fa fa-cogs"></i></span>
                                <span class="mini-click-non">Cài đặt </span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                @if (request()->session()->get('quyen_cai_dat_trang_chu') == 1)
                                <li><a title="Cài đặt trang chủ" href="quantri/caidat/trangchu"><span class="mini-sub-pro">Trang chủ</span></a></li>
                                @endif
                                @if (request()->session()->get('quyen_cai_dat_san_pham') == 1)
                                <li><a title="Cài đặt sản phẩm" href="quantri/caidat/sanpham"><span class="mini-sub-pro">Sản phẩm</span></a></li>
                                @endif
                                @if (request()->session()->get('quyen_cai_dat_tin_tuc') == 1)
                                <li><a title="Cài đặt tin tức" href="quantri/caidat/tintuc"><span class="mini-sub-pro">Tin tức</span></a></li>
                                @endif
                                @if (request()->session()->get('quyen_cai_dat_dich_vu') == 1)
                                <li><a title="Cài đặt tin tức" href="quantri/caidat/dichvu"><span class="mini-sub-pro">Dịch vụ</span></a></li>
                                @endif




                            </ul>
                        </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Left menu area -->
