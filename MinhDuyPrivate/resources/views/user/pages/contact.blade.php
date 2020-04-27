@extends('user/layout/index')

@section('title')
Liên hệ - Phuc Store
@endsection

@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="trang-chu.html">Trang chủ</a></li>
				<li class="active">Liên hệ</li>
			</ul>
		</div>
	</div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Contact Main Page Area -->
<div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
	<div class="container mb-60">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d245368.26105001228!2d107.93803908361146!3d16.07176349225733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219c792252a13%3A0x1df0cb4b86727e06!2zxJDDoCBO4bq1bmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1587573479975!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
				<div class="contact-page-side-content">
					<h3 class="contact-page-title">Thời gian làm việc</h3>
					<p class="contact-page-message mb-25">Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas human.</p>
					<div class="single-contact-block">
						<h4><i class="fa fa-fax"></i> Địa chỉ</h4>
						<p>{{$all_share_sp_cai_dat_trang_chu->dia_chi}}</p>
					</div>
					<div class="single-contact-block">
						<h4><i class="fa fa-phone"></i> Điện thoại</h4>
						<p>Di động: {{$all_share_sp_cai_dat_trang_chu->dien_thoai}}</p>
					</div>
					<div class="single-contact-block last-child">
						<h4><i class="fa fa-envelope-o"></i> Email</h4>
						<p>{{$all_share_sp_cai_dat_trang_chu->email}}</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 order-2 order-lg-1">
				<div class="contact-form-content pt-sm-55 pt-xs-55">
                    @if(Session::get('thong_bao_ho_tro') == '1')
                    <div class="alert alert-success">
                        <strong>Thành công!</strong> Yêu cầu của bạn đã được gửi, chúng tôi sẽ liên hệ lại sớm nhất.
                    </div>
                    @endif
                    @if(Session::get('thong_bao_ho_tro') == '0')
                    <div class="alert alert-danger">
                        <strong>Thất bại!</strong> Yêu cầu của bạn đã được gửi, vui lòng kiểm tra lại.
                    </div>
                    @endif
                    <h3 class="contact-page-title">Gởi yêu cầu đến chúng tôi</h3>
                    <div class="contact-form">
                      <form action="lien-he.html" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Họ và tên <span class="required">*</span></label>
                            <input type="text" name="ten_lien_he" id="customername" required maxlength="70">
                        </div>
                        <div class="form-group">
                            <label>Email của bạn <span class="required">*</span></label>
                            <input type="email" name="mail_lien_he" id="customerEmail" required>
                        </div>
                        <div class="form-group">
                            <label>Liên hệ <span class="required">*</span></label>
                            <input type="text" name="lien_he" id="contactSubject" required>
                        </div>
                        <div class="form-group mb-30">
                            <label>Lời nhắn <span class="required">*</span></label>
                            <textarea name="loi_nhan" id="contactMessage" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" value="submit" id="submit" class="li-btn-3" name="submit">Gửi</button>
                        </div>
                    </form>
                </div>
                <p class="form-messege"></p>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Contact Main Page Area End Here -->
@endsection

