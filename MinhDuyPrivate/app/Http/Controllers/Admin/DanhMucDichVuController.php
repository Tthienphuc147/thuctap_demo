<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;

class DanhMucDichVuController extends Controller
{
    /**
     * Hiển thị danh sách danh mục dịch vụ.
     * @return trang /quantri/danhmucdichvu/danhsach
     */
    public function index()
    {
        $status = false;
        try {
            $danh_muc_dich_vu = DB::table('danh_muc_dich_vus')
                ->orderBy('id', 'ASC')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        
        return $status
            ? view("admin.pages.danhmucdichvu.danhsach", compact("danh_muc_dich_vu"))
            : redirect('quantri/loi404');
    }

    /**
     * Tổng danh mục dịch vụ.
     * @return response
     */
    public function sum()
    {
        $status = false;
        try {
            $sum = DB::table('danh_muc_dich_vus')->count();
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
                    'status' => $status
                ]);
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
            $id = DB::table('danh_muc_dich_vus')
                ->insertGetId([
                    'ten' => $request->ten,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $danh_muc_dich_vu = DB::table('danh_muc_dich_vus')
                ->where('id', $id)
                ->first();
            if($danh_muc_dich_vu) $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return $status
            ? response()->json([
                'status' => $status,
                'danh_muc_dich_vu' => $danh_muc_dich_vu
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
                ->where('id', $id)
                ->first();
            if($danh_muc_dich_vu) $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? response()->json([
                    'status' => $status,
                    'danh_muc_dich_vu' => $danh_muc_dich_vu
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
            DB::table('danh_muc_dich_vus')
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
            DB::table('danh_muc_dich_vus')
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
