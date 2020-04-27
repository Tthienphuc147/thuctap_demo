<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DanhMucSanPhamController extends Controller
{ 
  
    // Trả về giao diện sản phẩm theo danh mục
    public function index($tenkhongdau, $id)
    {
        $cai_dat_chung = DB::table('cai_dat_san_phams')->first(); 
        $danh_muc_theo_id = DB::table('danh_muc_san_phams')
        ->where('is_delete','=','0')
        ->where('id','=',$id)
        ->first();
        if ($danh_muc_theo_id != null) {
            $loai_san_pham_theo_danh_muc = DB::table('loai_san_phams')
            ->where('is_delete','=','0')
            ->where('id_danh_muc_sp','=',$id)
            ->get();  
            $muoi_loai_san_pham_ngau_nhien = DB::table('loai_san_phams')
            ->where('is_delete','=','0')
            ->inRandomOrder() 
            ->take(10)
            ->get(); 
            $tat_ca_san_pham_theo_danh_muc = DB::table('san_phams')
            ->join('loai_san_phams','san_phams.id','=','loai_san_phams.id')    
            ->join('danh_muc_san_phams','danh_muc_san_phams.id','=','loai_san_phams.id_danh_muc_sp')
            ->select('san_phams.*','danh_muc_san_phams.id as id_danh_muc_sp')
            ->where('san_phams.is_delete','=','0')   
            ->where('id_danh_muc_sp','=',$id) 
            ->orderBy('id', 'DESC')  
            ->paginate($cai_dat_chung->so_luong_sp_trang_danh_muc);  
            return view('user.pages.category')->with(compact('danh_muc_theo_id','loai_san_pham_theo_danh_muc','tat_ca_san_pham_theo_danh_muc','muoi_loai_san_pham_ngau_nhien')); 
            
        }
        return view('user.pages.404'); 
    }

    public function getLocDanhMucSp($tenkhongdau, $id, $status){   
        $cai_dat_chung = DB::table('cai_dat_san_phams')->first();
        $danh_muc_theo_id = DB::table('danh_muc_san_phams')
        ->where('is_delete','=','0')
        ->where('id','=',$id)
        ->first();
        $dieukien = '';
        $sapxep = '';
        switch ($status) {
            case '1':
                $dieukien = 'ten';
                $sapxep = 'ASC'; 
            break;
            case '2':
                $dieukien = 'ten';
                $sapxep = 'DESC'; 
            break;
            case '3':
                $dieukien = 'gia_ban';
                $sapxep = 'ASC'; 
            break;
            case '4':
                $dieukien = 'gia_ban';
                $sapxep = 'DESC'; 
            break;
            default: 
            break;
        }
        if ($danh_muc_theo_id != null) {
            $loai_san_pham_theo_danh_muc = DB::table('loai_san_phams')
            ->where('is_delete','=','0')
            ->where('id_danh_muc_sp','=',$id)
            ->get();  
            $muoi_loai_san_pham_ngau_nhien = DB::table('loai_san_phams')
            ->where('is_delete','=','0')
            ->inRandomOrder() 
            ->take(10)
            ->get(); 
            $tat_ca_san_pham_theo_danh_muc = DB::table('san_phams')
            ->join('loai_san_phams','san_phams.id','=','loai_san_phams.id')    
            ->join('danh_muc_san_phams','danh_muc_san_phams.id','=','loai_san_phams.id_danh_muc_sp')
            ->select('san_phams.*','danh_muc_san_phams.id as id_danh_muc_sp')
            ->where('san_phams.is_delete','=','0')   
            ->where('id_danh_muc_sp','=',$id)  
            ->orderBy($dieukien, $sapxep)
            ->paginate($cai_dat_chung->so_luong_sp_trang_danh_muc);  
            return view('user.pages.category')->with(compact('danh_muc_theo_id','loai_san_pham_theo_danh_muc','tat_ca_san_pham_theo_danh_muc','muoi_loai_san_pham_ngau_nhien'));
            
        }
        return view('user.pages.404'); 
    } 
}
