@extends('user/layout/index')

@section('title')
Sản phẩm - Phuc Store
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="index.html">Trang chủ</a></li>
				@if($san_pham != null)
				<li class="active">Sản phẩm</li>
				<li class="active">{{$san_pham->ten}}</li>
				@endif
			</ul>
		</div>
	</div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- content-wraper start -->
<div class="content-wraper">
	<div class="container">
		<div class="row single-product-area">
			<div class="col-lg-5 col-md-6">
				<!-- Product Details Left -->
				<div class="product-details-left">

					@if(count($hinh_anh_san_pham) != 0)
					<div class="product-details-images slider-navigation-1">
						@foreach($hinh_anh_san_pham as $hasp)
						<div class="lg-image">
							<a class="popup-img venobox vbox-item" href="uploads/images/products/{{$hasp->ten}}" data-gall="myGallery">
								@if ($san_pham->so_luong == 0)
								<img src="/user/assets/images/soldout.png" alt="" class="soldout--image">
								@endif
								<img src="uploads/images/products/{{$hasp->ten}}" alt="{{$san_pham->mo_ta}}">
							</a>
						</div>
						@endforeach()

					</div>
					<div class="product-details-thumbs slider-thumbs-1">
						@foreach($hinh_anh_san_pham as $hasp)
						<div class="sm-image"><img src="uploads/images/products/{{$hasp->ten}}" alt="{{$san_pham->mo_ta}}"></div>
						@endforeach()

					</div>
					@endif
				</div>
				<!--// Product Details Left -->
			</div>

			<div class="col-lg-7 col-md-6">
				<div class="product-details-view-content pt-60">
					<div class="product-info">
						<h2>{{$san_pham->ten}}</h2>
						<div class="price-box pt-20">
							<span class="new-price new-price-2">{{number_format($san_pham->gia_ban)}}₫</span>
						</div>
						<div class="product-desc">
							<p>
								<span>{{$san_pham->mo_ta}}
								</span>
							</p>
						</div>
						<div class="single-add-to-cart">
							<form method="POST" class="cart-quantity" id="form_them_hang">
								@csrf
								<div class="quantity">
                                    <label>Số lượng</label>
                                    <input name="so_luong_hien_tai" id="so_luong_hien_tai" class="cart-plus-minus-box" value="{{$san_pham->so_luong}}" hidden>
									<div class="cart-plus-minus">
										<input name="so_luong" id="so_luong_sp_dat_hang" class="cart-plus-minus-box" maxlength="10" value="1" onKeyPress="return khongNhapKyTu(event);">
										<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
										<div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
									</div>
								</div>
								<input name="id_sp" value="{{$san_pham->id}}" hidden>
								<button class="add-to-cart" type="button" onclick="themCoSoLuong()">Thêm vào giỏ hàng</button>
							</form>
						</div>
						<div class="block-reassurance">
							<ul>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-check-square-o"></i>
										</div>
										<p>Bảo hành 12 tháng tại trung tâm bảo hành Chính hãng.</p>
									</div>
								</li>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-truck"></i>
										</div>
										<p>Giao hàng nhanh chóng</p>
									</div>
								</li>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-exchange"></i>
										</div>
										<p>1 đổi 1 trong 30 ngày nếu có lỗi nhà sản xuất</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="li-product-tab">
					<ul class="nav li-product-menu">
						<li><a class="active" data-toggle="tab" href="#description"><span>Thông số kỹ thuật</span></a></li>
						<li><a data-toggle="tab" href="#reviews"><span>Phản hồi</span></a></li>
					</ul>
				</div>
				<!-- Begin Li's Tab Menu Content Area -->
			</div>
		</div>
		<div class="tab-content">
			<div id="description" class="tab-pane active show" role="tabpanel">
				<div class="product-description">
					{!!$san_pham->thong_so!!}
				</div>
			</div>
			<div id="reviews" class="tab-pane" role="tabpanel">
				<div class="product-reviews">
					<div class="product-details-comment-block">
						@foreach($phan_hoi_san_pham as $phsp)
						<div class="comment-author-infos">
							<span>{{$phsp->ten_hien_thi}}</span>
							<em>{{date('d/m/Y H:i:s' , strtotime($phsp->created_at)) }}</em>
							<p>{{$phsp->noi_dung}}</p>
						</div>
						@endforeach
						<div class="review-btn">
							<a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Viết phản hồi</a>
						</div>
						<!-- Begin Quick View | Modal Area -->
						<div class="modal fade modal-wrapper" id="mymodal" >
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body">
										<div class="modal-inner-area row">
											<div class="col-lg-6">
												<div class="li-review-product">
													@foreach($hinh_anh_san_pham as $hasp)
													@if($hasp->hinh_chinh == 1)
													<img src="uploads/images/products/{{$hasp->ten}}" alt="Hình ảnh sản phẩm">
													@endif
													@endforeach()
													<div class="li-review-product-desc">
														<p class="li-product-name">{{$san_pham->ten}}</p>
														<p>
															<span>{{$san_pham->mo_ta}}</span>
														</p>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="li-review-content">
													<!-- Begin Feedback Area -->
													<div class="feedback-area">
														<div class="feedback">
															<form method="post" id="form_phan_hoi">
																<div style="display: none;" class="alert alert-danger" id="phan_hoi_that_bai">
																	<center>
																		<strong>Gởi phản hồi thất bại</strong> Vui lòng kiểm tra lại.
																	</center>
																</div>
																<div style="display: none;" class="alert alert-success" id="phan_hoi_thanh_cong">
																	<center>
																		<strong>Thành công! Phản hồi sẽ được hiển thị sau khi xét duyệt!</strong>
																	</center>
																</div>
																@csrf
																<p class="feedback-form">
																	<label for="feedback"> Nội dung </label><span class="required">*</span>
																	<textarea id="feedback" name="noi_dung" cols="45" rows="8" required></textarea>
																</p>

																<div class="feedback-input">
																	<p class="feedback-form-author">
																		<label for="author">Họ và tên <span class="required">*</span>
																		</label>
																		@if(Auth::guard('web')->check())
																		<input id="check_locked" name="check_locked" value="{{Auth::guard('web')->user()->locked}}" hidden>
																		<input id="author" name="ho_ten" value="{{Auth::guard('web')->user()->display_name}}" size="30" required type="text">
																		@else
																		<input id="author" name="ho_ten" value="" size="30" required type="text">
																		<input id="check_locked" name="check_locked" value="0" hidden>
																		@endif
																	</p>
																	<p class="feedback-form-author feedback-form-email">
																		<label for="email">Email <span class="required">*</span>
																		</label>
																		@if(Auth::guard('web')->check())
																		<input type="email" id="email" name="email" value="{{Auth::guard('web')->user()->email}}" size="30" required type="text">
																		@else
																		<input type="email" id="email" name="email" value="" size="30" required type="text">
																		@endif
																	</p>
																	<input name="id_sp" value="{{$san_pham->id}}" hidden>
																	<div class="pb-15">
																		<span class="required pb-15"><sub>*</sub> Trường bắt buộc</span>
																	</div>

																	<div class="feedback-btn pb-15">
																		<a href="#" class="close" data-dismiss="modal" aria-label="Close">Đóng</a>
																		<button type="submit">Gởi</button>
																	</div>
																</div>
															</form>
														</div>
													</div>
													<!-- Feedback Area End Here -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Quick View | Modal Area End Here -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Laptop Product Area -->
