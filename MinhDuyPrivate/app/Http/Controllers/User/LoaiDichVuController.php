<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LoaiDichVuController extends Controller
{
    public function getLoaiDichVu($ten_khong_dau ,$id_loai){
		$cai_dat_dich_vu = DB::table('cai_dat_dich_vus')->first();   
		$loai_dich_vus = DB::table('loai_dich_vus')->where('id','=',$id_loai)->first();
		if($loai_dich_vus != null){     
			$tin_theo_loai = DB::table('dich_vus')
			->join('loai_dich_vus','loai_dich_vus.id','dich_vus.id_loai_dich_vu')  
			->where('loai_dich_vus.id','=',$id_loai)  
			->orderBy('dich_vus.id','DESC')
			->paginate($cai_dat_dich_vu->so_luong_the_loai);
			return view('user.pages.service_list',compact('loai_dich_vus','tin_theo_loai'));
		}
		return view('user.pages.404');
	}
}
