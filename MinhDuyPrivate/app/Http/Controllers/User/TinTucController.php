<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TinTucController extends Controller
{
	public function getTinTuc($ten_khong_dau, $id_tin_tuc){
		$tin_tuc = DB::table('tin_tucs')->where('id','=',$id_tin_tuc)->first();
		$admin = DB::table('admins')->where('id','=',$tin_tuc->id_admin)->first();
		if($tin_tuc != null){
			DB::table('tin_tucs')
			->where('id', $id_tin_tuc)
			->update(['luot_xem' => $tin_tuc->luot_xem + 1]); 
			return view('user.pages.blog',compact('tin_tuc','admin')); 
		}
		else{
			return view('user.pages.404');
		}
	}
	public function getTimKiemTinTuc(Request $req){
		$tu_khoa = $req->tu_khoa;
		$cai_dat_tin_tuc = DB::table('cai_dat_tin_tucs')->first();   
		$tin_tuc_tim_kiem = DB::table('tin_tucs') 
		->join('loai_tin_tucs','loai_tin_tucs.id','tin_tucs.id_loai_tin_tuc') 
		->join('admins', 'id_admin', 'admins.id')
		->where('tieu_de','like',"%$tu_khoa%") 
		->orWhere('mo_ta','like',"%$tu_khoa%")
		->select('tin_tucs.*','admins.display_name as display_name')  
		->orderBy('id','DESC')
		->paginate($cai_dat_tin_tuc->so_luong_danh_muc);
		$so_luong = DB::table('tin_tucs') 
		->join('loai_tin_tucs','loai_tin_tucs.id','tin_tucs.id_loai_tin_tuc') 
		->join('admins', 'id_admin', 'admins.id')
		->where('tieu_de','like',"%$tu_khoa%") 
		->orWhere('mo_ta','like',"%$tu_khoa%")
		->select('tin_tucs.*','admins.display_name as display_name')  
		->get();
		$so_luong = count($so_luong);
		return view('user.pages.blog_seach',compact('tin_tuc_tim_kiem','tu_khoa','so_luong'));
	}
}
