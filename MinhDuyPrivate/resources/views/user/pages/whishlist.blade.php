@extends('user/layout/index')

@section('title')
Sản phẩm yêu thích - Phuc Store
@endsection

@section('css')
<style>
</style>
@endsection

@section('content')
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Danh sách yêu thích</li>
			</ul>
		</div>
	</div>
</div>
@if(Session::has('yeu_thich_hien_tai'))
<!--Bắt đầu danh sách yêu thích-->
<?php $yeu_thich = Session::get('yeu_thich_hien_tai')->san_phams; ?>
<div class="wishlist-area pb-60">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="coupon-all">
					<div class="coupon2 pb-30">
						<button class="button" type="button" onclick="location.href='huy-yeu-thich.html'">Xóa toàn bộ <i class="fa fa-bitbucket" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			<div class="col-12">
				<form action="#">
					<div class="table-content table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="li-product-remove">Tên</th>
									<th class="li-product-thumbnail">Hình ảnh</th>
									<th class="li-product-price">Giá bán</th>
									<th class="li-product-stock-status">Xóa bỏ</th>
									<th class="li-product-add-cart">Mua hàng</th>
								</tr>
							</thead>
							<tbody>
								@foreach($yeu_thich as $id => $san_phams)
								<tr>
									<td class="li-product-remove"><a href="san-pham/{{changeTitle($san_phams['san_pham']->ten)}}-a{{$id}}.html">{{$san_phams['san_pham']->ten}}</a></td>
									<td class="li-product-thumbnail">
										<a href="san-pham/{{changeTitle($san_phams['san_pham']->ten)}}-a{{$id}}.html">
											@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
											@foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp)
											@if($tbhasp->id_sp == $id)
											<img src="uploads/images/products/{{$tbhasp->ten}}" alt="{{$san_phams['san_pham']->ten}}">
											@break
											@endif
											@endforeach
											@else
											<img src="https://via.placeholder.com/100x100" alt="{{$san_phams['san_pham']->ten}}">
											@endif
										</a>
									</td>
									<td class="li-product-price"><a class="amount">{{number_format($san_phams['san_pham']->gia_ban)}} ₫</a></td>
									<td class="li-product-stock-status"><a href="xoa-mot-yeu-thich/{{$id}}"><i class="fa fa-times"></i></a></td>
									<td class="li-product-add-cart"><a href="javascript:void(0)" onclick="themGioHang({{$id}})">Thêm vào giỏ hàng</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Kết thúc danh sách yêu thích-->
@else
<div class="col-md-12">
	<div class="error404-area pt-30 pb-60">
		<div class="container">
			<div class="error-wrapper text-center ptb-50 pt-xs-20">
				<div class="error-text">
					<h2>Danh sách yêu thích trống</h2>
					<p>Mời bạn tiếp tục chọn hàng!</p>
				</div>
				<div class="error-button">
					<a href="trang-chu.html">Quay lại trang chủ</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endsection

@section('script')
<script>
</script>
@endsection
