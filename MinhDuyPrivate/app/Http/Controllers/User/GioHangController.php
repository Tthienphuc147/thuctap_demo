<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Session, Exception;
use App\Cart;

class GioHangController extends Controller
{
	public function getThemGioHang(Request $req, $id_san_pham) {
		// Lấy toàn bộ hình chính của tất cả sản phẩm
		$share_sp_toan_bo_hinh_anh_chinh = DB::table('hinh_anh_san_phams')
		->where('is_delete','=','0')
		->where('hinh_chinh','=','1')
		->get();
		$san_pham = DB::table('san_phams')->where('id','=',$id_san_pham)->first();
		if($san_pham != null){
			$gio_hang_hien_tai = Session('gio_hang_hien_tai') ? Session::get('gio_hang_hien_tai') : null;
			$gio_hang_moi = new Cart($gio_hang_hien_tai);
			$gio_hang_moi->themGioHang($san_pham, $id_san_pham);

			$req->session()->put('gio_hang_hien_tai', $gio_hang_moi);

			// Session::forget('gio_hang_hien_tai');
			// return response()->json(Session('gio_hang_hien_tai'));
			$gio_hang = Session::get('gio_hang_hien_tai');

			$hien_thi = '<ul class="minicart-product-list">';

			$gio_hang_hien_thi = Session::get('gio_hang_hien_tai')->san_phams;
			foreach ($gio_hang_hien_thi as $gh => $san_pham) {

				foreach($san_pham as $sp => $item) {
					if($sp == 'san_pham'){
						$hien_thi .= '<li>
                        <a href="san-pham/'.changeTitle($item->ten).'-a'.$item->id.'.html" class="minicart-product-image">';

						if(count($share_sp_toan_bo_hinh_anh_chinh) != 0){
							foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp){
								if($tbhasp->id_sp == $item->id) {
									$hien_thi .= '<img src="uploads/images/products/'.$tbhasp->ten.'" alt="'.$item->ten.'">';
								}
							}
                        }

						$hien_thi .= '</a>
						<div class="minicart-product-details">
						<h6><a href="san-pham/'.changeTitle($item->ten).'-a'.$item->id.'.html">'.$item->ten.'</a></h6>
						<span>'.number_format($item->gia_ban).'₫ x '.$sl.' </span>
						</div>
						<button class="close" onclick="xoaMotGioHang('.$item->id.')">
						<i class="fa fa-close"></i>
						</button>
						</li>';
					}
				}
			}


			$hien_thi .= '</ul>
			<p class="minicart-total">Tổng: <span>'.number_format(Session::get('gio_hang_hien_tai')->tong_gia).'₫</span></p>
			<div class="minicart-button">
			<a href="gio-hang.html" class="li-button li-button-dark li-button-fullwidth li-button-sm">
			<span>Xem giỏ hàng</span>
			</a>
			<a href="dat-hang.html" class="li-button li-button-fullwidth li-button-sm">
			<span>Thanh toán</span>
			</a>
			</div> ';


			$tra_ve = array();
			$tra_ve[0] = $gio_hang->tong_so_luong;
			$tra_ve[1] = $hien_thi;
			return $tra_ve;
	// return view('user.pages.test');
		}
		else{
			return view('user.pages.404');
		}
		return redirect()->back();
	}
    public function getXoaMotGioHang($id){
		try {
			$share_sp_toan_bo_hinh_anh_chinh = DB::table('hinh_anh_san_phams')
			->where('is_delete','=','0')
			->where('hinh_chinh','=','1')
			->get();
			$gio_hang_hien_tai = Session::has('gio_hang_hien_tai') ? Session::get('gio_hang_hien_tai') : null;
			$gio_hang_moi = new Cart($gio_hang_hien_tai);
			$gio_hang_moi->xoaTungSanPham($id);
			if (count($gio_hang_moi->san_phams) > 0) {
				Session::put('gio_hang_hien_tai', $gio_hang_moi);
				$gio_hang = Session::get('gio_hang_hien_tai');

				$hien_thi = '<ul class="minicart-product-list">';

				$gio_hang_hien_thi = Session::get('gio_hang_hien_tai')->san_phams;
				foreach ($gio_hang_hien_thi as $gh => $san_pham) {
					$sl = $san_pham['so_luong'];
					foreach($san_pham as $sp => $item) {
						if($sp == 'san_pham'){
							$hien_thi .= '<li>
							<a href="san-pham/'.changeTitle($item->ten).'-a'.$item->id.'.html" class="minicart-product-image">';
							if(count($share_sp_toan_bo_hinh_anh_chinh) != 0){
								foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp){
									if($tbhasp->id_sp == $item->id) {
										$hien_thi .= '<img src="uploads/images/products/'.$tbhasp->ten.'" alt="'.$item->ten.'">';
									}
								}
							}
							$hien_thi .= '</a>
							<div class="minicart-product-details">
							<h6><a href="san-pham/'.changeTitle($item->ten).'-a'.$item->id.'.html">'.$item->ten.'</a></h6>
							<span>'.number_format($item->gia_ban).'₫ x '.$sl.' </span>
							</div>
							<button class="close" onclick="xoaMotGioHang('.$item->id.')">
							<i class="fa fa-close"></i>
							</button>
							</li>';
						}
					}
				}


				$hien_thi .= '</ul>
				<p class="minicart-total">Tổng: <span>'.number_format(Session::get('gio_hang_hien_tai')->tong_gia).'₫</span></p>
				<div class="minicart-button">
				<a href="gio-hang.html" class="li-button li-button-dark li-button-fullwidth li-button-sm">
				<span>Xem giỏ hàng</span>
				</a>
				<a href="dat-hang.html" class="li-button li-button-fullwidth li-button-sm">
				<span>Thanh toán</span>
				</a>
				</div>';


				$tra_ve = array();
				$tra_ve[0] = $gio_hang->tong_so_luong;
				$tra_ve[1] = $hien_thi;
				return $tra_ve;
			} else {
				Session::forget('gio_hang_hien_tai');
				$hien_thi = '
				<p class="minicart-total">Tổng: <span>0₫</span></p>';
				$tra_ve = array();
				$tra_ve[0] = 0;
				$tra_ve[1] = $hien_thi;
				return $tra_ve;
			}

		} catch (Exception $e) {
			return view('user.pages.404');
		}

	}

	public function postThemGioHangCoSoluong(Request $req){
		$share_sp_toan_bo_hinh_anh_chinh = DB::table('hinh_anh_san_phams')
		->where('is_delete','=','0')
		->where('hinh_chinh','=','1')
		->get();
        $san_pham = DB::table('san_phams')->where('id','=',$req->id_sp)->first();

		if($san_pham != null){
			$gio_hang_hien_tai = Session('gio_hang_hien_tai') ? Session::get('gio_hang_hien_tai') : null;
			$gio_hang_moi = new Cart($gio_hang_hien_tai);
			$gio_hang_moi->themCoSoLuong($san_pham, $req->id_sp, $req->so_luong);
            $so_luong_hien_tai = $san_pham->so_luong;
            $so_luong_con_lai = $so_luong_hien_tai - $req->so_luong;
            $san_pham1 = DB::table('san_phams')->where('id','=',$req->id_sp)->update(
                [
                    'so_luong' => $so_luong_con_lai
                ]
            );
			$req->session()->put('gio_hang_hien_tai', $gio_hang_moi);

			$gio_hang = Session::get('gio_hang_hien_tai');

			$hien_thi = '<ul class="minicart-product-list">';

			$gio_hang_hien_thi = Session::get('gio_hang_hien_tai')->san_phams;
			foreach ($gio_hang_hien_thi as $gh => $san_pham) {
				$sl = $san_pham['so_luong'];
				foreach($san_pham as $sp => $item) {
					if($sp == 'san_pham'){
						$hien_thi .= '<li>
						<a href="san-pham/'.changeTitle($item->ten).'-a'.$item->id.'.html" class="minicart-product-image">';
						if(count($share_sp_toan_bo_hinh_anh_chinh) != 0){
							foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp){
								if($tbhasp->id_sp == $item->id) {
									$hien_thi .= '<img src="uploads/images/products/'.$tbhasp->ten.'" alt="'.$item->ten.'">';
								}
							}
                        }
						$hien_thi .= '</a>
						<div class="minicart-product-details">
						<h6><a href="san-pham/'.changeTitle($item->ten).'-a'.$item->id.'.html">'.$item->ten.'</a></h6>
						<span>'.number_format($item->gia_ban).'₫ x '.$sl.' </span>
						</div>
						<button class="close" onclick="xoaMotGioHang('.$item->id.')">
						<i class="fa fa-close"></i>
						</button>
						</li>';
					}
				}
			}


			$hien_thi .= '</ul>
			<p class="minicart-total">Tổng: <span>'.number_format(Session::get('gio_hang_hien_tai')->tong_gia).'₫</span></p>
			<div class="minicart-button">
			<a href="gio-hang.html" class="li-button li-button-dark li-button-fullwidth li-button-sm">
			<span>Xem giỏ hàng</span>
			</a>
			<a href="dat-hang.html" class="li-button li-button-fullwidth li-button-sm">
			<span>Thanh toán</span>
			</a>
			</div> ';


			$tra_ve = array();
			$tra_ve[0] = $gio_hang->tong_so_luong;
			$tra_ve[1] = $hien_thi;
			return $tra_ve;
		}
		else{
			return view('user.pages.404');
		}
		return redirect()->back();
	}

	public function postThemGioHangCoSoluongModel(Request $req){
		$share_sp_toan_bo_hinh_anh_chinh = DB::table('hinh_anh_san_phams')
		->where('is_delete','=','0')
		->where('hinh_chinh','=','1')
		->get();
        $san_pham = DB::table('san_phams')->where('id','=',$req->id_sp)->first();
        $so_luong_hien_tai = $san_pham->so_luong;
        $so_luong_con_lai = $so_luong_hien_tai - $req->so_luong;
        $san_pham1 = DB::table('san_phams')->where('id','=',$req->id_sp)->update(
            [
                'so_luong' => $so_luong_con_lai
            ]
        );
		if($san_pham != null){
			$gio_hang_hien_tai = Session('gio_hang_hien_tai') ? Session::get('gio_hang_hien_tai') : null;
			$gio_hang_moi = new Cart($gio_hang_hien_tai);
			$gio_hang_moi->themCoSoLuong($san_pham, $req->id_sp, $req->so_luong);

			$req->session()->put('gio_hang_hien_tai', $gio_hang_moi);

			$gio_hang = Session::get('gio_hang_hien_tai');

			$hien_thi = '<ul class="minicart-product-list">';

			$gio_hang_hien_thi = Session::get('gio_hang_hien_tai')->san_phams;
			foreach ($gio_hang_hien_thi as $gh => $san_pham) {
				$sl = $san_pham['so_luong'];
				foreach($san_pham as $sp => $item) {
					if($sp == 'san_pham'){
						$hien_thi .= '<li>
						<a href="san-pham/'.changeTitle($item->ten).'-a'.$item->id.'.html" class="minicart-product-image">';
						if(count($share_sp_toan_bo_hinh_anh_chinh) != 0){
							foreach($share_sp_toan_bo_hinh_anh_chinh as $tbhasp){
								if($tbhasp->id_sp == $item->id) {
									$hien_thi .= '<img src="uploads/images/products/'.$tbhasp->ten.'" alt="'.$item->ten.'">';
								}
							}
                        }
						$hien_thi .= '</a>
						<div class="minicart-product-details">
						<h6><a href="san-pham/'.changeTitle($item->ten).'-a'.$item->id.'.html">'.$item->ten.'</a></h6>
						<span>'.number_format($item->gia_ban).'₫ x '.$sl.' </span>
						</div>
						<button class="close" onclick="xoaMotGioHang('.$item->id.')">
						<i class="fa fa-close"></i>
						</button>
						</li>';
					}
				}
			}


			$hien_thi .= '</ul>
			<p class="minicart-total">Tổng: <span>'.number_format(Session::get('gio_hang_hien_tai')->tong_gia).'₫</span></p>
			<div class="minicart-button">
			<a href="gio-hang.html" class="li-button li-button-dark li-button-fullwidth li-button-sm">
			<span>Xem giỏ hàng</span>
			</a>
			<a href="dat-hang.html" class="li-button li-button-fullwidth li-button-sm">
			<span>Thanh toán</span>
			</a>
			</div> ';


			$tra_ve = array();
			$tra_ve[0] = $gio_hang->tong_so_luong;
			$tra_ve[1] = $hien_thi;
			return $tra_ve;
		}
		else{
			return view('user.pages.404');
		}
		return redirect()->back();
	}

	public function getXoaNhieuGioHang($id){
		try {
			$gio_hang_hien_tai = Session::has('gio_hang_hien_tai') ? Session::get('gio_hang_hien_tai') : null;
			$gio_hang_moi = new Cart($gio_hang_hien_tai);
			$gio_hang_moi->xoaHetMotSanPham($id);
			if (count($gio_hang_moi->san_phams) > 0) {
				Session::put('gio_hang_hien_tai', $gio_hang_moi);
				return back();
			} else {
				Session::forget('gio_hang_hien_tai');
				return redirect('trang-chu.html');
			}
		} catch (Exception $e) {
			return view('user.pages.404');
		}

	}
	public function getDanhSachGioHang(){
		return view('user.pages.shopping_cart');
	}
	public function getHuyGioHang(Request $req){
		Session::forget('gio_hang_hien_tai');
		return redirect('trang-chu.html');
	}
	public function getSuaGioHang(Request $req, $id_sp, $so_luong){
		$san_pham = DB::table('san_phams')->where('id','=',$id_sp)->first();
		if($san_pham != null){
			$gio_hang_hien_tai = Session('gio_hang_hien_tai') ? Session::get('gio_hang_hien_tai') : null;
			$gio_hang_moi = new Cart($gio_hang_hien_tai);
			$gio_hang_moi->suaSoLuong($san_pham, $id_sp, $so_luong);
			$req->session()->put('gio_hang_hien_tai', $gio_hang_moi);
			return redirect()->back();
	// return view('user.pages.test');
		}
		else{
			return view('user.pages.404');
		}
		return redirect()->back();
	}
	public function getDatHang(){
		$tinh_thanhpho = DB::table('provinces')->get();
		if(count($tinh_thanhpho)){
			return view('user.pages.checkout',compact('tinh_thanhpho'));
		}
		else{
			return view('user.pages.404');
		}
	}
	// Xử lý lấy quận huyện xã phường
	public function getQuanHuyen($id_tinh_thanhpho){

		$quan_huyen = DB::table('districts')->where('province_id','=',$id_tinh_thanhpho)->get();
		$hien_thi_quan_huyen = '<select required name="quan_huyen" class="nice-select wide" onchange="ajaxQuanHuyen(this.value)">';
		$count = true;
		foreach($quan_huyen as $qh){
			if($count){
				$hien_thi_quan_huyen .= '<option data-display="'.$qh->name.'" value="'.$qh->district_id.'">'.$qh->name.'</option>';

			}
			else
				$hien_thi_quan_huyen .= '<option value="'.$qh->district_id.'">'.$qh->name.'</option>';
		}
		$hien_thi_quan_huyen .= '</select>';

		$hien_thi_xa_phuong = '<select id="selec_addres" class="required" required>
		</select>';

		$tra_ve = array();
		$tra_ve[0] = $hien_thi_quan_huyen;
		$tra_ve[1] = $hien_thi_xa_phuong;
		return $tra_ve;
	}
	public function getXaPhuong($id_quan_huyen){
		$xa_phuong = DB::table('wards')->where('district_id','=',$id_quan_huyen)->get();
		$hien_thi_xa_phuong = '<select required name="xa_phuong" class="nice-select wide">';
		$count = true;
		foreach($xa_phuong as $xp){
			if($count){
				$hien_thi_xa_phuong .= '<option data-display="'.$xp->name.'" value="'.$xp->ward_id.'">'.$xp->name.'</option>';

			}
			else
				$hien_thi_xa_phuong .= '<option value="'.$xp->ward_id.'">'.$xp->name.'</option>';
		}
		$hien_thi_xa_phuong .= '</select>';
		return $hien_thi_xa_phuong;
	}
	public function getThanhToan(Request $req){

		$ma_hoa_hon = 'HDMD'.time();

		$hoa_don = DB::table('hoa_dons')->insert(
			[
				'ma_hoa_don' => $ma_hoa_hon,
				'ten_khach_hang' => $req->ho_ten,
				'so_dien_thoai' => $req->dien_thoai,
				'email' => $req->email,
				'province_id' => $req->tinh_thanh,
				'district_id' => $req->quan_huyen,
				'ward_id' => $req->xa_phuong,
				'dia_chi' => $req->dia_chi,
				'ghi_chu' => $req->ghi_chu,
				'trang_thai' => 1,
				'phi_ship' => 0,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]
		);

		$hoa_don_dat_hang = DB::table('hoa_dons')->where('ma_hoa_don','=',$ma_hoa_hon)->first();

		$gio_hang = Session::get('gio_hang_hien_tai');
		foreach($gio_hang->san_phams as $key => $value){
			$hoa_don_chi_tiet = DB::table('chi_tiet_hoa_dons')->insert(
				[
					'id_sp' => $key ,
					'id_hoa_don' => $hoa_don_dat_hang->id,
					'so_luong' => $value['so_luong'],
					'is_delete' => 0,
					'created_at' => date("Y-m-d H:i:s"),
					'updated_at' => date("Y-m-d H:i:s")
				]
            );
            $so_luong_hien_tai = DB::table('san_phams')->where('id',$key)->select('so_luong')->get();
            $so_luong_con_lai = $so_luong_hien_tai[0]->so_luong - $value['so_luong'];
            $san_pham = DB::table('san_phams')->where('id',$key)->update(
                [
                    'so_luong' => $so_luong_con_lai
                ]
            );
        }
		if($hoa_don){
			Session::forget('gio_hang_hien_tai');
		}
		return $hoa_don ? back()->with('hoadonthanhcong','Hóa đơn thành công') : back()->with('hoadonthatbai','Hóa đơn thất bại');
	}
}