@if(count($san_pham_cung_loai) != 0)
<section class="product-area li-laptop-product pt-30 pb-50">
	<div class="container">
		<div class="row">
			<!-- Begin Li's Section Area -->
			<div class="col-lg-12">
				<div class="li-section-title">
					<h2>
						<span>{{count($san_pham_cung_loai)}} sản phẩm khác :</span>
					</h2>
				</div>
				<div class="row">
					<div class="product-active owl-carousel">
						@foreach($san_pham_cung_loai as $spcl)
						<div class="col-lg-12">
							<!-- single-product-wrap start -->
							<div class="single-product-wrap">
								<div class="product-image">
									@if(count($share_sp_toan_bo_hinh_anh_chinh) != 0)
									@foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp)
									@if($tbhasp->id_sp == $spcl->id)
									<a href="san-pham/{{changeTitle($spcl->ten)}}-a{{$spcl->id}}.html">
										<img src="uploads/images/products/{{$tbhasp->ten}}" alt="{{$spcl->mo_ta}}">
									</a>
									@break
									@endif
									@endforeach
									@else
									<a href="javascript:void(0)">
										<img src="https://via.placeholder.com/300x300" alt="{{$spcl->mo_ta}}">
									</a>
									@endif
									@if($spcl->moi == 1)
									<span class="sticker">Mới</span>
									@endif
								</div>
								<div class="product_desc">
									<div class="product_desc_info">
										<h4><a class="product_name" href="san-pham/{{changeTitle($spcl->ten)}}-a{{$spcl->id}}.html">{{$spcl->ten}}</a></h4>
										@if($spcl->khuyen_mai != 0)
										<div class="price-box">
											<span class="new-price new-price-2">{{number_format($spcl->gia_ban)}}₫</span>
											<span class="old-price">{{number_format($spcl->gia_goc)}}₫</span>
										</div>
										@else
										<div class="price-box">
											<span class="new-price">{{number_format($spcl->gia_goc)}}₫</span>
										</div>
										@endif
									</div>
									<div class="add-actions">
										<ul class="add-actions-link">
											<li class="add-cart active"><a href="javascript:void(0)" onclick="themGioHang({{$spcl->id}})">Thêm giỏ hàng</a></li>
											<li><a class="links-details" href="javascript:void(0)" onclick="themSpYeuThich({{$spcl->id}})"><i class="fa fa-heart-o"></i></a></li>
											<li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#xemnhanhsanpham{{$spcl->id}}"><i class="fa fa-eye"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- single-product-wrap end -->
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<!-- Li's Section Area End Here -->
		</div>
	</div>
