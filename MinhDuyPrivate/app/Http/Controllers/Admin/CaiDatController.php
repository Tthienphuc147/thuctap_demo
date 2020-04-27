<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Exception;
use File;

class CaiDatController extends Controller
{
    /**
     * Hiển thị trang cài đặt sản phẩm
     *
     * @return Trang quantri/caidat/sanpham
     */
    public function indexSanPham()
    {
        $status = false;
        try {
            $cai_dat_san_pham = DB::table('cai_dat_san_phams')
                ->first();
            if($cai_dat_san_pham) $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        
        return $status
            ? view("admin.pages.caidat.sanpham", compact("cai_dat_san_pham"))
            : redirect('quantri/loi404');
    }

    /**
     * Update cài  đặt sản phẩm.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSanPham(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            DB::table('cai_dat_san_phams')
                ->update([
                    'so_luong_noi_bat' => $request->so_luong_noi_bat,
                    'so_luong_moi' => $request->so_luong_moi,
                    'so_luong_ban_chay' => $request->so_luong_ban_chay,
                    'so_luong_theo_danh_muc' => $request->so_luong_theo_danh_muc,
                    'so_luong_khuyen_mai' => $request->so_luong_khuyen_mai,
                    'so_luong_theo_loai_ngau_nhien' => $request->so_luong_theo_loai_ngau_nhien,
                    'so_luong_sp_trang_danh_muc' => $request->so_luong_sp_trang_danh_muc,
                    'so_luong_sp_trang_loai' => $request->so_luong_sp_trang_loai,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        return response()->json([
                'status' => $status
            ]);
    }

    /**
     * Them tu khoa san pham.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTuKhoaSanPham(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            $cai_dat_san_pham = DB::table('cai_dat_san_phams')
                ->first();
            if(in_array(strtolower(trim($request->tu_khoa)), array_map('strtolower', explode(',', $cai_dat_san_pham->tu_khoa)))){
                $check_str = true;
            } else {
                $check_str = false;
                DB::table('cai_dat_san_phams')
                    ->update([
                        'tu_khoa' => $cai_dat_san_pham->tu_khoa . trim($request->tu_khoa). ',',
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            }                
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        return response()->json([
                'status' => $status,
                'str_tu_khoa' => $cai_dat_san_pham->tu_khoa . ',' . trim($request->tu_khoa),
                'check_str' => $check_str,
            ]);
    }

    /**
     * Xoa tu khoa san pham.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteTuKhoaSanPham(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            $cai_dat_san_pham = DB::table('cai_dat_san_phams')
                ->first();
            if(in_array(strtolower(trim($request->tu_khoa)), array_map('strtolower', explode(',', $cai_dat_san_pham->tu_khoa)))){
                $check_str = true;
                DB::table('cai_dat_san_phams')
                    ->update([
                        'tu_khoa' => str_replace(trim($request->tu_khoa) . ',', '', $cai_dat_san_pham->tu_khoa),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            } else {
                $check_str = false;
            }                
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return response()->json([
                'status' => $status,
                'str_tu_khoa' => str_replace(trim($request->tu_khoa) . ',', '', $cai_dat_san_pham->tu_khoa),
                'check_str' => $check_str,
            ]);
    }

    /**
     * Hiển thị trang cài đặt tin tức
     *
     * @return Trang quantri/caidat/tintuc
     */
    public function indexTinTuc()
    {
        $status = false;
        try {
            $cai_dat_tin_tuc = DB::table('cai_dat_tin_tucs')
                ->first();
            if($cai_dat_tin_tuc) $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? view("admin.pages.caidat.tintuc", compact("cai_dat_tin_tuc"))
            : redirect('quantri/loi404');
    }

    /**
     * Update cài  đặt tin tức.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTinTuc(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            DB::table('cai_dat_tin_tucs')
                ->update([
                    'so_luong_danh_muc' => $request->so_luong_danh_muc,
                    'so_luong_the_loai' => $request->so_luong_the_loai,
                    'so_luong_tat_ca' => $request->so_luong_tat_ca,
                    'so_luong_tim_kiem' => $request->so_luong_tim_kiem,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        return response()->json([
                'status' => $status
            ]);
    }

     /**
     * Them tu khoa tin tuc.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTuKhoaTinTuc(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            $cai_dat_tin_tuc = DB::table('cai_dat_tin_tucs')
                ->first();
            if(in_array(strtolower(trim($request->tu_khoa)), array_map('strtolower', explode(',', $cai_dat_tin_tuc->tu_khoa)))){
                $check_str = true;
            } else {
                $check_str = false;
                DB::table('cai_dat_tin_tucs')
                    ->update([
                        'tu_khoa' => $cai_dat_tin_tuc->tu_khoa . trim($request->tu_khoa). ',',
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            }                
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        return response()->json([
                'status' => $status,
                'str_tu_khoa' => $cai_dat_tin_tuc->tu_khoa . ',' . trim($request->tu_khoa),
                'check_str' => $check_str,
            ]);
    }

     /**
     * Xoa tu khoa tin tuc.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteTuKhoaTinTuc(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            $cai_dat_tin_tuc = DB::table('cai_dat_tin_tucs')
                ->first();
            if(in_array(strtolower(trim($request->tu_khoa)), array_map('strtolower', explode(',', $cai_dat_tin_tuc->tu_khoa)))){
                $check_str = true;
                DB::table('cai_dat_tin_tucs')
                    ->update([
                        'tu_khoa' => str_replace(trim($request->tu_khoa) . ',', '', $cai_dat_tin_tuc->tu_khoa),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            } else {
                $check_str = false;
            }                
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return response()->json([
                'status' => $status,
                'str_tu_khoa' => str_replace(trim($request->tu_khoa) . ',', '', $cai_dat_tin_tuc->tu_khoa),
                'check_str' => $check_str,
            ]);
    }

    /**
     * Hiển thị trang cài đặt tin tức
     *
     * @return Trang quantri/caidat/tintuc
     */
    public function indexDichVu()
    {
        $status = false;
        try {
            $cai_dat_dich_vu = DB::table('cai_dat_dich_vus')
                ->first();
            if($cai_dat_dich_vu) $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? view("admin.pages.caidat.dichvu", compact("cai_dat_dich_vu"))
            : redirect('quantri/loi404');
    }

    /**
     * Update cài  đặt tin tức.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDichVu(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            DB::table('cai_dat_dich_vus')
                ->update([
                    'so_luong_danh_muc' => $request->so_luong_danh_muc,
                    'so_luong_the_loai' => $request->so_luong_the_loai,
                    'so_luong_tat_ca' => $request->so_luong_tat_ca,
                    'so_luong_tim_kiem' => $request->so_luong_tim_kiem,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        return response()->json([
                'status' => $status
            ]);
    }

     /**
     * Them tu khoa tin tuc.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTuKhoaDichVu(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            $cai_dat_dich_vu = DB::table('cai_dat_dich_vus')
                ->first();
            if(in_array(strtolower(trim($request->tu_khoa)), array_map('strtolower', explode(',', $cai_dat_dich_vu->tu_khoa)))){
                $check_str = true;
            } else {
                $check_str = false;
                DB::table('cai_dat_dich_vus')
                    ->update([
                        'tu_khoa' => $cai_dat_dich_vu->tu_khoa . trim($request->tu_khoa). ',',
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            }                
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        return response()->json([
                'status' => $status,
                'str_tu_khoa' => $cai_dat_dich_vu->tu_khoa . ',' . trim($request->tu_khoa),
                'check_str' => $check_str,
            ]);
    }

     /**
     * Xoa tu khoa tin tuc.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteTuKhoaDichVu(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            $cai_dat_dich_vu = DB::table('cai_dat_dich_vus')
                ->first();
            if(in_array(strtolower(trim($request->tu_khoa)), array_map('strtolower', explode(',', $cai_dat_dich_vu->tu_khoa)))){
                $check_str = true;
                DB::table('cai_dat_dich_vus')
                    ->update([
                        'tu_khoa' => str_replace(trim($request->tu_khoa) . ',', '', $cai_dat_dich_vu->tu_khoa),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            } else {
                $check_str = false;
            }                
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return response()->json([
                'status' => $status,
                'str_tu_khoa' => str_replace(trim($request->tu_khoa) . ',', '', $cai_dat_dich_vu->tu_khoa),
                'check_str' => $check_str,
            ]);
    }

    /**
     * Hiển thị trang cài đặt trang chủ
     *
     * @return Trang quantri/caidat/trangchu
     */
    public function indexTrangChu()
    {
        $status = false;
        try {
            $cai_dat_trang_chu = DB::table('cai_dat_trang_chus')
                ->first();
            if($cai_dat_trang_chu) $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        
        return $status
            ? view("admin.pages.caidat.trangchu", compact("cai_dat_trang_chu"))
            : redirect('quantri/loi404');
    }

    /**
     * Update cài  đặt trang chủ.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTrangChu(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {

            if($request->has('logo')){
                $img_old = DB::table('cai_dat_trang_chus')
                        ->select('logo')
                        ->first()
                        ->logo;
                $file_path = public_path("uploads/images/logo/".$img_old);
                if(File::exists($file_path)){
                    File::delete($file_path); 
                }
                $imageName = time().$request->logo->getClientOriginalName();
                $request->logo->move(public_path('uploads/images/logo/'), $imageName);
                DB::table('cai_dat_trang_chus')
                    ->update([
                        'logo' => $imageName,
                        'dia_chi' => $request->dia_chi,
                        'dia_chi_map' => $request->dia_chi_map,
                        'dien_thoai' => $request->dien_thoai,
                        'email' => $request->email,
                        'ban_quyen' => $request->ban_quyen,
                        'twitter' => $request->twitter,
                        'facebook' => $request->facebook,
                        'instagram' => $request->instagram,
                        'youtube' => $request->youtube,
                        'app_facebook' => $request->app_facebook,
                        'hien_thi_loai_ngau_nhien' => filter_var((string)$request->hien_thi_loai_ngau_nhien, FILTER_VALIDATE_BOOLEAN)? true : false,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            }
            else {
                DB::table('cai_dat_trang_chus')
                    ->update([
                        'dia_chi' => $request->dia_chi,
                        'dia_chi_map' => $request->dia_chi_map,
                        'dien_thoai' => $request->dien_thoai,
                        'email' => $request->email,
                        'ban_quyen' => $request->ban_quyen,
                        'twitter' => $request->twitter,
                        'facebook' => $request->facebook,
                        'instagram' => $request->instagram,
                        'youtube' => $request->youtube,
                        'app_facebook' => $request->app_facebook,
                        'hien_thi_loai_ngau_nhien' => filter_var((string)$request->hien_thi_loai_ngau_nhien, FILTER_VALIDATE_BOOLEAN)? true : false,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            }

            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        return response()->json([
                'status' => $status
            ]);
    }
}
