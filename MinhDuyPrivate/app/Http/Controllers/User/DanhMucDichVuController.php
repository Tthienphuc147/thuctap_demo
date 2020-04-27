<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DanhMucDichVuController extends Controller
{
    public function getToanBoDichVu(){
		// $cai_dat_dich_vu = DB::table('cai_dat_tin_tucs')->first();  
		$toan_bo_dich_vu = DB::table('dich_vus')  
		->orderBy('id','DESC') 
		// ->paginate($cai_dat_dich_vu->so_luong_tat_ca); 
		->paginate(1); 
		return view('user.pages.services',compact('toan_bo_dich_vu'));  
	}

	public function getDanhMucDichVu($ten_khong_dau ,$id_danh_muc){
		$cai_dat_dich_vu = DB::table('cai_dat_tin_tucs')->first();   
		$danh_muc_dich_vus = DB::table('danh_muc_dich_vus')->where('id','=',$id_danh_muc)->first();
		if($danh_muc_dich_vus != null){     
			$tin_theo_danh_muc = DB::table('dich_vus')
			->join('loai_dich_vus','loai_dich_vus.id','dich_vus.id_loai_dich_vu')
			->join('danh_muc_dich_vus','loai_dich_vus.id_danh_muc_dich_vu','danh_muc_dich_vus.id') 
			->where('danh_muc_dich_vus.id','=',$id_danh_muc)
			->select('dich_vus.*') 
			->orderBy('dich_vus.id','DESC')
			->paginate($cai_dat_dich_vu->so_luong_danh_muc); 
			return view('user.pages.service_category',compact('danh_muc_dich_vus','tin_theo_danh_muc'));
		}
		return view('user.pages.404');
	} 
	
	
}
