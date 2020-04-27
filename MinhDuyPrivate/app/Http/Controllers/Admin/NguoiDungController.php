<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;

class NguoiDungController extends Controller
{
    /**
     * Hiển thị danh sách người dùng.
     *
     * @return trang /quantri/loaisanpham/danhsach
     */
    public function index()
    {
        $status = false;
        try {
            $nguoi_dung = DB::table('users')
                ->orderBy('id', 'ASC')
                ->get();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }
        return $status
            ? view("admin.pages.nguoidung.danhsach", compact("nguoi_dung"))
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
     * Cập nhật trạng thái khóa tài khoản trang người dùng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateKhoa(Request $request)
    {
        $status = false;
        $locked = filter_var((string)$request->locked, FILTER_VALIDATE_BOOLEAN)? true : false;
        DB::beginTransaction(); 
        try {
            DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'locked' => !$locked,
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
            'locked' => !$locked
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
            DB::table('users')
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
