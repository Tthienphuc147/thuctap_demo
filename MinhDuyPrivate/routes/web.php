<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// --------------- NGƯỜI DÙNG --------------- //

Route::group(['prefix'=>''] , function(){
    Route::get('', function () {
        return redirect()->route('trangchinh');
    });
    Route::get('trang-chu.html','User\HomeController@index')->name('trangchinh');
    Route::group(['prefix'=>'dang-nhap','middleware'=>'check.login.user'] , function(){
        Route::get('', 'User\LoginController@index');
        Route::post('', 'User\LoginController@loginUser');
        Route::get('facebook', 'User\LoginController@checkLoginFacebook');
    });
    Route::group(['prefix'=>'dang-ky','middleware'=>'check.login.user'] , function(){
        Route::post('', 'User\LoginController@postDangKyTaiKhoan');
    });
    Route::get('dangxuat', 'User\LoginController@logOutUser');
    // Quản lý tài khoản
    Route::get('taikhoan', 'User\LoginController@changeProfile');
    Route::get('thong-tin-tai-khoan.html', 'User\LoginController@getThongTinTaiKhoan');
    Route::post('thong-tin-tai-khoan.html', 'User\LoginController@postThongTinTaiKhoan');
    // Xác thực tài khoản
    Route::group(['prefix'=>'quen-mat-khau','middleware'=>'check.login.user'] , function(){
        Route::get('', 'User\LoginController@getQuenMatKhau');
        Route::post('', 'User\LoginController@postQuenMatKhau');
        Route::get('/xac-thuc-ma', 'User\LoginController@getXacThucMatKhau');
        Route::post('/nhap-ma', 'User\LoginController@postNhapMaXacThuc');
        Route::get('/thay-doi-mat-khau.html', 'User\LoginController@getThayDoiMatKhau');
        Route::post('/thay-doi-mat-khau.html', 'User\LoginController@postThayDoiMatKhau');
    });

    // Trang danh mục sản phẩm
    Route::get('danh-muc-san-pham/{tenkhongdau}a{id}.html', 'User\DanhMucSanPhamController@index');
    Route::get('loc-danh-muc-san-pham/{tenkhongdau}a{id}b{status}.html', 'User\DanhMucSanPhamController@getLocDanhMucSp');
    // Trang loại sản phẩm
    Route::get('loai-san-pham/{tenkhongdau}a{id}.html', 'User\LoaiSanPhamController@getLoaiSanPham');
    Route::get('loc-loai-san-pham/{tenkhongdau}a{id}b{status}.html', 'User\LoaiSanPhamController@getLocLoaiSp');
    // Trang chi tiết sản phẩm
    Route::get('san-pham/{tenkhongdau}a{id}.html', 'User\SanPhamController@getSanPham');
    Route::get('san-pham.html', 'User\SanPhamController@getToanBoSanPham');
    Route::get('tim-kiem.html', 'User\SanPhamController@getTimKiemToanBoSanPham');
    Route::post('phan-hoi', 'User\SanPhamController@postPhanHoiSanPham');
    // Xử lý giỏ hàng
    Route::get('them-gio-hang/{id_san_pham}','User\GioHangController@getThemGioHang');
    Route::post('them-gio-hang-co-so-luong','User\GioHangController@postThemGioHangCoSoluong');
    Route::post('them-gio-hang-co-so-luong-modal','User\GioHangController@postThemGioHangCoSoluongModel');
    Route::get('xoa-mot-gio-hang/{id_san_pham}','User\GioHangController@getXoaMotGioHang');
    Route::get('gio-hang.html','User\GioHangController@getDanhSachGioHang');
    Route::get('huy-gio-hang.html','User\GioHangController@getHuyGioHang');
    Route::get('xoa-nhieu-gio-hang/{id_san_pham}','User\GioHangController@getXoaNhieuGioHang');
    Route::get('sua-gio-hang/{id_san_pham}/{so_luong}','User\GioHangController@getSuaGioHang');
    Route::get('dat-hang.html','User\GioHangController@getDatHang');
    // Lấy kết quả tỉnh - huyện - xã
    Route::get('ajax_quan_huyen/{id_tinh_tp}','User\GioHangController@getQuanHuyen');
    Route::get('ajax_xa_phuong/{id_quan_huyen}','User\GioHangController@getXaPhuong');
    Route::post('thanh-toan.html','User\GioHangController@getThanhToan');
    // Quản lý tin tức
    Route::get('toan-bo-tin-tuc.html','User\DanhMucTinTucController@getToanBoTinTuc');
    Route::get('danh-muc-tin-tuc/{tenkhongdau}a{id}.html','User\DanhMucTinTucController@getDanhMucTinTuc');
    Route::get('loai-tin-tuc/{tenkhongdau}a{id}.html','User\LoaiTinTucController@getLoaiTinTuc');
    Route::get('tim-kiem-tin-tuc.html','User\TinTucController@getTimKiemTinTuc');
    Route::get('tin-tuc/{tenkhongdau}a{id}.html','User\TinTucController@getTinTuc');
    // Quản lý dịch vụ
    Route::get('toan-bo-dich-vu.html','User\DanhMucDichVuController@getToanBoDichVu');
    Route::get('danh-muc-dich-vu/{tenkhongdau}a{id}.html','User\DanhMucDichVuController@getDanhMucDichVu');
    Route::get('loai-dich-vu/{tenkhongdau}a{id}.html','User\LoaiDichVuController@getLoaiDichVu');
    Route::get('tim-kiem-dich-vu.html','User\DichVuController@getTimKiemDichVu');
    Route::get('dich-vu/{tenkhongdau}a{id}.html','User\DichVuController@getDichVu');
    // Thông tin và liên hệ
    Route::get('thong-tin.html','User\ThongTinLienHeController@getThongTin');
    Route::get('lien-he.html','User\ThongTinLienHeController@getLienHe');
    Route::post('lien-he.html','User\ThongTinLienHeController@postLienHe');
    Route::get('giai-dap-thac-mac.html','User\ThongTinLienHeController@getGiaiDapThacMac');
    Route::post('dang-ky-nhan-thong-bao','User\ThongTinLienHeController@postDangKyGuiMail');

});

