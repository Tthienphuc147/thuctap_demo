<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;
class LoaiSanPhamController extends Controller
{
    /**
     * Hiển thị danh sách loại sản phẩm.
     *
     * @return trang /quantri/loaisanpham/danhsach
     */
    public function index()
    {
        $status = false;
        try {
            $loai_sp = DB::table('loai_san_phams')
                ->join('danh_muc_san_phams', 'id_danh_muc_sp', 'danh_muc_san_phams.id')
                ->where('loai_san_phams.is_delete', false)
                ->select(
                    'loai_san_phams.*', 
                    'danh_muc_san_phams.ten as ten_danh_muc'
                )
                ->orderBy('loai_san_phams.id', 'ASC')
                ->get();
            $danh_muc_sp = DB::table('danh_muc_san_phams')
                ->where('is_delete', false)
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.loaisanpham.danhsach", compact("loai_sp", 'danh_muc_sp'))
            : redirect('quantri/loi404');
    }

    /**
     * Thêm 1 loại sản phẩm mới.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            $id = DB::table('loai_san_phams')
                ->insertGetId([
                    'ten' => $request->ten,
                    'id_danh_muc_sp' => $request->id_danh_muc_sp,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $loai_san_pham = DB::table('loai_san_phams')
                ->join('danh_muc_san_phams', 'id_danh_muc_sp', 'danh_muc_san_phams.id')
                ->where('loai_san_phams.is_delete', false)
                ->select([
                    'loai_san_phams.*', 
                    'danh_muc_san_phams.ten as ten_danh_muc'
                ])
                ->where('loai_san_phams.id', $id)
                ->first();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? response()->json([
                    'status' => $status,
                    'loai_san_pham' => $loai_san_pham
                ])
            : response()->json([
                    'status' => $status
                ]);
    }

    /**
     * Hiển thị trang sửa loại sản phẩm
     *
     * @param  int  $id
     * @return Trang quantri/loaisanpham/chinhsua/{id}
     */
    public function edit($id)
    {
        $status = false;
        try {
            $danh_muc_san_pham = DB::table('danh_muc_san_phams')
                ->where('is_delete', false)
                ->get();
            $loai_san_pham = DB::table('loai_san_phams')
                ->where('id', $id)
                ->where('is_delete', false)
                ->first();
            if($loai_san_pham) $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? response()->json([
                    'status' => $status,
                    'danh_muc_san_pham' => $danh_muc_san_pham,
                    'loai_san_pham' => $loai_san_pham
                ])
            : response()->json([
                    'status' => $status
                ]);
    }

    /**
     * Chỉnh sửa loại sản phẩm.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $status = false;
        try {
            DB::table('loai_san_phams')
                ->where('id', $id)
                ->update([
                    'id_danh_muc_sp' => $request->id_danh_muc_sp,
                    'ten' => $request->ten,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            $danh_muc_san_pham = DB::table('danh_muc_san_phams')
                ->where('id', $request->id_danh_muc_sp)
                ->first();
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        
        return $status
            ? response()->json([
                    'status' => $status,
                    'ten' => $request->ten,
                    'ten_danh_muc' => $danh_muc_san_pham->ten
                ])
            : response()->json([
                    'status' => $status
                ]);
    }

    /**
     * Xóa 1 loại sản phẩm => xóa sản phẩm + hình ảnh của loại đó.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = false;
        DB::beginTransaction();

        try {
            DB::table('loai_san_phams')
                ->where('loai_san_phams.id', $id)
                ->update([
                    'loai_san_phams.is_delete' => true,
                ]);
            DB::table('loai_san_phams')
                ->join('san_phams', 'san_phams.id_loai_sp', 'loai_san_phams.id')
                ->where('loai_san_phams.id', $id)
                ->update([
                    'san_phams.is_delete' => true,
                ]);
            DB::table('loai_san_phams')
                ->join('san_phams', 'san_phams.id_loai_sp', 'loai_san_phams.id')
                ->join('hinh_anh_san_phams', 'hinh_anh_san_phams.id_sp', 'san_phams.id')
                ->where('loai_san_phams.id', $id)
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
}
