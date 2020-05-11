<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DateTime, DB;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Session, Mail;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $back_link = url()->previous();
        return view('user.pages.login_register')->with('back_link', $back_link);
    }

    public function loginUser(Request $request)
    {
        $login = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $payload[$login] = $request->name;
        $payload['password'] = $request->pass;
        if (Auth::guard('web')->attempt($payload, $request->remember)) {
            return $request->back_link;
        } else {
            return "false";
        }
    }

    public function logOutUser(){
        Auth::guard('web')->logout();
        return back();
    }

    public function testLoginAdmin(Request $request){
        $login = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $payload[$login] = $request->name;
        $payload['password'] = $request->pass;
        if (Auth::guard('admin')->attempt($payload)) {
            return back();
        }
        else{
            return "Đăng nhập admin lỗi";
        }
    }

    public function testLogoutAdmin(Request $request){
        Auth::guard('admin')->logout();
        return back();
    }

    public function getThongTinTaiKhoan(){
        try {
            if(Auth::guard('web')->check()){
                return view('user.pages.profile');
            }
            return back();
        } catch (Exception $e) {
            return view('user.pages.404');
        }

    }

    public function postDangKyTaiKhoan(Request $request)
    {
        $check_user = DB::table('users')
        ->where('email','=',$request->mail_tai_khoan)
        ->orWhere('name','=',$request->ten_tai_khoan)
        ->first();
        if($check_user != null){
            return "exist";
        }
        $user = DB::table('users')->insert(
            [
                'display_name' => $request->ten_hien_thi,
                'name' => $request->ten_tai_khoan,
                'email' => $request->mail_tai_khoan,
                'password' => bcrypt($request->mat_khau_tai_khoan),
                'role' => 'us',
                'locked' => false,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        );
        return $user ? 'true' : 'false';
    }

    public function postThongTinTaiKhoan(Request $req)
    {
        $change_user = DB::table('users')->where('id','=', Auth::guard('web')->user()->id)
        ->update(['display_name' => $req->ten_hien_thi,'password' => bcrypt($req->mat_khau_tai_khoan)]);
        return $change_user ? '1' : '0';
    }
    // Xử lý xác thực tài khoản
    public function getQuenMatKhau(){
        return view('user.pages.forgot_password');
    }
    public function postQuenMatKhau(Request $req){
        $tim_tai_khoan = DB::table('users')->where('email','=',$req->email)->first();
        if($tim_tai_khoan != null){
            if($tim_tai_khoan->role != "fb"){

                $chuoi_chuan = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $do_dai_chuoi_chuan = strlen($chuoi_chuan);
                $tao_chuoi_ngau_nhien = '';
                for ($i = 0; $i < 6; $i++) {
                    $tao_chuoi_ngau_nhien .= $chuoi_chuan[rand(0, $do_dai_chuoi_chuan - 1)];
                }
                // Thêm hoặc sửa bảng reset pass
                $password_resets = DB::table('password_resets')->where('email','=',$req->email)->first();
                if($password_resets != null){
                    $password_resets = DB::table('password_resets')->where('email','=',$req->email)
                    ->update(['token' => $tao_chuoi_ngau_nhien]);
                }
                else{
                    $password_resets = DB::table('password_resets')->insert(
                        ['email' => $req->email, 'token' => $tao_chuoi_ngau_nhien]
                    );
                }
                // Thiết lập gởi mail đi
                $data = [
                    'ten_hien_thi' => $tim_tai_khoan->display_name,'ma_xac_thuc' => $tao_chuoi_ngau_nhien,
                ];

                $user = [
                    'email' => $tim_tai_khoan->email,'view_name' => $tim_tai_khoan->display_name,
                ];

                Mail::send('user.mail.reset_pass', $data, function($msg) use ($tim_tai_khoan){
                    $msg->from('rumkc147@gmail.com',"Cửa hàng PHUC STORE");
                    $msg->to($tim_tai_khoan->email, $tim_tai_khoan->display_name)
                    ->subject('Yêu cầu xác thực tài khoản!');
                });

                Session::put('goi_email_xac_thuc', $tim_tai_khoan->email);
                Session::put('thong_bao_xac_thuc', 'Một mã xác thực được gởi tới Email của bạn, vui lòng kiểm tra hộp thư!');

                return redirect('quen-mat-khau/xac-thuc-ma');
            }
            return back()->with('loi_email_xac_thuc','Email tài khoản không tồn tại. Vui lòng kiểm tra lại!');
        }
        return back()->with('loi_email_xac_thuc','Email tài khoản không tồn tại. Vui lòng kiểm tra lại!');
    }
    public function getXacThucMatKhau(){
        if(Session::has('thong_bao_xac_thuc')){
            return view('user.pages.verification');
        }
        return redirect('dang-nhap');
    }
    public function postNhapMaXacThuc(Request $req){
        $email = Session::get('goi_email_xac_thuc');
        if($email != null){
            $tai_khoan_xac_thuc = DB::table('password_resets')
            ->where('email','=',$email)
            ->where('token','=',$req->ma_xac_thuc)
            ->first();
            if($tai_khoan_xac_thuc != null){
                Session::put('email_doi_pass', $email);
                Session::forget('thong_bao_xac_thuc');
                Session::forget('goi_email_xac_thuc');
                return redirect('quen-mat-khau/thay-doi-mat-khau.html');
            }
            return back()->with('loi_nhap_xac_thuc','Mã xác thực không đúng, vui lòng kiểm tra lại!');
        }
        return redirect('dang-nhap');
    }
    public function getThayDoiMatKhau(){
        if(Session::has('email_doi_pass') && (!Session::has('thong_bao_xac_thuc'))){
            return view('user.pages.reset_pass');
        }
        return redirect('dang-nhap');
    }
    public function postThayDoiMatKhau(Request $req){
        $doi_ma_moi = DB::table('users')
        ->where('email','=',$req->email)
        ->update(['password' => bcrypt($req->mat_khau_moi)]);
        if($doi_ma_moi){
            Session::forget('email_doi_pass');
        }
        return $doi_ma_moi ? 'true' : 'false';
    }
}
