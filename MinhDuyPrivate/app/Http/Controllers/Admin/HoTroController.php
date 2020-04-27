<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;

class HoTroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDanhSachHoTro()
    {
        $status = false;
        try {
            // DB::table('ho_tros')
            //     ->update([
            //         'is_read' => true,
            //         'is_watched' => true,
            //         'updated_at' => date("Y-m-d H:i:s")
            //     ]);
            $ho_tro = DB::table('ho_tros')
                ->orderBy('id', 'DESC')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        
        return $status
            ? view("admin.pages.chamsockhachhang.danhsachhotro", compact("ho_tro"))
            : redirect('quantri/loi404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyHoTro($id)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('ho_tros')
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
                DB::table('ho_tros')
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

    public function changeIsWatched(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('ho_tros')
                ->update([
                    'is_watched' => true
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

    public function changeIsRead(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('ho_tros')
                ->update([
                    'is_read' => true,
                    'is_watched' => true,
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

    public function getGiaiDapThacMac(){ 
        $status = false;
        try {
            $giai_dap = DB::table('giai_dap_thac_macs')
                ->orderBy('id', 'DESC')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        
        return $status
            ? view("admin.pages.chamsockhachhang.giaidapthacmac", compact("giai_dap"))
            : redirect('quantri/loi404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGiaiDapThacMac(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            $id = DB::table('giai_dap_thac_macs')
                ->insertGetId([
                    'cau_hoi' => $request->cau_hoi,
                    'tra_loi' => $request->tra_loi,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            DB::commit();
            $giai_dap_thac_mac = DB::table('giai_dap_thac_macs')
                ->where('id', $id)
                ->first();
            if($giai_dap_thac_mac) $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return $status
            ? response()->json([
                'status' => $status,
                'giai_dap_thac_mac' => $giai_dap_thac_mac
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
    public function editGiaiDapThacMac($id)
    {
        $status = false;
        try {
            $giai_dap_thac_mac = DB::table('giai_dap_thac_macs')
                ->where('id', $id)
                ->first();
            if($giai_dap_thac_mac) $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? response()->json([
                    'status' => $status,
                    'giai_dap_thac_mac' => $giai_dap_thac_mac
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
    public function updateGiaiDapThacMac(Request $request, $id)
    {
        DB::beginTransaction();
        $status = false;
        try {
            DB::table('giai_dap_thac_macs')
                ->where('id', $id)
                ->update([
                    'cau_hoi' => $request->cau_hoi,
                    'tra_loi' => $request->tra_loi,
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
                    'cau_hoi' => $request->cau_hoi,
                    'tra_loi' => $request->tra_loi
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
    public function destroyGiaiDapThacMac($id)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('giai_dap_thac_macs')
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
