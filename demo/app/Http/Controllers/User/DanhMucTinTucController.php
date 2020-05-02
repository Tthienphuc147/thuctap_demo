<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DanhMucTinTucController extends Controller
{
	public function getToanBoTinTuc(){
		$cai_dat_tin_tuc = DB::table('cai_dat_tin_tucs')->first();  
		$toan_bo_tin_tuc = DB::table('tin_tucs') 
		->join('admins', 'id_admin', 'admins.id')
		->orderBy('tin_tucs.id','DESC')
		->select('tin_tucs.*','admins.display_name as display_name')
		->paginate($cai_dat_tin_tuc->so_luong_tat_ca); 
							// ->get();
		// return response()->json($toan_bo_tin_tuc);
		return view('user.pages.blogs',compact('toan_bo_tin_tuc'));  
	}

	public function getDanhMucTinTuc($ten_khong_dau ,$id_danh_muc){
		$cai_dat_tin_tuc = DB::table('cai_dat_tin_tucs')->first();   
		$danh_muc_tin_tucs = DB::table('danh_muc_tin_tucs')->where('id','=',$id_danh_muc)->first();
		if($danh_muc_tin_tucs != null){     
			$tin_theo_danh_muc = DB::table('tin_tucs')
			->join('loai_tin_tucs','loai_tin_tucs.id','tin_tucs.id_loai_tin_tuc')
			->join('danh_muc_tin_tucs','loai_tin_tucs.id_danh_muc_tin_tuc','danh_muc_tin_tucs.id') 
			->join('admins', 'id_admin', 'admins.id')
			->where('danh_muc_tin_tucs.id','=',$id_danh_muc)
			->select('tin_tucs.*','admins.display_name as display_name') 
			->orderBy('tin_tucs.id','DESC')
			->paginate($cai_dat_tin_tuc->so_luong_danh_muc);
			return view('user.pages.blog_category',compact('danh_muc_tin_tucs','tin_theo_danh_muc'));
		}
		return view('user.pages.404');
	} 
	
}
