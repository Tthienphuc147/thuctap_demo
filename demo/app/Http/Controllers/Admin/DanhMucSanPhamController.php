<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;
class DanhMucSanPhamController extends Controller
{
    /**
     * Hiển thị danh sách danh mục sản phẩm.
     *
     * @return trang /quantri/danhmucsanpham/danhsach
     */
    public function index()
    {
        if(request()->session()->get('quyen_danh_muc_san_pham'))
        {
            $status = false;
            try {
                $danh_muc_sp = DB::table('danh_muc_san_phams')
                    ->where('is_delete', false)
                    ->orderBy('id', 'ASC')
                    ->get();
                $status = true;
            } catch (Exception $e) {
                $status = false;
            }

            return $status
                ? view("admin.pages.danhmucsanpham.danhsach", compact("danh_muc_sp"))
                : redirect('quantri/loi404');
        }
        return view('admin.pages.error403');

    }

    /**
     * Tổng danh mục sản phẩm.
     * @return response
     */
    public function sum()
    {
        if(request()->session()->get('quyen_danh_muc_san_pham'))
        {
        $status = false;
        try {
            $sum = DB::table('danh_muc_san_phams')
                ->where('is_delete', false)
                ->count();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? response()->json([
                    'status' => $status,
                    'sum' => $sum,
                ])
            : response()->json([
                    'status' => $status,
                ]);
        }
        return view('admin.pages.error403');
    }

    /**
     * [Thêm 1 danh mục sản phẩm mới.]
     * @param  Request $request [request]
     * @return [type]           [$status]
     */
    public function store(Request $request)
    {
        if(request()->session()->get('quyen_danh_muc_san_pham'))
        {
        $status = false;
        DB::beginTransaction();
        try {
            $id = DB::table('danh_muc_san_phams')
                ->insertGetId([
                    'ten' => $request->ten,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $danh_muc_san_pham = DB::table('danh_muc_san_phams')
                ->where('id', $id)
                ->first();
            if($danh_muc_san_pham) $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return response()->json([
            'status' => $status,
            'danh_muc_san_pham' => $danh_muc_san_pham
        ]);
        }
        return view('admin.pages.error403');
    }

    /**
     * Hiển thị trang sửa danh mục sản phẩm.
     *
     * @param  int  $id
     * @return Trang quantri/danhmucsanpham/chinhsua/{id}
     */
    public function edit($id)
    {
        if(request()->session()->get('quyen_danh_muc_san_pham'))
        {
        $status = false;
        try {
            $danh_muc_sp = DB::table('danh_muc_san_phams')
                ->where('id', $id)
                ->where('is_delete', false)
                ->first();
            if($danh_muc_sp) $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? response()->json([
                    'status' => $status,
                    'danh_muc_sp' => $danh_muc_sp
                ])
            : response()->json([
                    'status' => $status
                ]);
        }
        return view('admin.pages.error403');
    }

    /**
     * Chỉnh sửa danh mục sản phẩm.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(request()->session()->get('quyen_danh_muc_san_pham'))
        {
        DB::beginTransaction();
        $status = false;
        try {
            DB::table('danh_muc_san_phams')
                ->where('id', $id)
                ->update([
                    'ten' => $request->ten,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return $status
            ? response()->json([
                    'status' => $status,
                    'ten' => $request->ten
                ])
            : response()->json([
                    'status' => $status
                ]);

        }
        return view('admin.pages.error403');
    }

    /**
     * Xóa 1 danh mục sản phẩm.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request()->session()->get('quyen_danh_muc_san_pham'))
        {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('danh_muc_san_phams')
                ->where('danh_muc_san_phams.id', $id)
                ->update([
                    'danh_muc_san_phams.is_delete' => true,
                ]);
            DB::table('danh_muc_san_phams')
                ->join('loai_san_phams', 'loai_san_phams.id_danh_muc_sp', 'danh_muc_san_phams.id')
                ->where('danh_muc_san_phams.id', $id)
                ->update([
                    'loai_san_phams.is_delete' => true,
                ]);
            DB::table('danh_muc_san_phams')
                ->join('loai_san_phams', 'loai_san_phams.id_danh_muc_sp', 'danh_muc_san_phams.id')
                ->join('san_phams', 'san_phams.id_loai_sp', 'loai_san_phams.id')
                ->where('danh_muc_san_phams.id', $id)
                ->update([
                    'san_phams.is_delete' => true,
                ]);
            DB::table('danh_muc_san_phams')
                ->join('loai_san_phams', 'loai_san_phams.id_danh_muc_sp', 'danh_muc_san_phams.id')
                ->join('san_phams', 'san_phams.id_loai_sp', 'loai_san_phams.id')
                ->join('hinh_anh_san_phams', 'hinh_anh_san_phams.id_sp', 'san_phams.id')
                ->where('danh_muc_san_phams.id', $id)
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
