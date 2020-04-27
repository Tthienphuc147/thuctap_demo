<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function orderBy(){
    //     DB::beginTransaction();

    //     try {
    //         //xử lý dữ liệu

    //         DB::commit();
    //         return view("admin.pages.danhmucsanpham.danhsach", compact("danh_muc_sp")); 
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect('quantri/loi404');
    //     }
    // }
}
