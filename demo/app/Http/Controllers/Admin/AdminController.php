<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AdminController extends Controller
{
    public function loi404(){
        return view('admin.pages.error404');
    }
    public function loi403(){
        return view('admin.pages.error403');
    }

    public function trangchu(){
        return view('admin.pages.homepage');
    }
}
