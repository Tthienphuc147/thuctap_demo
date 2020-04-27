<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Exception;

class ChiTietHoaDonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Hiển thị danh sách chi tiết hóa đơn theo id_hoa_don.
     *
     * @return dữ liệu cho modal hiển thị trong trang quantri/hoadon/danhsach
     */
    public function indexWithIDHoaDon(Request $request)
    {
        $status = false;
        $hinh_anh_sp = array();
        try {
            $chi_tiet_hoa_don = DB::table('chi_tiet_hoa_dons')
                ->join('hoa_dons', 'id_hoa_don', 'hoa_dons.id')
                ->join('san_phams', 'id_sp', 'san_phams.id')
                ->where('id_hoa_don', $request->id_hoa_don)
                ->where('chi_tiet_hoa_dons.is_delete', false)
                ->where('hoa_dons.is_delete', false)
                ->select([
                    'chi_tiet_hoa_dons.*', 
                    'hoa_dons.ma_hoa_don',
                    'hoa_dons.trang_thai',
                    'san_phams.ten as spten',
                    'san_phams.gia_ban',
                ])
                ->orderBy('chi_tiet_hoa_dons.id', 'ASC')
                ->get();
            if(count($chi_tiet_hoa_don)){
                for ($i=0; $i < count($chi_tiet_hoa_don); $i++) { 
                    $hinh_anh = DB::table('hinh_anh_san_phams')
                        ->where('hinh_anh_san_phams.is_delete', false)
                        ->where('hinh_anh_san_phams.id_sp', $chi_tiet_hoa_don[$i]->id_sp)
                        ->first();
                    if($hinh_anh){
                        $chi_tiet_hoa_don[$i]->hinh_anh = $hinh_anh->ten;
                    } else {
                        $chi_tiet_hoa_don[$i]->hinh_anh = '';
                    }
                }
            }
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        
        return $status
            ? response()->json([
                'status' => $status,
                'chi_tiet_hoa_don' => $chi_tiet_hoa_don
            ])
            : response()->json([
                'status' => $status
            ]);
    }

    /**
     * Lấy dữ liệu cho modal thêm chi tiết
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? response()->json([
                    'status' => $status,
                    'san_pham' => $san_pham
                ])
            : response()->json([
                    'status' => $status,
                ]);
    }

    /**
     * Thêm 1 chi tiết hóa đơn
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = false;
        $hinh_anh_sp = array();
        DB::beginTransaction();
        try {
            DB::table('chi_tiet_hoa_dons')
                ->insert([
                    'id_hoa_don' => $request->id_hoa_don,
                    'id_sp' => $request->id_sp,
                    'so_luong' => $request->so_luong,
                    'created_at' => date("Y-m-d")
                ]);
            DB::commit();
            $chi_tiet_hoa_don = DB::table('chi_tiet_hoa_dons')
                ->join('hoa_dons', 'id_hoa_don', 'hoa_dons.id')
                ->join('san_phams', 'id_sp', 'san_phams.id')
                ->where('id_hoa_don', $request->id_hoa_don)
                ->where('chi_tiet_hoa_dons.is_delete', false)
                ->where('hoa_dons.is_delete', false)
                ->select([
                    'chi_tiet_hoa_dons.*', 
                    'hoa_dons.ma_hoa_don',
                    'hoa_dons.trang_thai',
                    'san_phams.ten as spten',
                    'san_phams.gia_ban',
                ])
                ->orderBy('chi_tiet_hoa_dons.id', 'ASC')
                ->get();
            if(count($chi_tiet_hoa_don)){
                for ($i=0; $i < count($chi_tiet_hoa_don); $i++) { 
                    $hinh_anh = DB::table('hinh_anh_san_phams')
                        ->where('hinh_anh_san_phams.is_delete', false)
                        ->where('hinh_anh_san_phams.id_sp', $chi_tiet_hoa_don[$i]->id_sp)
                        ->first();
                    if($hinh_anh){
                        $chi_tiet_hoa_don[$i]->hinh_anh = $hinh_anh->ten;
                    } else {
                        $chi_tiet_hoa_don[$i]->hinh_anh = '';
                    }
                }
            }
            $sum = DB::table('chi_tiet_hoa_dons')
                ->join('san_phams', 'id_sp', 'san_phams.id')
                ->join('hoa_dons', 'id_hoa_don', 'hoa_dons.id')
                ->where('hoa_dons.id', $request->id_hoa_don)
                ->select([
                    DB::raw('sum(so_luong * gia_ban) as tong_thanh_tien'),
                    DB::raw('sum(so_luong) as tong_so_luong')
                ])
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        
        return $status
            ? response()->json([
                'status' => $status,
                'chi_tiet_hoa_don' => $chi_tiet_hoa_don,
                'tong' => $sum,
            ])
            : response()->json([
                'status' => $status
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }


    public function updateSoLuong(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('chi_tiet_hoa_dons')
                ->where('id', $request->id)
                ->update([
                    'so_luong' => $request->so_luong,
                    'updated_at' => date("Y-m-d")
                ]);
            DB::commit();
            $sum = DB::table('chi_tiet_hoa_dons')
                ->join('san_phams', 'id_sp', 'san_phams.id')
                ->join('hoa_dons', 'id_hoa_don', 'hoa_dons.id')
                ->where('hoa_dons.id', $request->id_hoa_don)
                ->select([
                    DB::raw('sum(so_luong * gia_ban) as tong_thanh_tien'),
                    DB::raw('sum(so_luong) as tong_so_luong')
                ])
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }
        
        return $status
            ? response()->json([
                    'status' => $status,
                    'so_luong' => $request->so_luong,
                    'tong' => $sum
                ])
            : response()->json([
            'status' => $status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_hoa_don, $id)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('chi_tiet_hoa_dons')
                ->where('id', $id)
                ->delete();
            DB::commit();
            $sum = DB::table('chi_tiet_hoa_dons')
                ->join('san_phams', 'id_sp', 'san_phams.id')
                ->join('hoa_dons', 'id_hoa_don', 'hoa_dons.id')
                ->where('hoa_dons.id', $id_hoa_don)
                ->select([
                    DB::raw('sum(so_luong * gia_ban) as tong_thanh_tien'),
                    DB::raw('sum(so_luong) as tong_so_luong')
                ])
                ->get();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return $status
            ? response()->json([
                    'status' => $status,
                    'tong' => $sum,
                ])
            : response()->json([
                    'status' => $status
                ]);
    }
}
