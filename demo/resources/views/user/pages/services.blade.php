@extends('user/layout/index')

@section('title')
Tất cả dịch vụ - Phuc Store
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Tất cả tất cả</li>
			</ul>
		</div>
	</div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<div class="li-main-blog-page pt-60 pb-55">
	<div class="container">
		<div class="row">
			<!-- Begin Li's Main Content Area -->
			<div class="col-lg-12">
				<div class="row li-main-content">
					@if($toan_bo_dich_vu)
					@foreach($toan_bo_dich_vu as $tbdv)
					<div class="col-lg-6 col-md-6">
						<div class="li-blog-single-item pb-25">
							<div class="li-blog-banner">
								<a href="dich-vu/{{changeTitle($tbdv->tieu_de)}}a{{$tbdv->id}}.html"><img class="img-full" src="uploads/images/news/{{$tbdv->hinh_anh}}" alt="{{$tbdv->tieu_de}}"></a>
							</div>
							<div class="li-blog-content">
								<div class="li-blog-details">
									<h3 class="li-blog-heading pt-25"><a href="dich-vu/{{changeTitle($tbdv->tieu_de)}}a{{$tbdv->id}}.html">{{$tbdv->tieu_de}}</a></h3>
									<p>{{limitStrlen($tbdv->mo_ta, 500)}}</p>
									<a class="read-more" href="dich-vu/{{changeTitle($tbdv->tieu_de)}}a{{$tbdv->id}}.html">Xem thêm...</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
					<!-- Begin Li's Pagination Area -->
					@if ($toan_bo_dich_vu->lastPage() > 1)
					<div class="col-lg-12">
						<div class="paginatoin-area">
							<div class="row">
								<div class="col-lg-12 col-md-12">
									<ul class="pagination-box pt-xs-20 pb-xs-15">
										@if($toan_bo_dich_vu->currentPage() > 1)
										<li><a href="{{ $toan_bo_dich_vu->url(1) }}" class="Previous">Đầu</a>
										</li>
										<li><a href="{{ $toan_bo_dich_vu->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i></a>
										</li>
										@endif

										<?php
										$max_paginate = $toan_bo_dich_vu->lastPage();
										$current_page = $toan_bo_dich_vu->currentPage();
										?>

										@if($current_page - 1 > 1)
										<span>...</span>
										@endif

										@for ($i = 1; $i <= $toan_bo_dich_vu->lastPage(); $i++)
										@if(($i == $current_page) || ($i == $current_page + 1) || ($i == $current_page - 1))
										<li class="{{ ($toan_bo_dich_vu->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $toan_bo_dich_vu->url($i) }}">{{$i}}</a></li>
										@endif
										@endfor

										@if($current_page + 1 < $max_paginate)
										<span>...</span>
										@endif

										@if ($toan_bo_dich_vu->hasMorePages())
										<li>
											<a href="{{ $toan_bo_dich_vu->nextPageUrl() }}" class="Next"><i class="fa fa-chevron-right"></i></a>
										</li>
										<li><a href="{{ $toan_bo_dich_vu->url($toan_bo_dich_vu->lastPage()) }}" class="Previous">Cuối</a>
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

@endsection
