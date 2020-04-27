@extends('user/layout/index')

@section('title')
Tất cả tin tức - Phuc Store
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Tất cả tin tức</li>
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
					@if($toan_bo_tin_tuc)
					@foreach($toan_bo_tin_tuc as $tbtt)
					<div class="col-lg-6 col-md-6">
						<div class="li-blog-single-item pb-25">
							<div class="li-blog-banner">
								<a href="tin-tuc/{{changeTitle($tbtt->tieu_de)}}a{{$tbtt->id}}.html"><img class="img-full" src="uploads/images/news/{{$tbtt->hinh_anh}}" alt="{{$tbtt->tieu_de}}"></a>
							</div>
							<div class="li-blog-content">
								<div class="li-blog-details">
									<h3 class="li-blog-heading pt-25"><a href="tin-tuc/{{changeTitle($tbtt->tieu_de)}}a{{$tbtt->id}}.html">{{$tbtt->tieu_de}}</a></h3>
									<div class="li-blog-meta">
										<a class="author" href="#"><i class="fa fa-user"></i>{{$tbtt->display_name}}</a>
										<a class="comment" href="#"><i class="fa fa-eye"></i>{{$tbtt->luot_xem}} đã xem</a>
										<a class="post-time" href="javascript:void(0)"><i class="fa fa-calendar"></i> {{$tbtt->created_at}}</a>
									</div>
									<p>{{limitStrlen($tbtt->mo_ta, 500)}}</p>
									<a class="read-more" href="tin-tuc/{{changeTitle($tbtt->tieu_de)}}a{{$tbtt->id}}.html">Xem thêm...</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
					<!-- Begin Li's Pagination Area -->
					@if ($toan_bo_tin_tuc->lastPage() > 1)
					<div class="col-lg-12">
						<div class="paginatoin-area">
							<div class="row">
								<div class="col-lg-12 col-md-12">
									<ul class="pagination-box pt-xs-20 pb-xs-15">
										@if($toan_bo_tin_tuc->currentPage() > 1)
										<li><a href="{{ $toan_bo_tin_tuc->url(1) }}" class="Previous">Đầu</a>
										</li>
										<li><a href="{{ $toan_bo_tin_tuc->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i></a>
										</li>
										@endif

										<?php
										$max_paginate = $toan_bo_tin_tuc->lastPage();
										$current_page = $toan_bo_tin_tuc->currentPage();
										?>

										@if($current_page - 1 > 1)
										<span>...</span>
										@endif

										@for ($i = 1; $i <= $toan_bo_tin_tuc->lastPage(); $i++)
										@if(($i == $current_page) || ($i == $current_page + 1) || ($i == $current_page - 1))
										<li class="{{ ($toan_bo_tin_tuc->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $toan_bo_tin_tuc->url($i) }}">{{$i}}</a></li>
										@endif
										@endfor

										@if($current_page + 1 < $max_paginate)
										<span>...</span>
										@endif

										@if ($toan_bo_tin_tuc->hasMorePages())
										<li>
											<a href="{{ $toan_bo_tin_tuc->nextPageUrl() }}" class="Next"><i class="fa fa-chevron-right"></i></a>
										</li>
										<li><a href="{{ $toan_bo_tin_tuc->url($toan_bo_tin_tuc->lastPage()) }}" class="Previous">Cuối</a>
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
