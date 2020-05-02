@extends('user/layout/index')

@section('title')
Thể loại dịch vụ - Phuc Store
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">{{$loai_dich_vus->ten}}</li>
			</ul>
		</div>
	</div>
</div>
@if(count($tin_theo_loai) != 0)
<div class="li-main-blog-page pt-60 pb-55">
	<div class="container">
		<div class="row">
			<!-- Begin Li's Main Content Area -->
			<div class="col-lg-12">
				<div class="row li-main-content">
					@foreach($tin_theo_loai as $ttl)
					<div class="col-lg-4 col-md-6">
						<div class="li-blog-single-item pb-25">
							<div class="li-blog-banner">
								<a href="dich-vu/{{changeTitle($ttl->tieu_de)}}a{{$ttl->id}}.html"><img class="img-full" src="uploads/images/news/{{$ttl->hinh_anh}}" alt="{{$ttl->tieu_de}}"></a>
							</div>
							<div class="li-blog-content">
								<div class="li-blog-details">
									<h3 class="li-blog-heading pt-25"><a href="dich-vu/{{changeTitle($ttl->tieu_de)}}a{{$ttl->id}}.html">{{$ttl->tieu_de}}</a></h3>
									<p>{{limitStrlen($ttl->mo_ta, 500)}}</p>
									<a class="read-more" href="dich-vu/{{changeTitle($ttl->tieu_de)}}a{{$ttl->id}}.html">Xem thêm...</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<!-- Begin Li's Pagination Area -->
					@if ($tin_theo_loai->lastPage() > 1)
					<div class="col-lg-12">
						<div class="paginatoin-area">
							<div class="row">
								<div class="col-lg-12 col-md-12">
									<ul class="pagination-box pt-xs-20 pb-xs-15">
										@if($tin_theo_loai->currentPage() > 1)
										<li><a href="{{ $tin_theo_loai->url(1) }}" class="Previous">Đầu</a>
										</li>
										<li><a href="{{ $tin_theo_loai->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i></a>
										</li>
										@endif

										<?php
										$max_paginate = $tin_theo_loai->lastPage();
										$current_page = $tin_theo_loai->currentPage();
										?>

										@if($current_page - 1 > 1)
										<span>...</span>
										@endif

										@for ($i = 1; $i <= $tin_theo_loai->lastPage(); $i++)
										@if(($i == $current_page) || ($i == $current_page + 1) || ($i == $current_page - 1))
										<li class="{{ ($tin_theo_loai->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $tin_theo_loai->url($i) }}">{{$i}}</a></li>
										@endif
										@endfor

										@if($current_page + 1 < $max_paginate)
										<span>...</span>
										@endif

										@if ($tin_theo_loai->hasMorePages())
										<li>
											<a href="{{ $tin_theo_loai->nextPageUrl() }}" class="Next"><i class="fa fa-chevron-right"></i></a>
										</li>
										<li><a href="{{ $tin_theo_loai->url($tin_theo_loai->lastPage()) }}" class="Previous">Cuối</a>
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
						<p>Xin lỗi, hiện tại thể loại này chưa được cập nhật bài viết. Vui lòng quay lại sau</p>
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
