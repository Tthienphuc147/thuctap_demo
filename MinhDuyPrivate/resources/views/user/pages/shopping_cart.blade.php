@extends('user/layout/index')

@section('title')
Giỏ hàng - Phuc Store
@endsection

@section('content')
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Giỏ hàng</li>
			</ul>
		</div>
	</div>
</div>

<div class="Shopping-cart-area">
	@if(Session::has('gio_hang_hien_tai'))
	<div class="container">
		<div class="row">
			<div class="col-12">
				<form action="#">

					<div class="row">
						<div class="col-12">
							<div class="coupon-all">
								<div class="coupon2 pb-20">
									<button class="button" type="button" onclick="location.href='huy-gio-hang.html'">Hủy giỏ hàng <i class="fa fa-bitbucket" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>

					<div class="table-content table-responsive">

						<table class="table">
							<thead>
								<tr>
									<th class="li-product-thumbnail">Tên</th>
									<th class="cart-product-name">Hình ảnh</th>
									<th class="li-product-price">Giá bán</th>
									<th class="li-product-quantity">Số lượng</th>
									<th class="li-product-subtotal">Thành tiền</th>
									<th class="li-product-remove">Sửa / Xóa</th>
								</tr>
							</thead>
							<tbody>

								<?php $gio_hang = Session::get('gio_hang_hien_tai')->san_phams; ?>
								@foreach($gio_hang as $gh => $san_pham)
								<?php $sl = $san_pham['so_luong']; ?>
								@foreach($san_pham as $sp => $item)
								@if($sp == 'san_pham')

								<tr>
									<td class="li-product-name"><a href="san-pham/{{changeTitle($item->ten)}}-a{{$item->id}}.html">{{$item->ten}}</a></td>
									<td class="li-product-thumbnail"><a href="san-pham/{{changeTitle($item->ten)}}-a{{$item->id}}.html">@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
										@foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp)
										@if($tbhasp->id_sp == $item->id)
											<img src="uploads/images/products/{{$tbhasp->ten}}" alt="{{$item->ten}}">
										@endif
										@endforeach
									@endif</a></td>

									<td class="li-product-price"><span class="amount">{{number_format($item->gia_ban)}}₫</span></td>
									<td class="quantity">
										<div class="cart-plus-minus">
											<input id="ip-so-luong-{{$item->id}}" onKeyPress="return khongNhapKyTu(event);" class="cart-plus-minus-box" value="{{$sl}}" type="text">
											<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
											<div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
										</div>
									</td>
									<td class="product-subtotal"><span class="amount">
									{{number_format($san_pham['gia_ban'])}}₫</span></td>
									<td class="li-product-remove">
										<a href="javascript:void(0)" onclick="suaSoLuongGioHang({{$item->id}})"><i class="fa fa-pencil-square-o"></i></a>
										<a href="xoa-nhieu-gio-hang/{{$item->id}}"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
								@endif
								@endforeach
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-12 ml-auto pb-20">
							<div class="cart-page-total">
								<ul>
									<li>Tổng số lượng: <span>{{Session::get('gio_hang_hien_tai')->tong_so_luong}}</span></li>
									<li>Tổng tiền: <span>{{number_format(Session::get('gio_hang_hien_tai')->tong_gia)}}₫</span></li>
								</ul>
								<a href="dat-hang.html"> ĐẶT HÀNG</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	@else
	<div class="container">
		<div class="row">
			<div class="col-12 pb-20 pt-20">
				<div class="table-content table-responsive">

					<table class="table">
						<thead>
							<tr>
								<th class="li-product-thumbnail">Tên</th>
								<th class="cart-product-name">Hình ảnh</th>
								<th class="li-product-price">Giá bán</th>
								<th class="li-product-quantity">Số lượng</th>
								<th class="li-product-subtotal">Thành tiền</th>
								<th class="li-product-remove">Sửa / Xóa</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan='6'><h2>Giỏ hàng trống, mời tiếp tục mua sắm!</h2></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
@endsection

@section('script')
<script>
	function suaSoLuongGioHang(id){
		var so_luong = $('#ip-so-luong-'+id).val();
		var check = new RegExp('^(0*)[1-9][0-9]*$');
		if (check.test(so_luong) && (so_luong != '')) {
			location.href = 'sua-gio-hang/'+id+'/'+so_luong;
		}
		else {
			Lobibox.notify('error', {
				size: 'mini',
				msg: 'Số lượng không hợp lệ. Chỉ được nhập vào số!'
			});
			$('#ip-so-luong-'+id).val('1');
			return false;
		}
	}
</script>
@endsection
