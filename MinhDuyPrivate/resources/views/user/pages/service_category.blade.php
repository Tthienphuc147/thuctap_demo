@extends('user/layout/index')

@section('title')
Danh mục dịch vụ - Phuc Store
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">{{$danh_muc_dich_vus->ten}}</li>
			</ul>
		</div>
	</div>
</div>
@if(count($tin_theo_danh_muc) != 0)
<div class="li-main-blog-page pt-60 pb-55">
	<div class="container">
		<div class="row">
			<!-- Begin Li's Blog Sidebar Area -->
			<div class="col-lg-3 order-lg-1 order-2">
				<div class="li-blog-sidebar-wrapper">
					<div class="li-blog-sidebar pb-5">
						<div class="li-sidebar-search-form">

							<form method="get" action="tim-kiem-dich-vu.html">
								<input type="text" name="tu_khoa" class="li-search-field" placeholder="Nhập từ khóa tìm kiếm">
								<button type="submit" class="li-search-btn"><i class="fa fa-search"></i></button>
							</form>

						</div>
					</div>
					@if(@share_tt_danh_muc_dich_vu)
					@foreach($share_tt_danh_muc_dich_vu as $sttdmtt)
					@if($sttdmtt->id != $danh_muc_dich_vus->id)
					<div class="li-blog-sidebar pt-5">
						<ul class="li-blog-archive">
							@foreach($share_tt_loai_dich_vu as $sttltt)
							<?php $dem = 0; ?>
							@foreach($share_toan_bo_dich_vu as $stbtt)
								@if($stbtt->id_loai_dich_vu == $sttltt->id)
									<?php $dem++; ?>
								@endif
							@endforeach
							@if($sttdmtt->id == $sttltt->id_danh_muc_dich_vu && $dem > 1)
							<li><a href="loai-dich-vu/{{changeTitle($sttltt->ten)}}a{{$sttltt->id}}.html">{{$sttltt->ten}} ({{$dem}})</a></li>
							@endif
							@endforeach
						</ul>
					</div>
					@endif
					@endforeach
					@endif
					@if(count($share_tu_khoa_dich_vu) > 1)
					<!-- Bắt đầu từ khóa thông dụng -->
					<?php $tu_khoa_random = array_rand($share_tu_khoa_dich_vu, count($share_tu_khoa_dich_vu) / 2);
					$dem = 1;
					?>
					<div class="li-blog-sidebar pt-10">
						<h4 class="li-blog-sidebar-title">Từ khóa thông dụng</h4>
						<ul class="li-blog-tags">
							@foreach($tu_khoa_random as $key)
							@if($share_tu_khoa_dich_vu[$key] != "")
							<li><a href="tim-kiem-dich-vu.html?tu_khoa={{$share_tu_khoa_dich_vu[$key]}}">{{$share_tu_khoa_dich_vu[$key]}}</a></li>
							@endif
							@if($dem > 20)
							@break
							@endif
							<?php $dem++; ?>
							@endforeach
						</ul>
					</div>
					@endif
				</div>
			</div>
			<!-- Li's Blog Sidebar Area End Here -->
			<!-- Begin Li's Main Content Area -->
			<div class="col-lg-9 order-lg-2 order-1">
				<div class="row li-main-content">
					@foreach($tin_theo_danh_muc as $ttdm)
					<div class="col-lg-6 col-md-6">
						<div class="li-blog-single-item pb-25">
							<div class="li-blog-banner">
								<a href="dich-vu/{{changeTitle($ttdm->tieu_de)}}a{{$ttdm->id}}.html"><img class="img-full" src="uploads/images/news/{{$ttdm->hinh_anh}}" alt=""></a>
							</div>
							<div class="li-blog-content">
								<div class="li-blog-details">
									<h3 class="li-blog-heading pt-25"><a href="dich-vu/{{changeTitle($ttdm->tieu_de)}}a{{$ttdm->id}}.html">{{$ttdm->tieu_de}}</a></h3>
									<p>{{limitStrlen($ttdm->mo_ta, 500)}}</p>
									<a class="read-more" href="dich-vu/{{changeTitle($ttdm->tieu_de)}}a{{$ttdm->id}}.html">Xem thêm...</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<!-- Begin Li's Pagination Area -->
					@if ($tin_theo_danh_muc->lastPage() > 1)
					<div class="col-lg-12">
						<div class="paginatoin-area">
							<div class="row">
								<div class="col-lg-12 col-md-12">
									<ul class="pagination-box pt-xs-20 pb-xs-15">
										@if($tin_theo_danh_muc->currentPage() > 1)
										<li><a href="{{ $tin_theo_danh_muc->url(1) }}" class="Previous">Đầu</a>
										</li>
										<li><a href="{{ $tin_theo_danh_muc->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i></a>
										</li>
										@endif

										<?php
										$max_paginate = $tin_theo_danh_muc->lastPage();
										$current_page = $tin_theo_danh_muc->currentPage();
										?>

										@if($current_page - 1 > 1)
										<span>...</span>
										@endif

										@for ($i = 1; $i <= $tin_theo_danh_muc->lastPage(); $i++)
										@if(($i == $current_page) || ($i == $current_page + 1) || ($i == $current_page - 1))
										<li class="{{ ($tin_theo_danh_muc->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $tin_theo_danh_muc->url($i) }}">{{$i}}</a></li>
										@endif
										@endfor

										@if($current_page + 1 < $max_paginate)
										<span>...</span>
										@endif

										@if ($tin_theo_danh_muc->hasMorePages())
										<li>
											<a href="{{ $tin_theo_danh_muc->nextPageUrl() }}" class="Next"><i class="fa fa-chevron-right"></i></a>
										</li>
										<li><a href="{{ $tin_theo_danh_muc->url($tin_theo_danh_muc->lastPage()) }}" class="Previous">Cuối</a>
										</li>
										@endif
									</ul>
								</div>
							</div>
						</div>
					</div>
					@endif
					<!-- Li's Pagination End Here Area -->
				</div>
			</div>
			<!-- Li's Main Content Area End Here -->
		</div>
	</div>
</div>
@else
<div class="error404-area pt-30 pb-60">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="error-wrapper text-center ptb-50 pt-xs-20">
					<div class="error-text">
						<h2>KHÔNG TÌM THẤY BÀI VIẾT</h2>
						<p>Xin lỗi, Hiện tại danh mục này chưa được cập nhật bài viết. Vui lòng quay lại sau</p>
					</div>
					<div class="error-button">
						<a href="trang-chu.html">Quay lại trang chủ</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endsection
