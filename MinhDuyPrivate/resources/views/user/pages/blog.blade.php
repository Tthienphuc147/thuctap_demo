@extends('user/layout/index')

@section('title')
Tin tức - Phuc Store
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="trang-chu.html">Trang chủ</a></li>
                <li class="active">{{$tin_tuc->tieu_de}}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Main Blog Page Area -->
<div class="li-main-blog-page li-main-blog-details-page pt-10 pb-10 pb-sm-45 pb-xs-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Main Content Area -->
            <div class="col-lg-12 order-lg-2 order-1">
                <div class="row li-main-content">
                    <div class="col-lg-12">
                        <div class="li-blog-single-item pb-30">
                            <div class="li-blog-content">
                                <div class="li-blog-details">
                                    <h3 class="li-blog-heading pt-25"><a href="javascpit:void(0)">{{$tin_tuc->tieu_de}}</a></h3>
                                    <div class="li-blog-meta">
                                        <a class="author" href="javascpit:void(0)"><i class="fa fa-user"></i>{{$admin->display_name}}</a>
                                        <a class="comment" href="javascpit:void(0)"><i class="fa fa-eye"></i>{{$tin_tuc->luot_xem}} đã xem</a>
                                        <a class="post-time" href="javascpit:void(0)"><i class="fa fa-calendar"></i> {{$tin_tuc->created_at}}</a>
                                    </div>

                                    <div>
                                        {!!$tin_tuc->noi_dung!!}
                                    </div>
                                    <div class="li-tag-line">
                                        <h4>Từ khóa:</h4>
                                        <?php $dem  = true; ?>
                                        @foreach($share_tu_khoa_tin_tuc as $tk)
                                        @if($tk != "")
                                        <a href="tim-kiem-tin-tuc.html?tu_khoa={{$tk}}">@if(!$dem) , @endif{{$tk}}</a>
                                        <?php $dem = false; ?>
                                        @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Li's Main Content Area End Here -->



            </div>
        </div>
    </div>
    <!-- Li's Main Blog Page Area End Here -->
    <!-- Footer Static Middle Area End Here -->
    @endsection
    @section('script')
    @endsection
