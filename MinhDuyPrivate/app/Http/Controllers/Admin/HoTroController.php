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
        if(request()->session()->get('quyen_ho_tro'))
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
        return view('admin.pages.error403');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyHoTro($id)
    {
        if(request()->session()->get('quyen_ho_tro'))
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
    return view('admin.pages.error403');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiDestroy(Request $request)
    {
        if(request()->session()->get('quyen_ho_tro'))
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
    return view('admin.pages.error403');
    }

    public function changeIsWatched(Request $request)
    {
        if(request()->session()->get('quyen_ho_tro'))
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
    return view('admin.pages.error403');
    }

    public function changeIsRead(Request $request)
    {
        if(request()->session()->get('quyen_ho_tro'))
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
    return view('admin.pages.error403');
    }

    public function getGiaiDapThacMac(){
        if(request()->session()->get('quyen_giai_dap_thac_mac'))
        {
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
        return view('admin.pages.error403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGiaiDapThacMac(Request $request)
    {
        if(request()->session()->get('quyen_giai_dap_thac_mac'))
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
        return view('admin.pages.error403');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editGiaiDapThacMac($id)
    {
        if(request()->session()->get('quyen_giai_dap_thac_mac'))
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
            return view('admin.pages.error403');
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
        if(request()->session()->get('quyen_giai_dap_thac_mac'))
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
                ]); }
                return view('admin.pages.error403');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyGiaiDapThacMac($id)
    {
        if(request()->session()->get('quyen_giai_dap_thac_mac'))
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
        return view('admin.pages.error403');
    }
}
