<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;

class SanPhamController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm.
     * @return trang /quantri/sanpham/danhsach
     */
    public function index()
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        $status = false;
        try {
            $san_pham = DB::table('san_phams')
                ->join('loai_san_phams', 'id_loai_sp', 'loai_san_phams.id')
                ->where('san_phams.is_delete', false)
                ->select(
                    'san_phams.*',
                    'loai_san_phams.ten as ten_loai',
                )
                ->orderBy('san_phams.id', 'ASC')
                ->get();
            $hinh_anh_sp = DB::table('hinh_anh_san_phams')
                ->where('hinh_anh_san_phams.is_delete', false)
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.sanpham.danhsach", compact("san_pham", 'hinh_anh_sp'))
            : redirect('quantri/loi404');
        }
        return view('admin.pages.error403');
    }

    /**
     * [Sắp xếp danh sách sản phẩm]
     * @param  [type] $column   [cột muốn sắp xếp]
     * @param  [type] $order_by [kiểu sắp xếp (ASC hoặc DESC)]
     * @return trang quantri/sanpham/danhsach/{column}/{sort}
     */
    public function orderBy($column, $order_by)
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        $status = false;
        try {
            $san_pham = DB::table('san_phams')
                ->join('loai_san_phams', 'id_loai_sp', 'loai_san_phams.id')
                ->where('san_phams.is_delete', false)
                ->select(
                    'san_phams.*',
                    'loai_san_phams.ten as ten_loai',
                )
                ->orderBy($column, $order_by)
                ->get();

            $hinh_anh_sp = DB::table('hinh_anh_san_phams')
                ->where('hinh_anh_san_phams.is_delete', false)
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.sanpham.danhsach", compact("san_pham", 'hinh_anh_sp'))
            : redirect('quantri/loi404');
        }
        return view('admin.pages.error403');
    }

    /**
     * Hiển thị trang thêm sản phẩm.
     *
     * @return Trang quantri/sanpham/them
     */
    public function create()
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        $status = false;
        try {
            $danh_muc_sp = DB::table('danh_muc_san_phams')
                ->where('is_delete', false)
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.sanpham.them", compact('danh_muc_sp'))
            : redirect('quantri/loi404');
        }
        return view('admin.pages.error403');
    }

    /**
     * [Ajax bắt sự kiện khi combobox Danh mục sản phẩm thay đổi (change)]
     * @param  Request $request [params: id_danh_muc_sp]
     * @return [type]           [HTML danh sách danh mục sản phẩm]
     */
    public function changeDanhMuc(Request $request)
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        $str = "";
        try {
            $loai_sp = DB::table('loai_san_phams')
                ->where('id_danh_muc_sp', $request->id_danh_muc_sp)
                ->where('is_delete', false)
                ->orderBy('id', 'ASC')
                ->get();
            $str .= '<option value="">Chọn loại</option>';
            foreach ($loai_sp as $loai) {
                $str .= '<option value="'. $loai->id. '">'.$loai->ten.'</option>';
            }
        } catch (Exception $e) {
            $str .= '<option value="">Chọn loại</option>';
        }
        return $str;
    }
    return view('admin.pages.error403');
    }

    /**
     * Thêm 1 sản phẩm mới (bắt ajax khi submit form thêm sản phẩm).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Trạng thái: nếu đúng thì chuyển sang thêm tiếp thống số + hình ảnh
     */
    public function store(Request $request)
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        DB::beginTransaction();
        $status = false; $id = 0;
        try {
            DB::table('san_phams')
                ->insert([
                    'id_loai_sp' => $request->id_loai_sp,
                    'ten' => $request->ten,
                    'mo_ta' => $request->mo_ta,
                    'gia_goc' => round($request->gia_goc/1000)*1000,
                    'khuyen_mai' => $request->khuyen_mai,
                    'gia_ban' => round($request->gia_ban/1000)*1000,
                    'so_luong'=> $request->so_luong,
                    'ngay_bat_dau_khuyen_mai' => date('Y-m-d', strtotime(str_replace('/', '-', $request->ngay_bat_dau_khuyen_mai))),
                    'ngay_ket_thuc_khuyen_mai' => date('Y-m-d', strtotime(str_replace('/', '-', $request->ngay_ket_thuc_khuyen_mai))),
                    'moi' => $request->moi,
                    'noi_bat' => $request->noi_bat,
                    'created_at' => date("Y-m-d")
                ]);
            $id = DB::table('san_phams')->max('id');
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return response()->json([
            'status' => $status,
            'id' => $id
        ]);
    }
    return view('admin.pages.error403');
    }

    /**
     * Hiển thị thông tin của 1 sản phẩm.
     *
     * @param  int  $id
     * @return Trang quantri/sanpham/xem/{id}
     */
    public function show($id)
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        $status = false;
        try {
            $san_pham = DB::table('san_phams')
                ->join('loai_san_phams', 'id_loai_sp', 'loai_san_phams.id')
                ->where('san_phams.is_delete', false)
                ->where('san_phams.id', $id)
                ->select(
                    'san_phams.*',
                    'loai_san_phams.ten as ten_loai',
                )
                ->first();
            $hinh_anh_sp = DB::table('hinh_anh_san_phams')
                ->where('hinh_anh_san_phams.is_delete', false)
                ->where('hinh_anh_san_phams.id_sp', $id)
                ->get();
            $phan_hoi_sp = DB::table('phan_hoi_san_phams')
                ->where('phan_hoi_san_phams.is_delete', false)
                ->where('phan_hoi_san_phams.id_sp', $id)
                ->get();
            if($san_pham) $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view('admin.pages.sanpham.xem', compact('san_pham', 'hinh_anh_sp', 'phan_hoi_sp'))
            : redirect('quantri/loi404');
        }
        return view('admin.pages.error403');
    }

    /**
     * Hiển thị trang sửa sản phẩm.
     *
     * @param  int  $id
     * @return Trang quantri/sanpham/chinhsua/{id}
     */
    public function edit($id)
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        $status = false;
        try {
            $danh_muc_sp = DB::table('danh_muc_san_phams')
                ->where('is_delete', false)
                ->get();
            $san_pham = DB::table('san_phams')
                ->join('loai_san_phams', 'id_loai_sp', 'loai_san_phams.id')
                ->where('san_phams.is_delete', false)
                ->where('san_phams.id', $id)
                ->select(
                    'san_phams.*',
                    'loai_san_phams.ten as ten_loai',
                )
                ->first();
            $danh_muc_sp_hien_tai = DB::table('danh_muc_san_phams')
                ->join('loai_san_phams', 'id_danh_muc_sp', 'danh_muc_san_phams.id')
                ->join('san_phams', 'id_loai_sp', 'loai_san_phams.id')
                ->where('loai_san_phams.id', $san_pham->id_loai_sp)
                ->where('danh_muc_san_phams.is_delete', false)
                ->select('danh_muc_san_phams.*')
                ->first();

            $loai_sp_hien_tai = DB::table('loai_san_phams')
                ->where('id_danh_muc_sp', $danh_muc_sp_hien_tai->id)
                ->where('is_delete', false)
                ->get();

            $hinh_anh_sp = DB::table('hinh_anh_san_phams')
                ->where('hinh_anh_san_phams.is_delete', false)
                ->where('hinh_anh_san_phams.id_sp', $id)
                ->get();
            $phan_hoi_sp = DB::table('phan_hoi_san_phams')
                ->where('phan_hoi_san_phams.is_delete', false)
                ->where('phan_hoi_san_phams.id_sp', $id)
                ->orderBy('id', 'DESC')
                ->get();
            if($san_pham) $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? view('admin.pages.sanpham.chinhsua', compact('san_pham', 'hinh_anh_sp', 'danh_muc_sp', 'danh_muc_sp_hien_tai', 'loai_sp_hien_tai', 'phan_hoi_sp'))
            : redirect('quantri/loi404');
        }
        return view('admin.pages.error403');
    }

    /**
     * Chỉnh sửa sản phẩm.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        DB::beginTransaction();
        $status = false;
        try {
            DB::table('san_phams')
                ->where('id', $request->id)
                ->update([
                    'id_loai_sp' => $request->id_loai_sp,
                    'ten' => $request->ten,
                    'mo_ta' => $request->mo_ta,
                    'gia_goc' => round($request->gia_goc/1000)*1000,
                    'khuyen_mai' => $request->khuyen_mai,
                    'so_luong' => $request->so_luong,
                    'gia_ban' => round($request->gia_ban/1000)*1000,
                    'ngay_bat_dau_khuyen_mai' => date('Y-m-d', strtotime(str_replace('/', '-', $request->ngay_bat_dau_khuyen_mai))),
                    'ngay_ket_thuc_khuyen_mai' => date('Y-m-d', strtotime(str_replace('/', '-', $request->ngay_ket_thuc_khuyen_mai))),
                    'moi' => $request->moi,
                    'noi_bat' => $request->noi_bat,
                    'updated_at' => date("Y-m-d")
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
    return view('admin.pages.error403');
    }

    /**
     * [Sự kiện bắt ajax để cập nhật cột thông số cho sản phẩm trong trang thêm sản phẩm và sửa sản phẩm]
     * @param  Request $request [id, thong_so]
     * @return [boolean]           [$status]
     */
    public function updateThongSo(Request $request)
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('san_phams')
                ->where('id', $request->id)
                ->update([
                    'thong_so' => $request->thong_so,
                    'updated_at' => date("Y-m-d")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }

        return response()->json([
            'status' => $status
        ]);
    }
    return view('admin.pages.error403');
    }
    /**
     * [Sự kiện bắt ajax để cập nhật cột thông tin chi tiết cho sản phẩm trong trang thêm sản phẩm và sửa sản phẩm]
     * @param  Request $request [id, thong_tin_chi_tiet]
     * @return [boolean]           [$status]
     */
    public function updateThongTinChiTiet(Request $request)
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('san_phams')
                ->where('id', $request->id)
                ->update([
                    'thong_tin_chi_tiet' => $request->thong_tin_chi_tiet,
                    'updated_at' => date("Y-m-d")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }

        return response()->json([
            'status' => $status
        ]);
    }
    return view('admin.pages.error403');
    }

    /**
     * [Bắt ajax click vào checkbox thay đổi cột "moi" trang danh sách sản phẩm]
     * @param  Request $request [id, checked: trạng thái của checkbox]
     * @return [boolean]           [$status]
     */
    public function updateMoi(Request $request){
        if(request()->session()->get('quyen_san_pham'))
        {
        DB::beginTransaction();
        $status = false;
        try {
            $checked = filter_var((string)$request->checked, FILTER_VALIDATE_BOOLEAN)? true : false;
            $soluong = DB::table('cai_dat_san_phams')->first();
            if(count(DB::table('san_phams')->where('moi', true)->get()) <= $soluong->so_luong_moi){
                DB::table('san_phams')
                    ->where('id', $request->id)
                    ->update([
                        'moi' => $checked,
                        'updated_at' => date("Y-m-d")
                    ]);
            }
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }

        return response()->json([
            'status' => $status
        ]);
    }
    return view('admin.pages.error403');
    }

    /**
     * [Bắt ajax click vào checkbox thay đổi cột "noi_bat" trang danh sách sản phẩm]
     * @param  Request $request [id, checked: trạng thái của checkbox]
     * @return [boolean]           [$status]
     */
    public function updateNoiBat(Request $request){
        if(request()->session()->get('quyen_san_pham'))
        {
        DB::beginTransaction();
        $status = false;
        try {
            $checked = filter_var((string)$request->checked, FILTER_VALIDATE_BOOLEAN)? true : false;
            $soluong = DB::table('cai_dat_san_phams')->first();
            if(count(DB::table('san_phams')->where('noi_bat', true)->get()) <= $soluong->so_luong_noi_bat){
                DB::table('san_phams')
                    ->where('id', $request->id)
                    ->update([
                        'noi_bat' => $checked,
                        'updated_at' => date("Y-m-d")
                    ]);
            }
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }

        return response()->json([
            'status' => $status
        ]);
    }
    return view('admin.pages.error403');
    }

    /**
     * [Bắt ajax click vào checkbox thay đổi cột "ban_chay" trang danh sách sản phẩm]
     * @param  Request $request [id, checked: trạng thái của checkbox]
     * @return [boolean]           [$status]
     */
    public function updateBanChay(Request $request){
        if(request()->session()->get('quyen_san_pham'))
        {
        DB::beginTransaction();
        $status = false;
        try {
            $checked = filter_var((string)$request->checked, FILTER_VALIDATE_BOOLEAN)? true : false;
            $soluong = DB::table('cai_dat_san_phams')->first();
            if(count(DB::table('san_phams')->where('ban_chay', true)->get()) <= $soluong->so_luong_ban_chay){
                DB::table('san_phams')
                    ->where('id', $request->id)
                    ->update([
                        'ban_chay' => $checked,
                        'updated_at' => date("Y-m-d")
                    ]);
            }
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }

        return response()->json([
            'status' => $status
        ]);
    }
    return view('admin.pages.error403');
    }

    /**
     * Xóa 1 sản phẩm.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request()->session()->get('quyen_san_pham'))
        {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('san_phams')
                ->where('id', $id)
                ->update([
                    'is_delete' => true
                ]);
            DB::table('san_phams')
                ->join('hinh_anh_san_phams', 'hinh_anh_san_phams.id_sp', 'san_phams.id')
                ->where('san_phams.id', $id)
                ->update([
                    'hinh_anh_san_phams.is_delete' => true,
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
    return view('admin.pages.error403');
    }
}
