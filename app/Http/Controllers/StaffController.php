<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class StaffController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('index_index');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_staff(){
        $this->Authlogin();
        $quyennv = DB::table('quyen')->orderby('maquyen','desc')->get();
    	return view('admin.add_staff')->with('quyennv', $quyennv);
    }
    public function all_staff(){
        $this->Authlogin();
    	$all_staff = DB::table('nhan_vien')->join('quyen','quyen.maquyen','=','nhan_vien.maquyen')->paginate(5);
    	$manager_staff = view('admin.all_staff')->with('all_staff',$all_staff);
    	return view('admin_layout')->with('admin.all_staff', $manager_staff);
    }
     public function save_staff(Request $request){
        $this->Authlogin();
     	$data = array();
     	$data['maquyen'] = $request->quyen;
     	$data['tennv'] = $request->tennhanvien;
     	$data['ngsinh'] = $request->ngaysinh;
     	$data['gioitinh'] = $request->gioitinh;
     	$data['diachi'] = $request->diachi;
        $data['sdt'] = $request->sdt;
     	$data['email'] = $request->email;
        $data['matkhau'] =md5($request->matkhau);
     	
     	DB::table('nhan_vien')->insert($data);
     	Session::put('message','Thêm nhân viên thành công');
    	return Redirect::to('add-staff');
     		
    }
    public function edit_staff($staff_id){
        $this->Authlogin();
        $quyen_staff = DB::table('quyen')->orderby('maquyen','desc')->get();
    	$edit_staff = DB::table('nhan_vien')->where('manv',$staff_id)->get();
        $manager_staff = view('admin.edit_staff')->with('edit_staff',$edit_staff)->with('quyen_staff', $quyen_staff);
        return view('admin_layout')->with('admin.edit_staff', $manager_staff);
    }
    public function delete_staff($staff_id){
        $this->Authlogin();
    	DB::table('nhan_vien')->where('manv',$staff_id)->delete();
     	Session::put('message','Xóa nhân viên thành công');
     	return Redirect::to('all-staff');
    }
    public function update_staff(Request $request,$staff_id){
        $this->Authlogin();
    	$data = array();
        $data['maquyen'] = $request->quyen;
        $data['tennv'] = $request->tennhanvien;
        $data['ngsinh'] = $request->ngaysinh;
        $data['gioitinh'] = $request->gioitinh;
        $data['diachi'] = $request->diachi;
        $data['sdt'] = $request->sdt;
        $data['email'] = $request->email;
        $data['matkhau'] = $request->matkhau;
     	
     	DB::table('nhan_vien')->where('manv',$staff_id)->update($data);
     	Session::put('message','Cập nhật nhân viên thành công');
    	return Redirect::to('all-staff');
    }
}
