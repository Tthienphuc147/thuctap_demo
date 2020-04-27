<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LoaiTinTucController extends Controller
{
    public function getLoaiTinTuc($ten_khong_dau ,$id_loai){
		$cai_dat_tin_tuc = DB::table('cai_dat_tin_tucs')->first();   
		$loai_tin_tucs = DB::table('loai_tin_tucs')->where('id','=',$id_loai)->first();
		if($loai_tin_tucs != null){     
			$tin_theo_loai = DB::table('tin_tucs')
			->join('loai_tin_tucs','loai_tin_tucs.id','tin_tucs.id_loai_tin_tuc') 
			->join('admins', 'id_admin', 'admins.id')
			->select('tin_tucs.*','admins.display_name as display_name') 
			->where('loai_tin_tucs.id','=',$id_loai)  
			->orderBy('tin_tucs.id','DESC')
			->paginate($cai_dat_tin_tuc->so_luong_the_loai);
			return view('user.pages.blog_list',compact('loai_tin_tucs','tin_theo_loai'));
		}
		return view('user.pages.404');
	}
}
