<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();
class ProductController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('index_index');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->Authlogin();
    	$cate_product = DB::table('loai_san_pham')->orderby('maloai','desc')->get();
    	$brand_product = DB::table('thuong_hieu')->orderby('math','desc')->get();
    	$size_product = DB::table('kich_co')->orderby('makc','desc')->get();
    	return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with('size_product', $size_product);
    }
    public function all_product(){
        $this->Authlogin();
    	$all_product = DB::table('san_pham')
    	->join('loai_san_pham','loai_san_pham.maloai','=','san_pham.maloai')
    	->join('thuong_hieu','thuong_hieu.math','=','san_pham.math')
    	->join('kich_co','kich_co.makc','=','san_pham.makc')->orderby('san_pham.masp','desc')->paginate(5);
    	$manager_product = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product', $manager_product);
    }
     public function save_product(Request $request){
        $this->Authlogin();
     	$data = array();
     	$data['maloai'] = $request->danhmuc;
     	$data['makc'] = $request->kichco;
     	$data['math'] = $request->thuonghieu;
     	$data['tensp'] = $request->tensanpham;
     	$data['chatlieu'] = $request->chatlieu;
     	$data['mausac'] = $request->mausac;
     	$data['soluong'] = $request->soluong;
     	$data['dongia'] = $request->dongia;
     	if($request->hasFile('hinhanh')){
     		$file = $request->file('hinhanh');
     		$duoi = $file->getClientOriginalExtension();
     		if($duoi != 'jpg' && $duoi != 'png'){
     			Session::put('message','Chọn file hình ảnh chưa đúng');
     			return Redirect::to('add-product');
     		}
     		$name = $file->getClientOriginalName();
     		$hinh = str_random(4).'_'.$name;
     		$data['hinhanh'] = $hinh;
     		while(file_exists('public/uploads/product/'.$hinh)){
     			$hinh = str_random(4).'_'.$name;
     		}
     		$file->move('public/uploads/product',$hinh);
     	}
     	else{
     		$data['hinhanh']='';
     	}
     
     	DB::table('san_pham')->insert($data);
     	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('add-product');
     		
    }
    public function edit_product($product_id){
        $this->Authlogin();
     	$cate_product = DB::table('loai_san_pham')->orderby('maloai','desc')->get();
    	$brand_product = DB::table('thuong_hieu')->orderby('math','desc')->get();
    	$size_product = DB::table('kich_co')->orderby('makc','desc')->get();

    	$edit_product = DB::table('san_pham')->where('masp',$product_id)->get();

    	$manager_product = view('admin.edit_product')
    	->with('edit_product',$edit_product)->with('size_product',$size_product)->with('cate_product',$cate_product)
    	->with('brand_product',$brand_product);
    	return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function delete_product($product_id){
        $this->Authlogin();
    	DB::table('san_pham')->where('masp',$product_id)->delete();
     	Session::put('message','Xóa sản phẩm thành công');
     	return Redirect::to('all-product');
    }
    public function update_product(Request $request,$product_id){
        $this->Authlogin();
    	$data = array();
     	$data['maloai'] = $request->danhmuc;
     	$data['makc'] = $request->kichco;
     	$data['math'] = $request->thuonghieu;
     	$data['tensp'] = $request->tensanpham;
     	$data['chatlieu'] = $request->chatlieu;
     	$data['mausac'] = $request->mausac;
     	$data['soluong'] = $request->soluong;
     	$data['dongia'] = $request->dongia;
     	
     	if($request->hasFile('hinhanh')){
     		$file = $request->file('hinhanh');
     		$duoi = $file->getClientOriginalExtension();
     		if($duoi != 'jpg' && $duoi != 'png'){
     			Session::put('message','Chọn file hình ảnh chưa đúng');
     			return Redirect::to('add-product');
     		}
     		$name = $file->getClientOriginalName();
     		$hinh = str_random(4).'_'.$name;
     		$data['hinhanh'] = $hinh;
     		while(file_exists('public/uploads/product/'.$hinh)){
     			$hinh = str_random(4).'_'.$name;
     		}
     		$file->move('public/uploads/product',$hinh);
     	}
     	
     	DB::table('san_pham')->where('masp',$product_id)->update($data);
     	Session::put('message','Cập nhật sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
        $this->Authlogin();
        DB::table('san_pham')->where('masp',$product_id)->update(['trangthaisp'=>1]);
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->Authlogin();
        DB::table('san_pham')->where('masp',$product_id)->update(['trangthaisp'=>0]);
        Session::put('message','Hiển thị sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function details_product($product_id){
        $cate_product = DB::table('loai_san_pham')->where('trangthaidm','0')->orderby('maloai','desc')->get();
        $brand_product = DB::table('thuong_hieu')->where('trangthaith','0')->orderby('math','desc')->get();
        $details_product = DB::table('san_pham')
        ->join('loai_san_pham','loai_san_pham.maloai','=','san_pham.maloai')
        ->join('thuong_hieu','thuong_hieu.math','=','san_pham.math')
        ->join('kich_co','kich_co.makc','=','san_pham.makc')->where('san_pham.masp',$product_id)->get();

        return view('pages.show_details')->with('danhmuc',$cate_product)->with('thuonghieu',$brand_product)->with('product_details',$details_product);
    }
}
