@extends('user/layout/index')

@section('title')
Đặt hàng - Phuc Store
@endsection

@section('css')
<style>
	#selec_addres{
		border-radius: 2px;
		background: none;
		border: solid 1px #e8e8e8;
	}
	#images-list-bill{
		width: 50px; height: 50px;
	}
</style>
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Thanh toán</li>
			</ul>
		</div>
	</div>
</div>
<!-- Li's Breadcrumb Area End Here -->
@if(Session::has('gio_hang_hien_tai'))
<!--Bắt đầu đặt hàng-->
<?php $gio_hang = Session::get('gio_hang_hien_tai'); ?>
<div class="checkout-area pt-60 pb-30">

	<div class="container">
		@if (session('hoadonthatbai'))
		<div class="alert alert-danger"><center><strong>Đặt hàng thất bại, vui lòng kiểm tra lại!</strong></center></div>
		@endif
		<div class="row">
			<div class="col-lg-6 col-12">
				<form action="thanh-toan.html" method="POST">
					@csrf
					<div class="checkbox-form">
						<h3>Thông tin đặt hàng</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="country-select clearfix">
									<label>Tỉnh / Thành phố <span class="required">*</span></label>
									<div>
										<select name="tinh_thanh" id="selec_addres" onchange="ajaxTinhThanhPho(this.value)" required>
											<?php $count = true; ?>
											@foreach($tinh_thanhpho as $t_tp)
											@if($count)
											<option data-display="{{$t_tp->name}}" value="{{$t_tp->province_id}}">{{$t_tp->name}}</option>
											<?php  $count = false;?>
											@else
											<option value="{{$t_tp->province_id}}">{{$t_tp->name}}</option>
											@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="country-select clearfix">
									<label>Quận / Huyện <span class="required">*</span></label>
									<div id="kq_quan_huyen">
										<select id="selec_addres" class="required" required>
											<option value=""></option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="country-select clearfix">
									<label>Xã / Phường <span class="required">*</span></label>
									<div id="kq_xa_phuong">
										<select id="selec_addres" class="required" required>
											<option value=""></option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Địa chỉ <span class="required">*</span></label>
									<input name="dia_chi" placeholder="Nhập địa chỉ nhận hàng" type="text" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Họ và tên <span class="required">*</span></label>
									<input name="ho_ten" placeholder="Nhập họ và tên người nhận hàng" type="text" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Email <span class="required">*</span></label>
									<input name="email" placeholder="Nhập vào email của bạn" type="email"required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Số điện thoại  <span class="required">*</span></label>
									<input name="dien_thoai" placeholder="Nhập vào số điện thoại người nhận hàng" type="text" required onKeyPress="return khongNhapKyTu(event);">
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Ghi chú đặt hàng</label>
									<textarea name="ghi_chu" id="checkout-mess" cols="30" rows="5" placeholder="Để lại bất kỳ yêu cầu nào tới chúng tôi, cho đơn hàng của bạn!"></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<div class="order-button-payment">
										<input value="Thanh toán đơn hàng" type="submit">
									</div>
								</div>
							</div>

						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-6 col-12">
				<div class="your-order">
					<h3>Đơn hàng của bạn</h3>
					<div class="your-order-table table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="cart-product-name">Sản phẩm</th>
									<th class="cart-product-name">Hình ảnh</th>
									<th class="cart-product-total">Số lượng</th>
									<th class="cart-product-total">Giá</th>
								</tr>
							</thead>
							<tbody>
								<?php $san_phams = $gio_hang->san_phams;?>
								@foreach($san_phams as $sanpham => $item)
								<?php $sl =  $item['so_luong'];
								$gia_cong = $item['gia_ban'];
								?>
								@foreach($item as $it => $sp)
								@if($it == 'san_pham')
								<tr class="cart_item">
									<td class="cart-product-name">{{$sp->ten}}</td>
									<td class="cart-product-name">
										@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
										@foreach($share_sp_toan_bo_hinh_anh_chinh as $ssptbhac)
										@if($ssptbhac->id_sp == $sp->id)
										<img id="images-list-bill" src="uploads/images/products/{{$ssptbhac->ten}}" alt="{{$sp->ten}}">
										@break
										@endif
										@endforeach
										@else
										<a href="single-product.html">
											<img src="https://via.placeholder.com/50x50" alt="{{$sp->ten}}">
										</a>
										@endif

									</td>
									<td class="cart-product-name">{{$sl}}</td>
									<td class="cart-product-total"><span class="amount">{{number_format($gia_cong)}}</span></td>
								</tr>
								@endif
								@endforeach
								@endforeach
							</tbody>
							<tfoot>
								<tr class="order-total">
									<th>Tổng</th>
									<th></th>
									<th>{{$gio_hang->tong_so_luong}}</th>
									<td><strong><span class="amount">{{number_format($gio_hang->tong_gia)}}₫</span></strong></td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="payment-method">
						<div class="payment-accordion">
							<div id="accordion">
								<div class="card">
									<div class="card-header" id="#payment-1">
										<h5 class="panel-title">
											<a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												Giao hàng trả sau.
											</a>
										</h5>
									</div>
									<div id="collapseOne" class="collapse show" data-parent="#accordion">
										<div class="card-body">
											<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="#payment-2">
										<h5 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												Thanh toán chuyển khoản
											</a>
										</h5>
									</div>
									<div id="collapseTwo" class="collapse" data-parent="#accordion">
										<div class="card-body">
											<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="#payment-3">
										<h5 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
												PayPal
											</a>
										</h5>
									</div>
									<div id="collapseThree" class="collapse" data-parent="#accordion">
										<div class="card-body">
											<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Kết thúc đặt hàng-->
@else
<div class="col-md-12">
	@if (session('hoadonthanhcong'))
	<div class="alert alert-success"><center><strong>Đặt hàng thành công!</strong></center></div>
	@endif
	<div class="error404-area pt-30 pb-60">
		<div class="container">
			<div class="error-wrapper text-center ptb-50 pt-xs-20">
				<div class="error-text">
					<h2>Giỏ hàng trống</h2>
					<p>Mời bạn tiếp tục mua hàng!</p>
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
	function ajaxTinhThanhPho(id_tinh_tp){
		$.ajax({
			type: "GET",
			url: 'ajax_quan_huyen/'+id_tinh_tp,
			success: function( msg ) {
				$('#kq_quan_huyen').html(msg[0]);
				$('#kq_xa_phuong').html(msg[1]);
			}
		});
	}
	function ajaxQuanHuyen(id_quan_huyen){
		$.ajax({
			type: "GET",
			url: 'ajax_xa_phuong/'+id_quan_huyen,
			success: function( msg ) {
				$('#kq_xa_phuong').html(msg);
			}
		});
	}
</script>
@endsection
