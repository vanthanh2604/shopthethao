<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('index_index');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function login(){
    	return view('admin_login');
    }
    public function admin_index(){
        $this->Authlogin();
    	return view('admin.index');
    }
    public function admin_login(Request $request){

    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result = DB::table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
    	if($result){
    		Session::put('admin_name',$result->admin_name);
    		Session::put('admin_id',$result->admin_id);
    		return Redirect::to('/admin_index');
    	}
    	else{
    		Session::put('message','Mật khẩu hoặc email không đúng. Mời nhập lại');
    		return Redirect::to('/admin');
    	}
    }
     public function logout(){
            $this->Authlogin();
			Session::put('admin_name',null);
    		Session::put('admin_id',null);
    		return Redirect::to('/admin');
    }
}
