<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth;

class DemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.demo.danhsach');
    }
    
    public function tinyMCE()
    {
        return view('admin.pages.demo.tinyMCE');
    } 
    public function form1()
    {
        return view('admin.pages.demo.form1');
    }
     public function formUpload()
    {
        return view('admin.pages.demo.formUpload');
    } 

    public function urlthanthien($ten, $id)
    {
        return $id;
    }
    
    public function demoproduct()
    {
        return view('user.pages.product');
    }

    public function demoadd()
    {
        return view('admin.pages.demo.formadd');
    } 

    public function demolink($ndloai, $id, $id_loai)
    {
        return $id;
    }

    public function duallist()
    {
        return view('admin.pages.demo.duallist');
    }

    public function demoauth()
    {
        return dd(Auth::check());
    }

    public function democount()
    {
        $rs = DB::table('danh_muc_san_phams')
            ->join('loai_san_phams', 'id_danh_muc_sp', 'danh_muc_san_phams.id')
            ->join('san_phams', 'id_loai_sp', 'loai_san_phams.id')
            ->select([
                'danh_muc_san_phams.ten as danhmucten',
                'loai_san_phams.ten as loaiten',
                DB::raw('count(*) as count'),
            ])
            ->groupBy('danhmucten','loaiten')
            ->get();
        return dd($rs);
    }
}
