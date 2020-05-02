<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SanPhamController extends Controller
{ 
    public function getSanPham($ten_khong_dau, $id){
    	$san_pham = DB::table('san_phams')
                       ->where('id','=',$id)
                       ->first();
       if($san_pham != null){
          $hinh_anh_san_pham = DB::table('hinh_anh_san_phams')
          ->where('id_sp','=',$id)
          ->get();
          $san_pham_cung_loai = DB::table('san_phams')
          ->where('id_loai_sp','=',$san_pham->id_loai_sp)
          ->get();
          $phan_hoi_san_pham = DB::table('phan_hoi_san_phams')
          ->where('is_delete','=','0')
          ->where('duyet','=','1')
          ->where('id_sp','=',$id)
          ->orderBy('id','DESC')
          ->get();
          return view('user.pages.product')->with(compact('san_pham','hinh_anh_san_pham','san_pham_cung_loai','phan_hoi_san_pham'));
        }
        return view('user.pages.404');
    }
    public function postPhanHoiSanPham(Request $request){ 
        $phan_hoi = DB::table('phan_hoi_san_phams')->insert([
            'noi_dung' => $request->noi_dung,
            'ten_hien_thi' => $request->ho_ten,
            'email' => $request->email,
            'id_sp' => $request->id_sp,
            'doc' => 0,
            'xem' => 0,
            'duyet' => 0,
            'is_delete' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")]);         
        return $phan_hoi ? 'true' : 'false';
    }
    public function getToanBoSanPham(){
        $cai_dat_chung = DB::table('cai_dat_san_phams')->first();  
        $toan_bo_san_pham = DB::table('san_phams')->where('is_delete','=','0')->orderBy('id','DESC')->paginate($cai_dat_chung->so_luong_sp_trang_loai);
        return view('user.pages.products',compact('toan_bo_san_pham'));
    }

    public function getTimKiemToanBoSanPham(Request $req){
        $tu_khoa = $req->tu_khoa; 
        $cai_dat_chung = DB::table('cai_dat_san_phams')->first();  
        $san_pham_tim_kiem = DB::table('san_phams')
        ->where('is_delete','=','0')
        ->where('ten','like',"%$tu_khoa%") 
        ->orWhere('mo_ta','like',"%$tu_khoa%")
        ->orderBy('id','DESC')
        ->paginate($cai_dat_chung->so_luong_sp_trang_loai);
        return view('user.pages.seach_products',compact('san_pham_tim_kiem','tu_khoa'));
    }
}


