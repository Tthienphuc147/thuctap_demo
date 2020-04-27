<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ThongTinLienHeController extends Controller
{
    public function getThongTin(){
    	return view('user.pages.about');
    }
    public function getLienHe(){
    	return view('user.pages.contact');
    }
    public function postLienHe(Request $req){ 
    	 $new_contact = DB::table('ho_tros')->insert(
            [
                'ho_ten' => $req->ten_lien_he, 
                'email' => $req->mail_lien_he, 
                'lien_he' => $req->lien_he, 
                'noi_dung' => $req->loi_nhan,  
                'is_read' => false,
                'is_read' => false,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        );
       return back()->with('thong_bao_ho_tro', $new_contact);
    }

    public function getGiaiDapThacMac(){
      $giai_dap = DB::table('giai_dap_thac_macs')->inRandomOrder()->paginate(30);
    	return view('user.pages.forum',compact('giai_dap'));
    }
    public function postDangKyGuiMail(Request $req){
        $kiem_tra = DB::table('dang_ky_nhan_mails')->where('email','=',$req->sub_mail)->first();
        if($kiem_tra != null){
            return '1';
        }
        $check = DB::table('dang_ky_nhan_mails')->insert(
            [
                'trang_thai' => true, 
                'email' => $req->sub_mail,  
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        );
        return $check ? '1' : '0'; 
    }
}
