<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Exception;
use File;

class DichVuController extends Controller
{
    /**
     * Hiển thị danh sách dịch vụ
     * @return trang /quantri/dichvu/danhsach
     */
    public function index()
    {
        $status = false;
        try {
            $dich_vu = DB::table('dich_vus')
                ->join('loai_dich_vus', 'id_loai_dich_vu', 'loai_dich_vus.id')
                ->select(
                    'dich_vus.*',
                    'loai_dich_vus.ten as loai_ten',
                )
                ->orderBy('dich_vus.id', 'DESC')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.dichvu.danhsach", compact("dich_vu"))
            : redirect('quantri/loi404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = false;
        try {
            $danh_muc_dich_vu = DB::table('danh_muc_dich_vus')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.dichvu.them", compact('danh_muc_dich_vu'))
            : redirect('quantri/loi404');
    }

    /**
     * [Ajax bắt sự kiện khi combobox Danh mục dịch vụ thay đổi (change)]
     * @param  Request $request [params: id_danh_muc_dich_vu]
     * @return [type]           [HTML danh sách danh mục dịch vụ]
     */
    public function changeDanhMuc(Request $request)
    {
        $status = false;
        try {
            $loai_dich_vu = DB::table('loai_dich_vus')
                ->where('id_danh_muc_dich_vu', $request->id_danh_muc_dich_vu)
                ->orderBy('id', 'ASC')
                ->get();
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
            if ($request->hasFile('file')) {
                $imageName = time().$request->file->getClientOriginalName();
                $request->file->move(public_path('uploads/images/services/'), $imageName);
                DB::table('dich_vus')
                ->insert([
                    'id_loai_dich_vu' => $request->id_loai_dich_vu,
                    'tieu_de' => $request->tieu_de,
                    'mo_ta' => $request->mo_ta,
                    'noi_dung' => $request->noi_dung,
                    'hinh_anh' => $imageName,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                DB::commit();
                $status = true;
            } else {
                $status = false;
            }
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        
        return $status
            ? redirect('quantri/dichvu/danhsach')->with('thongbaothemthanhcong', "a")
            : redirect('quantri/dichvu/danhsach')->with('thongbaothemthatbai', "a");
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
            $danh_muc_dich_vu = DB::table('danh_muc_dich_vus')->get();

            $dich_vu = DB::table('dich_vus')
                    ->join('loai_dich_vus', 'id_loai_dich_vu', 'loai_dich_vus.id')
                    ->join('danh_muc_dich_vus', 'id_danh_muc_dich_vu', 'danh_muc_dich_vus.id')
                    ->where('dich_vus.id', $id)
                    ->select(
                        'dich_vus.*',
                        'loai_dich_vus.id as loai_id',
                        'loai_dich_vus.ten as loai_ten',
                        'danh_muc_dich_vus.id as danh_muc_id',
                        'danh_muc_dich_vus.ten as danh_muc_ten',
                    )->first();

            $loai_dich_vu = DB::table('loai_dich_vus')
                ->where('id_danh_muc_dich_vu', $dich_vu->danh_muc_id)
                ->select([
                    'id',
                    'ten'
                ])
                ->get();
            if($dich_vu) $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.dichvu.chinhsua", compact('danh_muc_dich_vu', 'dich_vu', 'loai_dich_vu'))
            : redirect('quantri/loi404');
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
        $status = false;
        DB::beginTransaction();
        try {
            if($request->hasFile('file')){
                $anh_cu = DB::table('dich_vus')
                    ->where('id', $id)
                    ->select('hinh_anh')
                    ->first()
                    ->hinh_anh;
                $file_path = public_path("uploads/images/services/".$anh_cu);
                if(File::exists($file_path)){
                    File::delete($file_path); 
                }
                $imageName = time().$request->file->getClientOriginalName();
                $request->file->move(public_path('uploads/images/services/'), $imageName);
                 DB::table('dich_vus')
                    ->where('id', $id)
                    ->update([
                        'id_loai_dich_vu' => $request->id_loai_dich_vu,
                        'tieu_de' => $request->tieu_de,
                        'mo_ta' => $request->mo_ta,
                        'noi_dung' => $request->noi_dung,
                        'hinh_anh' => $imageName,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            } else {
                DB::table('dich_vus')
                    ->where('id', $id)
                    ->update([
                        'id_loai_dich_vu' => $request->id_loai_dich_vu,
                        'tieu_de' => $request->tieu_de,
                        'mo_ta' => $request->mo_ta,
                        'noi_dung' => $request->noi_dung,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            }
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }
        
        return $status
            ? redirect('quantri/dichvu/danhsach')->with('thongbaosuathanhcong', "a")
            : redirect('quantri/dichvu/danhsach')->with('thongbaosuathatbai', "a");
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
            $hinh_anh = DB::table('dich_vus')
                    ->where('id', $id)
                    ->select('hinh_anh')
                    ->first()
                    ->hinh_anh;
            $file_path = public_path("uploads/images/services/".$hinh_anh);
            if(File::exists($file_path)){
                File::delete($file_path); 
            }
            DB::table('dich_vus')
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
                $hinh_anh = DB::table('dich_vus')
                    ->where('id', $arr[$i])
                    ->select('hinh_anh')
                    ->first()
                    ->hinh_anh;
                $file_path = public_path("uploads/images/services/".$hinh_anh);
                if(File::exists($file_path)){
                    File::delete($file_path); 
                }
                DB::table('dich_vus')
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
