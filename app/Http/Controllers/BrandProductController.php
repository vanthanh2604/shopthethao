<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProductController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('index_index');
        }else{
            return Redirect::to('admin')->send();
        }
    }
     public function add_brand_product(){
        $this->Authlogin();
    	return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->Authlogin();
    	$all_brand_product = DB::table('thuong_hieu')->paginate(5);
    	$manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    	return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }
     public function save_brand_product(Request $request){
        $this->Authlogin();
     	$data = array();
     	$data['tenth'] = $request->tenth;
     	$data['mota'] = $request->mota;
        $data['trangthaith'] = $request->trangthai;
     	DB::table('thuong_hieu')->insert($data);
     	Session::put('message','Thêm thương hiệu sản phẩm thành công');
    	return Redirect::to('add-brand-product');
    }
     public function edit_brand_product($brand_product_id){
        $this->Authlogin();
    	$edit_brand_product = DB::table('thuong_hieu')->where('math',$brand_product_id)->get();
    	$manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
    	return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function delete_brand_product($brand_product_id){
        $this->Authlogin();
    	DB::table('thuong_hieu')->where('math',$brand_product_id)->delete();
     	Session::put('message','Xóa thương sản phẩm thành công');
     	return Redirect::to('all-brand-product');
    }
    public function update_brand_product(Request $requesst,$brand_product_id){
        $this->Authlogin();
    	$data = array();
     	$data['tenth'] = $requesst->tenth;
     	$data['mota'] = $requesst->mota;
     	DB::table('thuong_hieu')->where('math',$brand_product_id)->update($data);
     	Session::put('message','Cập nhật danh mục sản phẩm thành công');
     	return Redirect::to('all-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        $this->Authlogin();
        DB::table('thuong_hieu')->where('math',$brand_product_id)->update(['trangthaith'=>1]);
        Session::put('message','Ẩn thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->Authlogin();
        DB::table('thuong_hieu')->where('math',$brand_product_id)->update(['trangthaith'=>0]);
        Session::put('message','Hiển thị thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function show_brand_home($brand_id){
        $cate_product = DB::table('loai_san_pham')->where('trangthaidm','0')->orderby('maloai','desc')->get();
        $brand_product = DB::table('thuong_hieu')->where('trangthaith','0')->orderby('math','desc')->get();

        $brand_by_id = DB::table('san_pham')->join('thuong_hieu','san_pham.math','=','thuong_hieu.math')->where('san_pham.math',$brand_id)->get();
        $brand_by_name = DB::table('thuong_hieu')->where('thuong_hieu.math',$brand_id)->limit(1)->get();
        return view('pages.show_brand')->with('danhmuc',$cate_product)->with('thuonghieu',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_by_name',$brand_by_name);
    }
}
