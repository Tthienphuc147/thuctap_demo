<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Exception;

class PhanHoiSanPhamController extends Controller
{
    /**
     * Hiển thị danh sách phản hồi sản phẩm.
     *
     * @return trang /quantri/phanhoisanpham/danhsach
     */
    public function index()
    {

        $status = false;
        try {
            $loai_sp = DB::table('danh_muc_san_phams')
                ->join('loai_san_phams', 'id_danh_muc_sp', 'danh_muc_san_phams.id')
                ->join('san_phams', 'id_loai_sp', 'loai_san_phams.id')
                ->join('phan_hoi_san_phams', 'id_sp', 'san_phams.id')
                ->where('phan_hoi_san_phams.is_delete', false)
                ->where('san_phams.is_delete', false)
                ->select(
                    'danh_muc_san_phams.id as danhmucid',
                    'loai_san_phams.id as loaiid',
                    'loai_san_phams.ten as loaiten', 
                    'danh_muc_san_phams.ten as danhmucten' 
                )
                ->distinct()
                ->orderBy('loai_san_phams.id', 'ASC')
                ->get();
            if($loai_sp->isNotEmpty()){
                 $phan_hoi_sp = DB::table('loai_san_phams')
                    ->join('san_phams', 'id_loai_sp', 'loai_san_phams.id')
                    ->join('phan_hoi_san_phams', 'id_sp', 'san_phams.id')
                    ->where('phan_hoi_san_phams.is_delete', false)
                    ->where('san_phams.is_delete', false)
                    ->where('loai_san_phams.id', $loai_sp[0]->loaiid)
                    ->select(
                        'loai_san_phams.id as loaiid', 
                        'san_phams.id as spid', 
                        'phan_hoi_san_phams.id as phanhoiid', 
                        'loai_san_phams.ten as loaiten', 
                        'san_phams.ten as spten',
                        'phan_hoi_san_phams.ten_hien_thi', 
                        'phan_hoi_san_phams.email',
                        'phan_hoi_san_phams.noi_dung',
                        'phan_hoi_san_phams.duyet',
                    )
                    ->orderBy('loai_san_phams.id', 'ASC')
                    ->orderBy('san_phams.id', 'ASC')
                    ->orderBy('phan_hoi_san_phams.id', 'ASC')
                    ->get();
            }
           
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        // return dd($loai_sp);
        return $status
            ? view("admin.pages.phanhoisanpham.danhsach", compact("phan_hoi_sp", 'loai_sp'))
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
    public function show($id)
    {
        //
    }
    
    /**
     * Xem danh sách phản hồi theo id sản phẩm
     *
     * @param  int  $id
     * @return trang quantri/phanhoisanpham/{idsp}
     */
    public function showTheoSanPham($idsp)
    {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('phan_hoi_san_phams')
                ->where('id_sp', $idsp)
                ->update([
                    'doc' => true,
                    'updated_at' => date("Y-m-d")
                ]);
            DB::commit();
            $san_pham = DB::table('san_phams')
                ->join('loai_san_phams', 'id_loai_sp', 'loai_san_phams.id')
                ->where('san_phams.is_delete', false)
                ->where('san_phams.id', $idsp)
                ->select(
                    'san_phams.*',
                    'loai_san_phams.ten as ten_loai',
                )
                ->first();
            $hinh_anh_sp = DB::table('hinh_anh_san_phams')
                    ->where('hinh_anh_san_phams.is_delete', false)
                    ->where('hinh_anh_san_phams.id_sp', $idsp)
                    ->get();
            $phan_hoi_sp = DB::table('phan_hoi_san_phams')
                ->where('phan_hoi_san_phams.is_delete', false)
                ->where('phan_hoi_san_phams.id_sp', $idsp)
                ->orderBy('id', 'DESC')
                ->get();
            if($san_pham) $status = true;

        } catch (Exception $e) {
            $status = false;
            DB::rollback();
        }        
        return $status 
            ? view('admin.pages.phanhoisanpham.xem', compact('san_pham', 'phan_hoi_sp', 'hinh_anh_sp'))
            : redirect('quantri/loi404');
    }

    /**
     * Bắt sự kiện ajax thay đổi danh sách phản hồi khi click vào loại sản phẩm trang 
     * quantri/phanhoisanpham/danhsach
     *
     * @param  int  $idloai
     * @return \Illuminate\Http\Response
     */
    public function changePhanHoi(Request $request)
    {
        $status = false;
        try {
            $phan_hoi_sp = DB::table('loai_san_phams')
                ->join('san_phams', 'id_loai_sp', 'loai_san_phams.id')
                ->join('phan_hoi_san_phams', 'id_sp', 'san_phams.id')
                ->where('phan_hoi_san_phams.is_delete', false)
                ->where('san_phams.is_delete', false)
                ->where('loai_san_phams.id', $request->loaiid)
                ->select(
                    'loai_san_phams.id as loaiid', 
                    'san_phams.id as spid', 
                    'phan_hoi_san_phams.id as phanhoiid', 
                    'loai_san_phams.ten as loaiten', 
                    'san_phams.ten as spten',
                    'phan_hoi_san_phams.ten_hien_thi', 
                    'phan_hoi_san_phams.email',
                    'phan_hoi_san_phams.noi_dung',
                    'phan_hoi_san_phams.duyet'
                )
                ->orderBy('loai_san_phams.id', 'ASC')
                ->orderBy('san_phams.id', 'ASC')
                ->orderBy('phan_hoi_san_phams.id', 'ASC')
                ->get();
           
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status
            ? response()->json([
                'status' => $status,
                'phan_hoi_sp' => $phan_hoi_sp
            ])
            : response()->json([
                'status' => $status
            ]);
    }


    /**
     * [updateDuyet thay đổi trạng thái "duyệt" trang chỉnh sửa sản phẩm]
     * @param  Request $request [id, trangthaiduyet]
     * @return [type]           [description]
     */
    function updateDuyet(Request $request){
        $status = false;
        $duyet = filter_var((string)$request->duyet, FILTER_VALIDATE_BOOLEAN)? true : false;
        DB::beginTransaction(); 
        try {
            DB::table('phan_hoi_san_phams')
                ->where('id', $request->id)
                ->update([
                    'duyet' => !$duyet,
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
            'duyet' => !$duyet
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
            DB::table('phan_hoi_san_phams')
                ->where('id', $id)
                ->delete();
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }        
        return response()->json([
            'status' => $status,
        ]);
    }
}
