<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Exception;

class HoaDonController extends Controller
{
    /**
     * Hiển thị danh sách hóa đơn.
     *
     * @return trang /quantri/hoadon/danhsach
     */
    public function index()
    {
        $status = false;
        try {
            $hoa_don = DB::table('hoa_dons')
                ->join('provinces', 'hoa_dons.province_id', 'provinces.province_id')
                ->join('districts', 'hoa_dons.district_id', 'districts.district_id')
                ->join('wards', 'hoa_dons.ward_id', 'wards.ward_id')
                ->select([
                    'hoa_dons.*',
                    'provinces.name as provinces_name',
                    'provinces.type as provinces_type',
                    'districts.name as districts_name',
                    'districts.type as districts_type',
                    'wards.name as wards_name',
                    'wards.type as wards_type',
                ])
                ->where('hoa_dons.is_delete', false)
                ->orderBy('id', 'DESC')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? view("admin.pages.hoadon.danhsach", compact("hoa_don"))
            : redirect('quantri/loi404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProvince($province_id)
    {
        $status = false;
        try {
            $districts = DB::table('districts')
                ->where('province_id', $province_id)
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? response()->json([
                    'status' => $status,
                    'districts' => $districts
                ])
            : response()->json([
                    'status' => $status
                ]);

    }

    public function changeDistrict($district_id)
    {
        $status = false;
        try {
            $wards = DB::table('wards')
                ->where('district_id', $district_id)
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? response()->json([
                    'status' => $status,
                    'wards' => $wards
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
        $status = false;
        try {
            $hoa_don = DB::table('hoa_dons')
                ->where('id', $id)
                ->where('is_delete', false)
                ->first();
            $provinces = DB::table('provinces')
                ->get();
            $districts = DB:: table('districts')
                ->where('province_id', $hoa_don->province_id)
                ->get();
            $wards = DB:: table('wards')
                ->where('district_id', $hoa_don->district_id)
                ->get();
            if($hoa_don) $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        
        return $status
            ? response()->json([
                    'status' => $status,
                    'hoa_don' => $hoa_don,
                    'provinces' => $provinces,
                    'districts' => $districts,
                    'wards' => $wards,
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
    public function update(Request $request)
    {
        DB::beginTransaction();
        $status = false;
        try {
            DB::table('hoa_dons')
                ->where('id', $request->id)
                ->update([
                    'ten_khach_hang' => $request->ten_khach_hang,
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'email' => $request->email,
                    'province_id' => $request->province_id, 
                    'district_id' => $request->district_id, 
                    'ward_id' => $request->ward_id,
                    'dia_chi' => $request->dia_chi,
                    'ghi_chu' => is_null($request->ghi_chu) ? '' : $request->ghi_chu,
                    'phi_ship' => round($request->phi_ship /1000) * 1000,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $hoa_don = DB::table('hoa_dons')
                ->join('provinces', 'hoa_dons.province_id', 'provinces.province_id')
                ->join('districts', 'hoa_dons.district_id', 'districts.district_id')
                ->join('wards', 'hoa_dons.ward_id', 'wards.ward_id')
                ->where('hoa_dons.id', $request->id)
                ->select([
                    'hoa_dons.*',
                    'provinces.name as provinces_name',
                    'provinces.type as provinces_type',
                    'districts.name as districts_name',
                    'districts.type as districts_type',
                    'wards.name as wards_name',
                    'wards.type as wards_type',
                ])
                ->where('hoa_dons.is_delete', false)
                ->first();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return $status
            ? response()->json([
                    'status' => $status,
                    'hoa_don' => $hoa_don
                ])
            : response()->json([
                    'status' => $status
                ]);
    }

    public function updatePhiShip(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('hoa_dons')
                ->where('id', $request->id)
                ->update([
                    'trang_thai' => 2,
                    'phi_ship' => $request->phi_ship,
                    'updated_at' => date("Y-m-d")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }
        
        return response()->json([
            'status' => $status,
        ]);
    }

    public function updateTrangThaiDenDatHang(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('hoa_dons')
                ->where('id', $request->id)
                ->update([
                    'trang_thai' => 1,
                    'phi_ship' => 0,
                    'updated_at' => date("Y-m-d")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }
        
        return response()->json([
            'status' => $status,
        ]);
    }

    public function updateTrangThaiDenDaThanhToan(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('hoa_dons')
                ->where('id', $request->id)
                ->update([
                    'trang_thai' => 3,
                    'updated_at' => date("Y-m-d")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }
        
        return response()->json([
            'status' => $status,
        ]);
    }

    public function updateTrangThaiDenHuyDonHang(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('hoa_dons')
                ->where('id', $request->id)
                ->update([
                    'trang_thai' => 4,
                    'updated_at' => date("Y-m-d")
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }
        
        return response()->json([
            'status' => $status,
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
            DB::table('chi_tiet_hoa_dons')
                ->where('id_hoa_don', $id)
                ->delete();
            DB::table('hoa_dons')
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiDestroy(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            $arr = $request->arrID;
            for ($i = 0; $i < count($arr); $i++) { 
                DB::table('chi_tiet_hoa_dons')
                ->where('id_hoa_don', $arr[$i])
                ->delete();
            DB::table('hoa_dons')
                ->where('id', $arr[$i])
                ->delete();
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