// --------------- QUẢN TRỊ --------------- //

Route::group(['prefix'=>'quantri','middleware'=>'check.login.admin'] , function(){
    Route::group(['prefix'=>'danhmucsanpham'] , function(){
        Route::get('danhsach','Admin\DanhMucSanPhamController@index');
        Route::get('tongdanhmuc','Admin\DanhMucSanPhamController@sum');
        Route::post('them','Admin\DanhMucSanPhamController@store');
        Route::get('chinhsua/{id}','Admin\DanhMucSanPhamController@edit');
        Route::post('chinhsua/{id}','Admin\DanhMucSanPhamController@update');
        Route::get('xoa/{id}','Admin\DanhMucSanPhamController@destroy');
    });

    Route::group(['prefix'=>'loaisanpham'] , function(){
        Route::get('danhsach','Admin\LoaiSanPhamController@index');
        Route::post('them','Admin\LoaiSanPhamController@store');
        Route::get('chinhsua/{id}','Admin\LoaiSanPhamController@edit');
        Route::post('chinhsua/{id}','Admin\LoaiSanPhamController@update');
        Route::get('xoa/{id}','Admin\LoaiSanPhamController@destroy');
    });

    Route::group(['prefix'=>'sanpham'] , function(){
        Route::get('danhsach','Admin\SanPhamController@index');
        Route::get('danhsach/{column}/{sort}','Admin\SanPhamController@orderBy');
        Route::get('xem/{id}','Admin\SanPhamController@show');
        Route::post('chinhsuamoi','Admin\SanPhamController@updateMoi');
        Route::post('chinhsuanoibat','Admin\SanPhamController@updateNoiBat');
        Route::post('chinhsuabanchay','Admin\SanPhamController@updateBanChay');
        Route::get('them','Admin\SanPhamController@create');
        Route::post('changedanhmuc','Admin\SanPhamController@changeDanhMuc');
        Route::post('them','Admin\SanPhamController@store');
        Route::get('chinhsua/{id}','Admin\SanPhamController@edit');
        Route::post('chinhsuathongso','Admin\SanPhamController@updateThongSo');
        Route::post('chinhsuathongtinchitiet','Admin\SanPhamController@updateThongTinChiTiet');
        Route::post('chinhsua','Admin\SanPhamController@update');
        Route::get('xoa/{id}','Admin\SanPhamController@destroy');
    });

    Route::group(['prefix'=>'hinhanhsanpham'] , function(){
        Route::post('them','Admin\HinhAnhSanPhamController@store');
        Route::post('changehinhchinh','Admin\HinhAnhSanPhamController@changeHinhChinh');
        Route::get('xoa/{id_sp}/{id}','Admin\HinhAnhSanPhamController@destroy');
    });

    Route::group(['prefix'=>'phanhoisanpham'] , function(){
        Route::get('danhsach','Admin\PhanHoiSanPhamController@index');
        Route::get('xem/{idsp}','Admin\PhanHoiSanPhamController@showTheoSanPham');
        Route::post('changephanhoi','Admin\PhanHoiSanPhamController@changePhanHoi');
        Route::post('changeduyet','Admin\PhanHoiSanPhamController@updateDuyet');
        Route::get('xoa/{id}','Admin\PhanHoiSanPhamController@destroy');
    });

    Route::group(['prefix'=>'hoadon'] , function(){
        Route::get('danhsach','Admin\HoaDonController@index');
        Route::post('changephiship','Admin\HoaDonController@updatePhiShip');
        Route::post('changetrangthaidendathang','Admin\HoaDonController@updateTrangThaiDenDatHang');
        Route::post('changetrangthaidendathanhtoan','Admin\HoaDonController@updateTrangThaiDenDaThanhToan');
        Route::post('changetrangthaidenhuydonhang','Admin\HoaDonController@updateTrangThaiDenHuyDonHang');
        Route::get('changeprovince/{id_province}','Admin\HoaDonController@changeProvince');
        Route::get('changedistrict/{id_ward}','Admin\HoaDonController@changeDistrict');
        Route::get('chinhsua/{id}','Admin\HoaDonController@edit');
        Route::post('chinhsua','Admin\HoaDonController@update');
        Route::get('xoa/{id}','Admin\HoaDonController@destroy');
        Route::post('xoanhieu','Admin\HoaDonController@multiDestroy');
    });

    Route::group(['prefix'=>'chitiethoadon'] , function(){
        // Hiển thị trong modal trang danh sách hóa đơn
        Route::post('danhsachtheoidhoadon','Admin\ChiTietHoaDonController@indexWithIDHoaDon');
        Route::get('them','Admin\ChiTietHoaDonController@create');
        Route::post('them','Admin\ChiTietHoaDonController@store');
        Route::post('chinhsuasoluong','Admin\ChiTietHoaDonController@updateSoLuong');
        Route::get('xoa/{id_hoa_don}/{id}','Admin\ChiTietHoaDonController@destroy');
    });

    Route::group(['prefix'=>'caidat'] , function(){
        Route::get('sanpham','Admin\CaiDatController@indexSanPham');
        Route::post('sanpham/chinhsua','Admin\CaiDatController@updateSanPham');
        Route::post('sanpham/themtukhoa','Admin\CaiDatController@addTuKhoaSanPham');
        Route::post('sanpham/xoatukhoa','Admin\CaiDatController@deleteTuKhoaSanPham');
        Route::get('tintuc','Admin\CaiDatController@indexTinTuc');
        Route::post('tintuc/chinhsua','Admin\CaiDatController@updateTinTuc');
        Route::post('tintuc/themtukhoa','Admin\CaiDatController@addTuKhoaTinTuc');
        Route::post('tintuc/xoatukhoa','Admin\CaiDatController@deleteTuKhoaTinTuc');
        Route::get('dichvu','Admin\CaiDatController@indexDichVu');
        Route::post('dichvu/chinhsua','Admin\CaiDatController@updateDichVu');
        Route::post('dichvu/themtukhoa','Admin\CaiDatController@addTuKhoaDichVu');
        Route::post('dichvu/xoatukhoa','Admin\CaiDatController@deleteTuKhoaDichVu');
        Route::get('trangchu','Admin\CaiDatController@indexTrangChu');
        Route::post('trangchu/chinhsua','Admin\CaiDatController@updateTrangChu');
    });

    Route::group(['prefix'=>'danhmuctintuc'] , function(){
        Route::get('danhsach','Admin\DanhMucTinTucController@index');
        Route::post('them','Admin\DanhMucTinTucController@store');
        Route::get('chinhsua/{id}','Admin\DanhMucTinTucController@edit');
        Route::post('chinhsua/{id}','Admin\DanhMucTinTucController@update');
        Route::get('xoa/{id}','Admin\DanhMucTinTucController@destroy');
    });

    Route::group(['prefix'=>'loaitintuc'] , function(){
        Route::get('danhsach','Admin\LoaiTinTucController@index');
        Route::post('them','Admin\LoaiTinTucController@store');
        Route::get('chinhsua/{id}','Admin\LoaiTinTucController@edit');
        Route::post('chinhsua/{id}','Admin\LoaiTinTucController@update');
        Route::get('xoa/{id}','Admin\LoaiTinTucController@destroy');
    });

    Route::group(['prefix'=>'tintuc'] , function(){
        Route::get('danhsach','Admin\TinTucController@index');
        Route::get('them','Admin\TinTucController@create');
        Route::post('changedanhmuc','Admin\TinTucController@changeDanhMuc');
        Route::post('them','Admin\TinTucController@store');
        Route::get('chinhsua/{id}','Admin\TinTucController@edit');
        Route::post('chinhsua/{id}','Admin\TinTucController@update');
        Route::get('xoa/{id}','Admin\TinTucController@destroy');
        Route::post('xoanhieu','Admin\TinTucController@multiDestroy');
    });

    Route::group(['prefix'=>'danhmucdichvu'] , function(){
        Route::get('danhsach','Admin\DanhMucDichVuController@index');
        Route::get('tongdanhmuc','Admin\DanhMucDichVuController@sum');
        Route::post('them','Admin\DanhMucDichVuController@store');
        Route::get('chinhsua/{id}','Admin\DanhMucDichVuController@edit');
        Route::post('chinhsua/{id}','Admin\DanhMucDichVuController@update');
        Route::get('xoa/{id}','Admin\DanhMucDichVuController@destroy');
    });

    Route::group(['prefix'=>'loaidichvu'] , function(){
        Route::get('danhsach','Admin\LoaiDichVuController@index');
        Route::post('them','Admin\LoaiDichVuController@store');
        Route::get('chinhsua/{id}','Admin\LoaiDichVuController@edit');
        Route::post('chinhsua/{id}','Admin\LoaiDichVuController@update');
        Route::get('xoa/{id}','Admin\LoaiDichVuController@destroy');
    });

    Route::group(['prefix'=>'dichvu'] , function(){
        Route::get('danhsach','Admin\DichVuController@index');
        Route::get('them','Admin\DichVuController@create');
        Route::post('changedanhmuc','Admin\DichVuController@changeDanhMuc');
        Route::post('them','Admin\DichVuController@store');
        Route::get('chinhsua/{id}','Admin\DichVuController@edit');
        Route::post('chinhsua/{id}','Admin\DichVuController@update');
        Route::get('xoa/{id}','Admin\DichVuController@destroy');
        Route::post('xoanhieu','Admin\DichVuController@multiDestroy');
    });

    Route::group(['prefix'=>'chamsockhachhang'] , function(){
        Route::get('hotro','Admin\HoTroController@indexDanhSachHoTro');
        Route::get('hotro/xoa/{id}','Admin\HoTroController@destroyHoTro');
        Route::post('hotro/xoanhieu','Admin\HoTroController@multiDestroy');
        Route::post('hotro/changeiswatched','Admin\HoTroController@changeIsWatched');
        Route::post('hotro/changeisread','Admin\HoTroController@changeIsRead');
        Route::get('giaidapthacmac','Admin\HoTroController@getGiaiDapThacMac');
        Route::post('giaidapthacmac/them','Admin\HoTroController@storeGiaiDapThacMac');
        Route::get('giaidapthacmac/chinhsua/{id}','Admin\HoTroController@editGiaiDapThacMac');
        Route::post('giaidapthacmac/chinhsua/{id}','Admin\HoTroController@updateGiaiDapThacMac');
        Route::get('giaidapthacmac/xoa/{id}','Admin\HoTroController@destroyGiaiDapThacMac');
    });

    Route::group(['prefix'=>'nguoidung'] , function(){
        Route::get('danhsach','Admin\NguoiDungController@index');
        Route::post('changekhoa','Admin\NguoiDungController@updateKhoa');
        Route::get('xoa/{id}','Admin\NguoiDungController@destroy');
    });

    Route::group(['prefix'=>'quantrivien'] , function(){
        Route::get('danhsach','Admin\QuanTriVienController@index');
    });

    Route::get('loi404','Admin\AdminController@loi404');
    Route::get('trangchu','Admin\AdminController@trangchu')->name('trangchu');

    Route::get('', function () {
        return redirect()->route('trangchu');
    });

    Route::get('_urlthanthien/{ten}_{id}', 'DemoController@urlthanthien')->name('url.thanthien');

    Route::get('_danhsach','DemoController@index');
    Route::get('_tinyMCE','DemoController@tinyMCE');
    Route::get('_form1','DemoController@form1');
    Route::get('_formUpload','DemoController@formUpload');

    Route::get('_demoproduct','DemoController@demoproduct');

    Route::get('_demoformadd','DemoController@demoadd');
    Route::get('_duallist','DemoController@duallist');
    Route::get('_demolink/{ndloai}a{id_loai}c{id}','DemoController@demolink');

    Route::get('_democount','DemoController@democount');
    Route::get('_demoauth','DemoController@demoauth');

    Route::get('dangxuat','Admin\DangNhapController@getLogoutAdmin');

});

// Login cho admin
Route::group(['prefix'=>'quantri'] , function(){
    Route::get('dangnhap', 'Admin\DangNhapController@getDangNhapQuanTri');
    Route::post('dangnhap','Admin\DangNhapController@postDangNhapQuanTri');
});


