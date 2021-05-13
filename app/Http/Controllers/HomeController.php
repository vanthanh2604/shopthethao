<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    //
    public function index(){
    	$cate_product = DB::table('loai_san_pham')->where('trangthaidm','0')->orderby('maloai','desc')->get();
    	$brand_product = DB::table('thuong_hieu')->where('trangthaith','0')->orderby('math','desc')->get();
    	$all_product = DB::table('san_pham')->where('trangthaisp','0')->orderby('masp','desc')->get();

    	return view('pages.home')->with('danhmuc',$cate_product)->with('thuonghieu',$brand_product)->with('sanpham', $all_product);
    }
} 
 