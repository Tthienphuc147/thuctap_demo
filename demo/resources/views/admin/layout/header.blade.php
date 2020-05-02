        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item nav-setting-open"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                    @if(count($share_thong_bao_phan_hoi_sp) > 0)
                                                    <i class="fa fa-bell-o animated" aria-hidden="true"></i>
                                                    @else
                                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                                    @endif
                                                    <span class="indicator-nt"></a>

                                                    <div role="menu" class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg dropdown-menu animated zoomIn notifications-setting">
                                                        <ul class="nav nav-tabs custon-set-tab">
                                                            @if(count($share_thong_bao_phan_hoi_sp) > 0)
                                                            <li><a data-toggle="tab" href="#Projectsa"><span class="text-danger">Phản hồi SP</span></a>
                                                            @else
                                                            <li><a data-toggle="tab" href="#Projectsa"><span>Phản hồi SP</span></a>
                                                            @endif
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content custom-bdr-nt">
                                                            <div id="Projectsa" class="tab-pane fade">
                                                                <div class="projects-settings-wrap">
                                                                    <div class="note-heading-indicate">
                                                                        @foreach($share_thong_bao_phan_hoi_sp as $thongbaosp)
                                                                        <a href="quantri/phanhoisanpham/xem/{{ $thongbaosp->id}}"><p><i class="fa fa-comments-o"></i> <b>{{ $thongbaosp->ten}}</b> có <b>{{ $thongbaosp->tong}}</b> phản hồi mới.</p></a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <img src="/admin/image/{{Auth::guard('admin')->user()->avatar}}" alt="" />
                                                             @if(Auth::guard('admin')->check())
                                                        <span class="admin-name">{{Auth::guard('admin')->user()->display_name}}</span>
                                                        @endif
                                                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                        </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="quantri/dangxuat"><span class="edu-icon edu-locked author-log-ic"></span>Đăng xuất</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a data-toggle="collapse" data-target="#Charts" href="quantri/trangchu">Trang chủ <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="javascript:void(0)">Cài đặt chung</a></li>
                                                <li><a href="quantri/caythumuc">Cây thư mục</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0)">Event</a></li>
                                        <li><a data-toggle="collapse" data-target="#demoevent" href="javascript:void(0)">Sản phẩm <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demoevent" class="collapse dropdown-header-top">
                                                <li><a href="quantri/danhmucsanpham/danhsach">Danh mục sản phẩm</a>
                                                </li>
                                                <li><a href="quantri/loaisanpham/danhsach">Loại sản phẩm</a>
                                                </li>
                                                <li><a href="quantri/sanpham/danhsach">Sản phẩm</a>
                                                </li>
                                                <li><a href="quantri/phanhoisanpham/danhsach">Phản hồi sản phẩm</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#hoadon" href="javascript:void(0)">Hóa đơn <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="hoadon" class="collapse dropdown-header-top">
                                                <li><a href="quantri/hoadon/danhsach">Danh sách hóa đơn</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#taikhoan" href="javascript:void(0)">Tài khoản <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demoevent" class="collapse dropdown-header-top">
                                                <li><a href="quantri/quantrivien/danhsach">Quản trị viên</a>
                                                </li>
                                                <li><a href="quantri/nguoidung/danhsach">Người dùng</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Pagemob" class="collapse dropdown-header-top">
                                                <li><a href="login.html">Login</a>
                                                </li>
                                                <li><a href="register.html">Register</a>
                                                </li>
                                                <li><a href="lock.html">Lock</a>
                                                </li>
                                                <li><a href="password-recovery.html">Password Recovery</a>
                                                </li>
                                                <li><a href="404.html">404 Page</a></li>
                                                <li><a href="500.html">500 Page</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
        </div>
