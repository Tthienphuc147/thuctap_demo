<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LoaiSanPhamController extends Controller
{ 

    public function getLoaiSanPham($ten_khong_dau, $id){
        $loai_san_pham = DB::table('loai_san_phams')
                            ->where('id','=',$id)
                            ->first();
        // return $id;
        if ($loai_san_pham != null) {  
            $cai_dat_chung = DB::table('cai_dat_san_phams')->first();   
            $san_pham_theo_loai = DB::table('san_phams') 
                                ->where('is_delete','=','0')
                                ->where('id_loai_sp','=',$id)
                                ->orderBy('id','DESC')
                                ->paginate($cai_dat_chung->so_luong_sp_trang_loai);
            return view('user.pages.shop_list')->with(compact('loai_san_pham','san_pham_theo_loai'));
            // return $san_pham_theo_loai; 
        }
        return view('user.pages.404');  
    }
    public function getLocLoaiSp($tenkhongdau, $id, $status){ 
        $cai_dat_chung = DB::table('cai_dat_san_phams')->first();
        $loai_san_pham = DB::table('loai_san_phams')
                            ->where('id','=',$id)
                            ->first();  
        if ($loai_san_pham != null) {
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
            $san_pham_theo_loai = DB::table('san_phams') 
                                ->where('is_delete','=','0')
                                ->where('id_loai_sp','=',$id)
                                ->orderBy($dieukien, $sapxep)
                                ->paginate($cai_dat_chung->so_luong_sp_trang_loai); 
            return view('user.pages.shop_list')->with(compact('loai_san_pham','san_pham_theo_loai'));
            
        }
        return view('user.pages.404'); 
    }

}
