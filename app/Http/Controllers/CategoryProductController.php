<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProductController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('index_index');
        }else{
            return Redirect::to('admin')->send();
        }
    }
     public function add_category_product(){
        $this->Authlogin();
    	return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->Authlogin();
    	$all_category_product = DB::table('loai_san_pham')->paginate(5);
    	$manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }
     public function save_category_product(Request $request){
        $this->Authlogin();
     	$data = array();
     	$data['tenloai'] = $request->tenloai;
     	$data['mota'] = $request->mota;
        $data['trangthaidm'] = $request->trangthai;
     	DB::table('loai_san_pham')->insert($data);
     	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category-product');
    }
     public function edit_category_product($category_product_id){
        $this->Authlogin();
    	$edit_category_product = DB::table('loai_san_pham')->where('maloai',$category_product_id)->get();
    	$manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
    	return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function delete_category_product($category_product_id){
        $this->Authlogin();
    	DB::table('loai_san_pham')->where('maloai',$category_product_id)->delete();
     	Session::put('message','Xóa danh mục sản phẩm thành công');
     	return Redirect::to('all-category-product');
    }
    public function update_category_product(Request $requesst,$category_product_id){
        $this->Authlogin();
    	$data = array();
     	$data['tenloai'] = $requesst->tenloai;
     	$data['mota'] = $requesst->mota;
     	DB::table('loai_san_pham')->where('maloai',$category_product_id)->update($data);
     	Session::put('message','Cập nhật danh mục sản phẩm thành công');
     	return Redirect::to('all-category-product');
    }
    public function unactive_category_product($category_product_id){
        $this->Authlogin();
        DB::table('loai_san_pham')->where('maloai',$category_product_id)->update(['trangthaidm'=>1]);
        Session::put('message','Ẩn danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->Authlogin();
        DB::table('loai_san_pham')->where('maloai',$category_product_id)->update(['trangthaidm'=>0]);
        Session::put('message','Hiển thị danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function show_category_home($category_id){
        $cate_product = DB::table('loai_san_pham')->where('trangthaidm','0')->orderby('maloai','desc')->get();
        $brand_product = DB::table('thuong_hieu')->where('trangthaith','0')->orderby('math','desc')->get();

        $category_by_id = DB::table('san_pham')->join('loai_san_pham','san_pham.maloai','=','loai_san_pham.maloai')->where('san_pham.maloai',$category_id)->get();
        $category_by_name = DB::table('loai_san_pham')->where('loai_san_pham.maloai',$category_id)->limit(1)->get();
        return view('pages.show_category')->with('danhmuc',$cate_product)->with('thuonghieu',$brand_product)->with('category_by_id',$category_by_id)->with('category_by_name',$category_by_name);
    }
}
