<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Auth;

class DangNhapController extends Controller
{ 
    public function getDangNhapQuanTri(){  
        if(Auth::guard('admin')->check()){
            return redirect('quantri/trangchu');     
        } 
    	return view('admin.pages.dangnhap.login');
    }

    public function postDangNhapQuanTri(Request $req){
    	$login = filter_var($req->tai_khoan, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $payload[$login] = $req->tai_khoan;
        $payload['password'] = $req->mat_khau; 
        if (Auth::guard('admin')->attempt($payload, $req->ghi_nho)) { 
            return 'quantri/trangchu'; 
        } else {
            return "false";
        } 
    }
    public function getLogoutAdmin(){ 
    	Auth::guard('admin')->logout();
    	return redirect('quantri/dangnhap');
    }
}
