<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Exception;

class LoaiDichVuController extends Controller
{
    /**
     * Hiển thị danh sách loại dịch vụ
     *
     * @return trang /quantri/loaidichvu/danhsach
     */
    public function index()
    {
        $status = false;
        try {
            $loai_dich_vu = DB::table('loai_dich_vus')
                ->join('danh_muc_dich_vus', 'id_danh_muc_dich_vu', 'danh_muc_dich_vus.id')
                ->select(
                    'loai_dich_vus.*', 
                    'danh_muc_dich_vus.ten as ten_danh_muc'
                )
                ->orderBy('loai_dich_vus.id', 'ASC')
                ->get();
            $danh_muc_dich_vu = DB::table('danh_muc_dich_vus')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.loaidichvu.danhsach", compact('loai_dich_vu', 'danh_muc_dich_vu'))
            : redirect('quantri/loi404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            $id = DB::table('loai_dich_vus')
                ->insertGetId([
                    'ten' => $request->ten,
                    'id_danh_muc_dich_vu' => $request->id_danh_muc_dich_vu,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $loai_dich_vu = DB::table('loai_dich_vus')
                ->join('danh_muc_dich_vus', 'id_danh_muc_dich_vu', 'danh_muc_dich_vus.id')
                ->select([
                    'loai_dich_vus.*', 
                    'danh_muc_dich_vus.ten as ten_danh_muc'
                ])
                ->where('loai_dich_vus.id', $id)
                ->first();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? response()->json([
                    'status' => $status,
                    'loai_dich_vu' => $loai_dich_vu
                ])
            : response()->json([
                    'status' => $status
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = false;
        try {
            $danh_muc_dich_vu = DB::table('danh_muc_dich_vus')
                ->get();
            $loai_dich_vu = DB::table('loai_dich_vus')
                ->where('id', $id)
                ->first();
            if($loai_dich_vu) $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? response()->json([
                    'status' => $status,
                    'danh_muc_dich_vu' => $danh_muc_dich_vu,
                    'loai_dich_vu' => $loai_dich_vu
                ])
            : response()->json([
                    'status' => $status
                ]);
    }

    /**
     * Update the specified resource in storage.
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
            DB::table('loai_dich_vus')
                ->where('id', $id)
                ->update([
                    'id_danh_muc_dich_vu' => $request->id_danh_muc_dich_vu,
                    'ten' => $request->ten,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            $danh_muc_dich_vu = DB::table('danh_muc_dich_vus')
                ->where('id', $request->id_danh_muc_dich_vu)
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
                    'ten_danh_muc' => $danh_muc_dich_vu->ten
                ])
            : response()->json([
                    'status' => $status
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('loai_dich_vus')
                ->where('id', $id)
                ->delete();
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