</section>
<!-- Li's Laptop Product Area End Here -->
@endif
@endsection

@section('script')
<script>
	$("#form_phan_hoi").submit(function(){
		if($('#check_locked').val() != 0){
			Lobibox.notify('Lỗi', {
				width: $(window).width(),
				msg: 'Tài khoản của bạn bị tạm khóa chức năng này. Chúng tôi nhận thấy một số hoạt động vi phạm gần đây!'
			});
		}
		else{
			$.ajax({
				type: "POST",
				url: 'phan-hoi',
				data: $('#form_phan_hoi').serialize(),
				success: function( msg ) {
					if(msg != "false"){
						$("#phan_hoi_thanh_cong").css("display", "block");
						$('#form_phan_hoi').trigger("reset");
					}
					else{
						$("#phan_hoi_that_bai").css("display", "block");
					}
				}
			});
		}

		return false;
	});

	function themCoSoLuong(){
        var so_luong = $('#so_luong_sp_dat_hang').val();
        var so_luong_kho = $('#so_luong_hien_tai').val();
        var check = new RegExp('^(0*)[1-9][0-9]*$');
        if(so_luong > so_luong_kho)
        {
            Lobibox.notify('error', {
				size: 'mini',
                msg: `Số lượng bạn đặt mua đã vượt quá số lượng có trong kho. Hiện tại kho chỉ còn ${so_luong_kho} sản phẩm`,
                delay: 5000,
                position: "top right"
			});
            $('#so_luong_sp_dat_hang').val('1');
            return false;
        }
		if (check.test(so_luong) && (so_luong != '')) {
			$.ajax({
				type: "POST",
				url: 'them-gio-hang-co-so-luong',
				data: $('#form_them_hang').serialize(),
				success: function( msg ) {
					$("#so_luong_gio_hang").html(msg[0]);
					$("#hien_thi_gio_hang").html(msg[1]);
					$('#so_luong_sp_dat_hang').val('1');
					Lobibox.notify('success', {
						size: 'mini',
						msg: 'Sản phẩm đã được thêm vào giỏ hàng.'
					});
				}
			});
		}
		else {
			Lobibox.notify('error', {
				size: 'mini',
				msg: 'Số lượng không hợp lệ. Chỉ được nhập vào số!'
			});
			$('#so_luong_sp_dat_hang').val('1');
			return false;
		}
    }
    $(function(){
   $('#so_luong_sp_dat_hang').change(function(e) {
    var so_luong_kho = $('#so_luong_hien_tai').val();
            var so_luong = $('#so_luong_sp_dat_hang').val();
                if(so_luong > so_luong_kho)
            {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: `Số lượng bạn đặt mua đã vượt quá số lượng có trong kho. Hiện tại kho chỉ còn ${so_luong_kho} sản phẩm`,
                        delay: 2000,
                        position: "top right"
                    });
                    $('#so_luong_sp_dat_hang').val('1');
                    return false;

            }
            return true;
   });
   $(".qtybutton").on("click", function() {
    var so_luong_kho = $('#so_luong_hien_tai').val();
            var so_luong = $('#so_luong_sp_dat_hang').val();
                if(so_luong > so_luong_kho)
            {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: `Số lượng bạn đặt mua đã vượt quá số lượng có trong kho. Hiện tại kho chỉ còn ${so_luong_kho} sản phẩm`,
                        delay: 2000,
                        position: "top right"
                    });
                    $('#so_luong_sp_dat_hang').val('1');
                    return false;

            }
            return true;
   });

    });
    function checkStore(evt) {
            var so_luong_kho = $('#so_luong_hien_tai').val();
            var so_luong = $('#so_luong_sp_dat_hang').val();
                if(so_luong > so_luong_kho)
            {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: `Số lượng bạn đặt mua đã vượt quá số lượng có trong kho. Hiện tại kho chỉ còn ${so_luong_kho} sản phẩm`,
                        delay: 2000,
                        position: "top right"
                    });
                    $('#so_luong_sp_dat_hang').val('1');
                    return false;

            }
            return true;
        }


</script>
@endsection
