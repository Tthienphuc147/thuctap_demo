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
        if(request()->session()->get('quyen_danh_muc_dich_vu'))
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
        return view('admin.pages.error403');
    }

    /**
     * Tổng danh mục dịch vụ.
     * @return response
     */
    public function sum()
    {
        if(request()->session()->get('quyen_danh_muc_dich_vu'))
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
            return view('admin.pages.error403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request()->session()->get('quyen_danh_muc_dich_vu'))
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
        return view('admin.pages.error403');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->session()->get('quyen_danh_muc_dich_vu'))
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
            return view('admin.pages.error403');
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
        if(request()->session()->get('quyen_danh_muc_dich_vu'))
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
            return view('admin.pages.error403');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request()->session()->get('quyen_danh_muc_dich_vu'))
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
    return view('admin.pages.error403');
    }
}
