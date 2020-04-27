@extends('user/layout/index')

@section('title')
Câu hỏi thường gặp - Phuc Store
@endsection

@section('css')
<style>
</style>
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Câu hỏi thường gặp</li>
			</ul>
		</div>
	</div>
</div>

<div class="frequently-area pt-60 pb-50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="frequently-content">
					<div class="frequently-desc">
						<h3>Dưới đây là những câu hỏi khách hàng thường đặt cho Phuc Store.</h3>
						<p>Mọi thắc mắc sẽ được chúng tôi giải đáp đầy đủ nhất. Có thể thắc mắc của bạn được giải đáp tại đây</p>
					</div>
				</div>
				<!-- Begin Frequently Accordin -->
				<div class="frequently-accordion">
					<div id="accordion">
						<?php $index = true; ?>
						@if(count($giai_dap) != 0)
						@foreach($giai_dap as $gd)
						@if($index)
						<div class="card  actives">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
									<a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										{{$gd->cau_hoi}}
									</a>
								</h5>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									{!!$gd->tra_loi!!}
								</div>
							</div>
						</div>
						<?php $index = false; ?>
						@else
						<div class="card">
							<div class="card-header" id="headingEight">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" data-target="#collapseEight{{$gd->id}}" aria-expanded="false" aria-controls="collapseEight">
										{{$gd->cau_hoi}}
									</a>
								</h5>
							</div>
							<div id="collapseEight{{$gd->id}}" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
								<div class="card-body">
									{!!$gd->tra_loi!!}
								</div>
							</div>
						</div>
						@endif

						@endforeach
						@endif
					</div>
				</div>
				<!--Frequently Accordin End Here -->

				@if ($giai_dap->lastPage() > 1)
				<div class="col-lg-12">
					<div class="paginatoin-area">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<ul class="pagination-box pt-xs-20 pb-xs-15">
									@if($giai_dap->currentPage() > 1)
									<li><a href="{{ $giai_dap->url(1) }}" class="Previous">Đầu</a>
									</li>
									<li><a href="{{ $giai_dap->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i></a>
									</li>
									@endif

									<?php
									$max_paginate = $giai_dap->lastPage();
									$current_page = $giai_dap->currentPage();
									?>

									@if($current_page - 1 > 1)
									<span>...</span>
									@endif

									@for ($i = 1; $i <= $giai_dap->lastPage(); $i++)
									@if(($i == $current_page) || ($i == $current_page + 1) || ($i == $current_page - 1))
									<li class="{{ ($giai_dap->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $giai_dap->url($i) }}">{{$i}}</a></li>
									@endif
									@endfor

									@if($current_page + 1 < $max_paginate)
									<span>...</span>
									@endif

									@if ($giai_dap->hasMorePages())
									<li>
										<a href="{{ $giai_dap->nextPageUrl() }}" class="Next"><i class="fa fa-chevron-right"></i></a>
									</li>
									<li><a href="{{ $giai_dap->url($giai_dap->lastPage()) }}" class="Previous">Cuối</a>
									</li>
									@endif
								</ul>
							</div>
						</div>
					</div>
				</div>
				@endif

			</div>
		</div>
	</div>
</div>

@endsection
