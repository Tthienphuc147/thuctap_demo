<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Session, Exception;
use App\Heart;

class SanPhamYeuThichController extends Controller
{
	public function themSanPhamYeuThich(Request $req, $id_sp){
    	// return $id_sp;
		$san_pham = DB::table('san_phams')->where('id','=',$id_sp)->first();
		if($san_pham != null){
			$yeu_thich_hien_tai = Session('yeu_thich_hien_tai') ? Session::get('yeu_thich_hien_tai') : null;
			$yeu_thich_moi = new Heart($yeu_thich_hien_tai);
			$yeu_thich_moi->themYeuThich($san_pham, $id_sp); 
			if(Session::has('yeu_thich_hien_tai') && array_key_exists($id_sp, $yeu_thich_hien_tai->san_phams)){ 
				return "exist"; 
			}  
			$req->session()->put('yeu_thich_hien_tai', $yeu_thich_moi);

			$ket_qua = '<a href="danh-sach-yeu-thich.html">
			<span class="cart-item-count wishlist-item-count">'.(count(Session('yeu_thich_hien_tai')->san_phams)).'</span>
			<i class="fa fa-heart-o"></i>
			</a>';
			return $ket_qua; 
		}
		return view('user.pages.404'); 
	}
	public function getDanhSachYeuThich(){
		return view('user.pages.whishlist');
	}
	public function getHuySachYeuThich(){
		Session::forget('yeu_thich_hien_tai');
		return redirect('trang-chu.html');
	}
	public function getXoaMotYeuThich(Request $req, $id_sp){
		$san_pham = DB::table('san_phams')->where('id','=',$id_sp)->first();
		if($san_pham != null){
			$yeu_thich_hien_tai = Session('yeu_thich_hien_tai') ? Session::get('yeu_thich_hien_tai') : null;
			$yeu_thich_moi = new Heart($yeu_thich_hien_tai);
			$yeu_thich_moi->xoaYeuThich($id_sp);
			$req->session()->put('yeu_thich_hien_tai', $yeu_thich_moi);
			if(count(Session('yeu_thich_hien_tai')->san_phams) == 0){
				Session::forget('yeu_thich_hien_tai'); 
			}
			return back();  
		}
		return view('user.pages.404');  
	}
}
