<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;
use File;

class HinhAnhSanPhamController extends Controller
{
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
            if ($request->images) {
                $countHinhChinh = DB::table('hinh_anh_san_phams')
                    ->where('id_sp', $request->id)
                    ->where('hinh_chinh', true)
                    ->count();
                
                foreach ($request->images as $img) {
                    $imageName = time().$img->getClientOriginalName();
                    $img->move(public_path('uploads/images/products/'), $imageName);
                    if($countHinhChinh == 1){
                        $status = DB::table('hinh_anh_san_phams')
                            ->insert([
                                'id_sp' => $request->id,
                                'ten' => $imageName,
                                'hinh_chinh'=>false,
                                'created_at' => date("Y-m-d")
                            ]);
                    } else {
                        $status = DB::table('hinh_anh_san_phams')
                            ->insert([
                                'id_sp' => $request->id,
                                'ten' => $imageName,
                                'hinh_chinh'=>true,
                                'created_at' => date("Y-m-d")
                            ]);
                    }
                    
                }
            }

            DB::commit();
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }
        // $status = true;
        $hinh_anh = DB::table('hinh_anh_san_phams')
                ->where('id_sp', $request->id)
                ->get();

        return response()->json([
            'status' => $status,
            'hinh_anh' => $hinh_anh,
        ]);    
    }

    public function changeHinhChinh(Request $request)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('hinh_anh_san_phams')
                ->where('id_sp', $request->id_sp)
                ->update([
                    'hinh_chinh'=> false
                ]);
            DB::table('hinh_anh_san_phams')
                ->where('id', $request->id)
                ->update([
                    'hinh_chinh'=> true
                ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }
        return response()->json([
            'status' => $status,
            'id' => $request->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_sp, $id)
    {
        $status = false;
        DB::beginTransaction();
        try {
            $ha = DB::table('hinh_anh_san_phams')
                    ->where('id', $id)
                    ->select('ten')
                    ->first()
                    ->ten;
            $file_path = public_path("uploads/images/products/".$ha);
            if(File::exists($file_path)){
                File::delete($file_path); 
            }
            $status = DB::table('hinh_anh_san_phams')
                ->where('id', $id)
                ->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }        
        $hinh_anh = DB::table('hinh_anh_san_phams')
            ->where('id_sp', $id_sp)
            ->get();
        return response()->json([
            'status' => $status,
            'id_sp' => $id_sp,
            'hinh_anh' => $hinh_anh
        ]);
    }
}