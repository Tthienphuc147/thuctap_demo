<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Auth,Session;

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
            $user =  DB::table('phan_quyens')
            ->select(
                'phan_quyens.*'
            )->where('phan_quyens.id_admin',Auth::guard('admin')->user()->id)->get();

            $req->session()->put('quyen_danh_muc_san_pham', $user[0]->danh_muc_san_pham);
            $req->session()->put('quyen_loai_san_pham', $user[0]->loai_san_pham);
            $req->session()->put('quyen_san_pham', $user[0]->san_pham);
            $req->session()->put('quyen_danh_muc_tin_tuc', $user[0]->danh_muc_tin_tuc);
            $req->session()->put('quyen_loai_tin_tuc', $user[0]->loai_tin_tuc);
            $req->session()->put('quyen_tin_tuc', $user[0]->tin_tuc);
            $req->session()->put('quyen_danh_muc_dich_vu', $user[0]->danh_muc_dich_vu);
            $req->session()->put('quyen_loai_dich_vu', $user[0]->loai_dich_vu);
            $req->session()->put('quyen_dich_vu', $user[0]->dich_vu);
            $req->session()->put('quyen_phan_hoi_san_pham', $user[0]->phan_hoi_san_pham);
            $req->session()->put('quyen_ho_tro', $user[0]->ho_tro);
            $req->session()->put('quyen_quan_tri_vien', $user[0]->quan_tri_vien);
            $req->session()->put('quyen_nguoi_dung', $user[0]->nguoi_dung);
            $req->session()->put('quyen_giai_dap_thac_mac', $user[0]->giai_dap_thac_mac);
            $req->session()->put('quyen_cai_dat_trang_chu', $user[0]->cai_dat_trang_chu);
            $req->session()->put('quyen_cai_dat_dich_vu', $user[0]->cai_dat_dich_vu);
            $req->session()->put('quyen_cai_dat_tin_tuc', $user[0]->cai_dat_tin_tuc);
            $req->session()->put('quyen_cai_dat_san_pham', $user[0]->cai_dat_san_pham);
            $req->session()->put('quyen_danh_sach_hoa_don', $user[0]->danh_sach_hoa_don);
            return 'quantri/trangchu';
        } else {
            return "false";
        }
    }
    public function getLogoutAdmin(Request $req){
        Auth::guard('admin')->logout();
        $req->session()->flush();
    	return redirect('quantri/dangnhap');
    }
}
