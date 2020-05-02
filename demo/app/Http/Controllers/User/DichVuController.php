<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DichVuController extends Controller
{
    public function getDichVu($ten_khong_dau, $id_dich_vu){
		$dich_vu = DB::table('dich_vus')->where('id','=',$id_dich_vu)->first(); 
		if($dich_vu != null){ 
			return view('user.pages.service',compact('dich_vu')); 
		}
		else{
			return view('user.pages.404');
		}
	}
	public function getTimKiemDichVu(Request $req){
		$tu_khoa = $req->tu_khoa;
		$cai_dat_dich_vu = DB::table('cai_dat_dich_vus')->first();   
		$dich_vu_tim_kiem = DB::table('dich_vus') 
		->join('loai_dich_vus','loai_dich_vus.id','dich_vus.id_loai_dich_vu')  
		->where('tieu_de','like',"%$tu_khoa%") 
		->orWhere('mo_ta','like',"%$tu_khoa%")
		->select('dich_vus.*')  
		->orderBy('id','DESC')
		->paginate($cai_dat_dich_vu->so_luong_danh_muc);
		$so_luong = DB::table('dich_vus') 
		->join('loai_dich_vus','loai_dich_vus.id','dich_vus.id_loai_dich_vu')  
		->where('tieu_de','like',"%$tu_khoa%") 
		->orWhere('mo_ta','like',"%$tu_khoa%")
		->select('dich_vus.*')  
		->get();
		$so_luong = count($so_luong);
		return view('user.pages.service_seach',compact('dich_vu_tim_kiem','tu_khoa','so_luong'));
	}
}
