<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB, View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); 
        View::composer('user/*', function ($view) {
            $all_share_sp_cai_dat_san_pham = DB::table('cai_dat_san_phams')->first(); 
            $all_share_danh_muc_san_pham = DB::table('danh_muc_san_phams')->where('is_delete','=','0')
            ->get(); 
            $all_share_loai_san_pham = DB::table('loai_san_phams')->where('is_delete','=','0')
            ->get(); 
            $all_share_loai_san_pham_rand = DB::table('loai_san_phams')->where('is_delete','=','0')
            ->inRandomOrder() 
            ->get(); 
            $all_share_san_pham = DB::table('san_phams')->where('is_delete','=','0') 
            ->get(); 
            $all_share_sp_cai_dat_trang_chu = DB::table('cai_dat_trang_chus')
            ->first(); 
            $all_share_users = DB::table('users')->get();
            $all_share_tin_tucs = DB::table('tin_tucs')->get();
            $all_share_dich_vus = DB::table('dich_vus')->get();
            $all_share_tu_khoa = explode(',', $all_share_sp_cai_dat_san_pham->tu_khoa);  
            $view->with([
                'all_share_danh_muc_san_pham' => $all_share_danh_muc_san_pham,
                'all_share_loai_san_pham' => $all_share_loai_san_pham,
                'all_share_tu_khoa' => $all_share_tu_khoa, 
                'all_share_sp_cai_dat_trang_chu' => $all_share_sp_cai_dat_trang_chu,
                'all_share_loai_san_pham_rand' => $all_share_loai_san_pham_rand,
                'all_share_san_pham' => $all_share_san_pham,
                'all_share_users' => $all_share_users,
                'all_share_tin_tucs' => $all_share_tin_tucs,
                'all_share_dich_vus' => $all_share_dich_vus
            ]); 
        });
        // Share dữ liệu Sản Phẩm
        View::composer(['user.*'], function ($view) {
           // Lấy cài đặt sản phẩm
            $share_sp_cai_dat_san_pham = DB::table('cai_dat_san_phams')->first(); 
            // Lấy toàn bộ sản phẩm
            $share_sp_toan_bo = DB::table('san_phams')
            ->join('loai_san_phams','san_phams.id','=','loai_san_phams.id')    
            ->join('danh_muc_san_phams','danh_muc_san_phams.id','=','loai_san_phams.id_danh_muc_sp')
            ->select('san_phams.*','danh_muc_san_phams.id as id_danh_muc_sp')
            ->where('san_phams.is_delete','=','0')     
            ->get(); 
            $share_sp_tat_ca = DB::table('san_phams') 
            ->where('is_delete','=','0')     
            ->get();
             // Lấy toàn bộ hình chính của tất cả sản phẩm
            $share_sp_toan_bo_hinh_anh_chinh = DB::table('hinh_anh_san_phams')
            ->where('is_delete','=','0') 
            ->where('hinh_chinh','=','1')
            ->get();
            // Lấy toàn bộ hình ảnh của tất cả sản phẩm
            $share_sp_toan_bo_hinh_anh_san_pham = DB::table('hinh_anh_san_phams') 
            ->where('is_delete','=','0')
            ->get();   
            // Lấy tất cả danh mục sản phẩm ngẫu nhiên 
            $share_sp_danh_muc_san_pham_ngau_nhien = DB::table('danh_muc_san_phams')
            ->where('is_delete','=','0')
            ->inRandomOrder() 
            ->get();  
            $view->with([
                'share_sp_cai_dat_san_pham' => $share_sp_cai_dat_san_pham, 
                'share_sp_toan_bo_hinh_anh_chinh' => $share_sp_toan_bo_hinh_anh_chinh,
                'share_sp_toan_bo_hinh_anh_san_pham' => $share_sp_toan_bo_hinh_anh_san_pham,
                'share_sp_danh_muc_san_pham_ngau_nhien' =>$share_sp_danh_muc_san_pham_ngau_nhien,
                'share_sp_toan_bo' => $share_sp_toan_bo,
                'share_sp_tat_ca' => $share_sp_tat_ca,
            ]);
        });

        // Share dữ liệu Tin Tức
        View::composer(['user.*'], function ($view) {
           // Lấy cài đặt Tin Tức
            $share_tt_cai_dat_tin_tuc = DB::table('cai_dat_tin_tucs')->first();  
            $share_tt_danh_muc_tin_tuc = DB::table('danh_muc_tin_tucs') 
            ->get();  
            $share_tt_loai_tin_tuc = DB::table('loai_tin_tucs')  
            ->get();   
            $share_toan_bo_tin_tuc = DB::table('tin_tucs') 
            ->get(); 
            $share_tu_khoa_tin_tuc = explode(',', $share_tt_cai_dat_tin_tuc->tu_khoa);
            $view->with([
                'share_tt_cai_dat_tin_tuc' => $share_tt_cai_dat_tin_tuc,  
                'share_tt_danh_muc_tin_tuc' => $share_tt_danh_muc_tin_tuc,
                'share_tt_loai_tin_tuc' => $share_tt_loai_tin_tuc,
                'share_tu_khoa_tin_tuc' => $share_tu_khoa_tin_tuc,
                'share_toan_bo_tin_tuc' => $share_toan_bo_tin_tuc,
            ]);
        });
        // Share dữ liệu Dịch vụ
        View::composer(['user.*'], function ($view) {
           // Lấy cài đặt Tin Tức
            $share_tt_cai_dat_dich_vu = DB::table('cai_dat_dich_vus')->first();  
            $share_tt_danh_muc_dich_vu = DB::table('danh_muc_dich_vus') 
            ->get();  
            $share_tt_loai_dich_vu = DB::table('loai_dich_vus')  
            ->get();   
            $share_toan_bo_dich_vu = DB::table('dich_vus') 
            ->get(); 
            $share_tu_khoa_dich_vu = explode(',', $share_tt_cai_dat_dich_vu->tu_khoa);
            $view->with([
                'share_tt_cai_dat_dich_vu' => $share_tt_cai_dat_dich_vu,  
                'share_tt_danh_muc_dich_vu' => $share_tt_danh_muc_dich_vu,
                'share_tt_loai_dich_vu' => $share_tt_loai_dich_vu,
                'share_tu_khoa_dich_vu' => $share_tu_khoa_dich_vu,
                'share_toan_bo_dich_vu' => $share_toan_bo_dich_vu,
            ]);
        });
        // Admin
        View::composer(['admin.*'], function ($view){
            $share_thong_bao_phan_hoi_sp = DB::table('phan_hoi_san_phams')
            ->join('san_phams', 'id_sp', 'san_phams.id')
            ->where('phan_hoi_san_phams.is_delete', false)
            ->where('san_phams.is_delete', false)
            ->where('phan_hoi_san_phams.doc', false)
            ->select([
                'san_phams.id',
                'san_phams.ten', 
                DB::raw('count(*) as tong')
            ])
            ->groupBy('san_phams.id', 'san_phams.ten')
            ->orderBy('san_phams.id', 'ASC')
            ->get();
            
            $share_dem_is_watched_ho_tro = DB::table('ho_tros')
                ->where('is_watched', false)
                ->count();

            $share_dem_is_read_ho_tro = DB::table('ho_tros')
                ->where('is_read', false)
                ->count();
            $view->with([
                'share_thong_bao_phan_hoi_sp' => $share_thong_bao_phan_hoi_sp,
                'share_dem_is_watched_ho_tro' => $share_dem_is_watched_ho_tro,
                'share_dem_is_read_ho_tro' => $share_dem_is_read_ho_tro,
            ]); 
        }); 

    }
}
