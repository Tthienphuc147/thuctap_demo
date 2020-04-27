<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;
use File;

class TinTucController extends Controller
{
    /**
     * Hiển thị danh sách tin tức
     * @return trang /quantri/tintuc/danhsach
     */
    public function index()
    {
        $status = false;
        try {
            $tin_tuc = DB::table('tin_tucs')
                ->join('loai_tin_tucs', 'id_loai_tin_tuc', 'loai_tin_tucs.id')
                ->join('admins', 'id_admin', 'admins.id')
                ->select(
                    'tin_tucs.*',
                    'loai_tin_tucs.ten as loai_ten',
                    'admins.display_name as admin_ten',
                )
                ->orderBy('tin_tucs.id', 'DESC')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.tintuc.danhsach", compact("tin_tuc"))
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
            $danh_muc_tin_tuc = DB::table('danh_muc_tin_tucs')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.tintuc.them", compact('danh_muc_tin_tuc'))
            : redirect('quantri/loi404');
    }

    /**
     * [Ajax bắt sự kiện khi combobox Danh mục tin tức thay đổi (change)]
     * @param  Request $request [params: id_danh_muc_tin_tuc]
     * @return [type]           [HTML danh sách danh mục tin tức]
     */
    public function changeDanhMuc(Request $request)
    {
        $status = false;
        try {
            $loai_tin_tuc = DB::table('loai_tin_tucs')
                ->where('id_danh_muc_tin_tuc', $request->id_danh_muc_tin_tuc)
                ->orderBy('id', 'ASC')
                ->get();
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
                $request->file->move(public_path('uploads/images/news/'), $imageName);
                DB::table('tin_tucs')
                ->insert([
                    'id_loai_tin_tuc' => $request->id_loai_tin_tuc,
                    'id_admin' => 1,
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
            ? redirect('quantri/tintuc/danhsach')->with('thongbaothemthanhcong', "a")
            : redirect('quantri/tintuc/danhsach')->with('thongbaothemthatbai', "a");
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
            $danh_muc_tin_tuc = DB::table('danh_muc_tin_tucs')->get();

            $tin_tuc = DB::table('tin_tucs')
                    ->join('loai_tin_tucs', 'id_loai_tin_tuc', 'loai_tin_tucs.id')
                    ->join('danh_muc_tin_tucs', 'id_danh_muc_tin_tuc', 'danh_muc_tin_tucs.id')
                    ->where('tin_tucs.id', $id)
                    ->select(
                        'tin_tucs.*',
                        'loai_tin_tucs.id as loai_id',
                        'loai_tin_tucs.ten as loai_ten',
                        'danh_muc_tin_tucs.id as danh_muc_id',
                        'danh_muc_tin_tucs.ten as danh_muc_ten',
                    )->first();

            $loai_tin_tuc = DB::table('loai_tin_tucs')
                ->where('id_danh_muc_tin_tuc', $tin_tuc->danh_muc_id)
                ->select([
                    'id',
                    'ten'
                ])
                ->get();
            if($tin_tuc) $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.tintuc.chinhsua", compact('danh_muc_tin_tuc', 'tin_tuc', 'loai_tin_tuc'))
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
                $anh_cu = DB::table('tin_tucs')
                    ->where('id', $id)
                    ->select('hinh_anh')
                    ->first()
                    ->hinh_anh;
                $file_path = public_path("uploads/images/news/".$anh_cu);
                if(File::exists($file_path)){
                    File::delete($file_path); 
                }
                $imageName = time().$request->file->getClientOriginalName();
                $request->file->move(public_path('uploads/images/news/'), $imageName);
                 DB::table('tin_tucs')
                    ->where('id', $id)
                    ->update([
                        'id_loai_tin_tuc' => $request->id_loai_tin_tuc,
                        'id_admin' => 1,
                        'tieu_de' => $request->tieu_de,
                        'mo_ta' => $request->mo_ta,
                        'noi_dung' => $request->noi_dung,
                        'hinh_anh' => $imageName,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            } else {
                DB::table('tin_tucs')
                    ->where('id', $id)
                    ->update([
                        'id_loai_tin_tuc' => $request->id_loai_tin_tuc,
                        'id_admin' => 1,
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
            ? redirect('quantri/tintuc/danhsach')->with('thongbaosuathanhcong', "a")
            : redirect('quantri/tintuc/danhsach')->with('thongbaosuathatbai', "a");
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
            $hinh_anh = DB::table('tin_tucs')
                    ->where('id', $id)
                    ->select('hinh_anh')
                    ->first()
                    ->hinh_anh;
            $file_path = public_path("uploads/images/news/".$hinh_anh);
            if(File::exists($file_path)){
                File::delete($file_path); 
            }
            DB::table('tin_tucs')
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
                $hinh_anh = DB::table('tin_tucs')
                    ->where('id', $arr[$i])
                    ->select('hinh_anh')
                    ->first()
                    ->hinh_anh;
                $file_path = public_path("uploads/images/news/".$hinh_anh);
                if(File::exists($file_path)){
                    File::delete($file_path); 
                }
                DB::table('tin_tucs')
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
