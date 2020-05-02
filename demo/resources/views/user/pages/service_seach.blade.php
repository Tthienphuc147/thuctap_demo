@extends('user/layout/index')

@section('title')
Tìm kiếm dịch vụ - Phuc Store
@endsection
@section('css')
<style>
	#cout_news{
		color: #7abfff;
	}
	#noi-bat-tu-khoa{
		color: red;
	}
</style>
@endsection
@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li id="cout_news" class="active">Tìm thấy <b>{{$so_luong}}</b> kết quả.</li>
			</ul>
		</div>
	</div>
</div>
@if(count($dich_vu_tim_kiem) != 0)
<?php
	function noiBatTuKhoa($str, $tu_khoa){
		$str = str_replace($tu_khoa, "<span id='noi-bat-tu-khoa'>$tu_khoa</span>", $str);
		return $str;
	}
?>
<div class="li-main-blog-page pt-60 pb-55">
	<div class="container">
		<div class="row">
			<!-- Begin Li's Main Content Area -->
			<div class="col-lg-12">
				<div class="row li-main-content">
					@foreach($dich_vu_tim_kiem as $ttl)
					<div class="col-lg-4 col-md-6">
						<div class="li-blog-single-item pb-25">
							<div class="li-blog-banner">
								<a href="dich-vu/{{changeTitle($ttl->tieu_de)}}a{{$ttl->id}}.html"><img class="img-full" src="uploads/images/news/{{$ttl->hinh_anh}}" alt="{{$ttl->tieu_de}}"></a>
							</div>
							<div class="li-blog-content">
								<div class="li-blog-details">
									<h3 class="li-blog-heading pt-25"><a href="dich-vu/{{changeTitle($ttl->tieu_de)}}a{{$ttl->id}}.html">{!!noiBatTuKhoa($ttl->tieu_de, $tu_khoa)!!}</a></h3>
									<?php $mo_ta  = limitStrlen($ttl->mo_ta, 500); ?>
									<p>{!!noiBatTuKhoa($mo_ta, $tu_khoa)!!}</p>
									<a class="read-more" href="dich-vu/{{changeTitle($ttl->tieu_de)}}a{{$ttl->id}}.html">Xem thêm...</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<!-- Begin Li's Pagination Area -->
					@if ($dich_vu_tim_kiem->lastPage() > 1)
					<div class="col-lg-12">
						<div class="paginatoin-area">
							<div class="row">
								<div class="col-lg-12 col-md-12">
									<ul class="pagination-box pt-xs-20 pb-xs-15">
										@if($dich_vu_tim_kiem->currentPage() > 1)
										<li><a href="{{ $dich_vu_tim_kiem->appends(['tu_khoa'=>$tu_khoa])->url(1) }}" class="Previous">Đầu</a>
										</li>
										<li><a href="{{ $dich_vu_tim_kiem->appends(['tu_khoa'=>$tu_khoa])->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i></a>
										</li>
										@endif

										<?php
										$max_paginate = $dich_vu_tim_kiem->lastPage();
										$current_page = $dich_vu_tim_kiem->currentPage();
										?>

										@if($current_page - 1 > 1)
										<span>...</span>
										@endif

										@for ($i = 1; $i <= $dich_vu_tim_kiem->lastPage(); $i++)
										@if(($i == $current_page) || ($i == $current_page + 1) || ($i == $current_page - 1))
										<li class="{{ ($dich_vu_tim_kiem->appends(['tu_khoa'=>$tu_khoa])->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $dich_vu_tim_kiem->url($i) }}">{{$i}}</a></li>
										@endif
										@endfor

										@if($current_page + 1 < $max_paginate)
										<span>...</span>
										@endif

										@if ($dich_vu_tim_kiem->hasMorePages())
										<li>
											<a href="{{ $dich_vu_tim_kiem->appends(['tu_khoa'=>$tu_khoa])->nextPageUrl() }}" class="Next"><i class="fa fa-chevron-right"></i></a>
										</li>
										<li><a href="{{ $dich_vu_tim_kiem->url($dich_vu_tim_kiem->appends(['tu_khoa'=>$tu_khoa])->lastPage()) }}" class="Previous">Cuối</a>
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
						<p>Xin lỗi, từ khóa không được tìm thấy. Vui lòng thử lại</p>
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
