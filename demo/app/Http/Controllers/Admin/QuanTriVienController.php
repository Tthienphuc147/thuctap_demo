<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Exception;

class QuanTriVienController extends Controller
{
    /**
     * Hiển thị danh sách quản trị viên.
     *
     * @return trang /quantri/quantrivien/danhsach
     */
    public function index()
    {
        if(request()->session()->get('quyen_quan_tri_vien'))
        {
        $status = false;
        try {
            $quan_tri_vien = DB::table('admins')
                ->join('phan_quyens','phan_quyens.id_admin','=','admins.id')
                ->orderBy('admins.id', 'ASC')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.quantrivien.danhsach", compact("quan_tri_vien"))
            : redirect('quantri/loi404');
        }
        return view('admin.pages.error403');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->session()->get('quyen_quan_tri_vien'))
        {
        return view("admin.pages.quantrivien.them");
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
        if(request()->session()->get('quyen_quan_tri_vien'))
        {
        $check_user = DB::table('admins')
        ->where('email','=',$request->mail_tai_khoan)
        ->orWhere('name','=',$request->ten_tai_khoan)
        ->first();
        if($check_user != null){
            return "exist";
        }
        $user = DB::table('admins')->insert(
            [
                'display_name' => $request->display_name,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'nv',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        );
        $admin = DB::table('admins')->orderBy('created_at', 'DESC')->get();
        $phan_quyen = DB::table('phan_quyens')->insert(
            [
                'id_admin' => $admin[0]->id
            ]
        );
        return $user ? 'true' : 'false';
    }
    return view('admin.pages.error403');
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
        if(request()->session()->get('quyen_quan_tri_vien'))
        {
        $status = false;
         try {
             $admins = DB::table('admins')->find($id);
             if($admins) $status = true;
         } catch (Exception $e) {
             $status = false;
         }
         return $status
             ? view("admin.pages.quantrivien.chinhsua", compact('admins'))
             : redirect('quantri/loi404');
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
        if(request()->session()->get('quyen_quan_tri_vien'))
        {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('admins')
            ->where('id', $id)
            ->update([
                    'display_name' => $request->display_name,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' =>  bcrypt($request->password),
                    'updated_at' => date("Y-m-d H:i:s")
                    ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return $status
            ? redirect('quantri/quantrivien/danhsach')->with('thongbaosuathanhcong', "a")
            : redirect('quantri/quantrivien/danhsach')->with('thongbaosuathatbai', "a");
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
        if(request()->session()->get('quyen_quan_tri_vien'))
        {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('admins')
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
    public function getPermission($id){
        if(request()->session()->get('quyen_quan_tri_vien'))
        {
        $status = false;
         try {
             $permissions = DB::table('phan_quyens')->where('id_admin',$id)->first();
             if($permissions) $status = true;
         } catch (Exception $e) {
             $status = false;
         }
         return $status
             ? view("admin.pages.quantrivien.phanquyen", compact('permissions'))
             : redirect('quantri/loi404');
            }
            return view('admin.pages.error403');
    }
    public function updatePermission(Request $request, $id){
        if(request()->session()->get('quyen_quan_tri_vien'))
        {
        $status = false;
        DB::beginTransaction();
        try {
            DB::table('phan_quyens')
            ->where('id', $id)
            ->update([
                    'danh_muc_san_pham' => $request->danh_muc_san_pham,
                    'loai_san_pham' => $request->loai_san_pham,
                    'san_pham' => $request->san_pham,
                    'danh_muc_tin_tuc' => $request->danh_muc_tin_tuc,
                    'loai_tin_tuc' => $request->loai_tin_tuc,
                    'tin_tuc' => $request->tin_tuc,
                    'danh_muc_dich_vu' => $request->danh_muc_dich_vu,
                    'loai_dich_vu' => $request->loai_dich_vu,
                    'dich_vu' => $request->dich_vu,
                    'phan_hoi_san_pham' => $request->phan_hoi_san_pham,
                    'ho_tro' => $request->ho_tro,
                    'quan_tri_vien' => $request->quan_tri_vien,
                    'nguoi_dung' => $request->nguoi_dung,
                    'cai_dat_trang_chu' => $request->cai_dat_trang_chu,
                    'cai_dat_tin_tuc' => $request->cai_dat_tin_tuc,
                    'cai_dat_san_pham' => $request->cai_dat_san_pham,
                    'cai_dat_dich_vu' => $request->cai_dat_dich_vu,
                    'updated_at' => date("Y-m-d H:i:s")
                    ]);
            DB::commit();
            $status = true;
        } catch (Exception $e) {
            DB::rollback();
            $status = false;
        }

        return $status
            ? redirect('quantri/quantrivien/danhsach')->with('thongbaosuaquyenthanhcong', "a")
            : redirect('quantri/quantrivien/danhsach')->with('thongbaosuathatbai', "a");
        }
        return view('admin.pages.error403');
    }
}
