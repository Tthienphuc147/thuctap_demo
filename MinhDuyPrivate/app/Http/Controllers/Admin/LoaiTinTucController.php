<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Exception;

class LoaiTinTucController extends Controller
{
    /**
     * Hiển thị danh sách loại tin tức
     *
     * @return trang /quantri/loaitintuc/danhsach
     */
    public function index()
    {
        $status = false;
        try {
            $loai_tin_tuc = DB::table('loai_tin_tucs')
                ->join('danh_muc_tin_tucs', 'id_danh_muc_tin_tuc', 'danh_muc_tin_tucs.id')
                ->select(
                    'loai_tin_tucs.*', 
                    'danh_muc_tin_tucs.ten as ten_danh_muc'
                )
                ->orderBy('loai_tin_tucs.id', 'ASC')
                ->get();
            $danh_muc_tin_tuc = DB::table('danh_muc_tin_tucs')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.loaitintuc.danhsach", compact('loai_tin_tuc', 'danh_muc_tin_tuc'))
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
            $id = DB::table('loai_tin_tucs')
                ->insertGetId([
                    'ten' => $request->ten,
                    'id_danh_muc_tin_tuc' => $request->id_danh_muc_tin_tuc,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $loai_tin_tuc = DB::table('loai_tin_tucs')
                ->join('danh_muc_tin_tucs', 'id_danh_muc_tin_tuc', 'danh_muc_tin_tucs.id')
                ->select([
                    'loai_tin_tucs.*', 
                    'danh_muc_tin_tucs.ten as ten_danh_muc'
                ])
                ->where('loai_tin_tucs.id', $id)
                ->first();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? response()->json([
                    'status' => $status,
                    'loai_tin_tuc' => $loai_tin_tuc
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
            $danh_muc_tin_tuc = DB::table('danh_muc_tin_tucs')
                ->get();
            $loai_tin_tuc = DB::table('loai_tin_tucs')
                ->where('id', $id)
                ->first();
            if($loai_tin_tuc) $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? response()->json([
                    'status' => $status,
                    'danh_muc_tin_tuc' => $danh_muc_tin_tuc,
                    'loai_tin_tuc' => $loai_tin_tuc
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
            DB::table('loai_tin_tucs')
                ->where('id', $id)
                ->update([
                    'id_danh_muc_tin_tuc' => $request->id_danh_muc_tin_tuc,
                    'ten' => $request->ten,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            $danh_muc_tin_tuc = DB::table('danh_muc_tin_tucs')
                ->where('id', $request->id_danh_muc_tin_tuc)
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
                    'ten_danh_muc' => $danh_muc_tin_tuc->ten
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
            DB::table('loai_tin_tucs')
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
