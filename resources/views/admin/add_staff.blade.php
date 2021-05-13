@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm nhân viên
                        </header>
                        <div class="panel-body">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-staff')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhân viên</label>
                                    <input type="text" name="tennhanvien" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputFile">Ngày sinh</label>
                                    <input type="text" name= "ngaysinh" class="form-control" id="exampleInputFile">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giới tính</label>
                                    <select name="gioitinh" class="form-control">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <textarea style="resize: none;" rows="3" name="diachi" class="form-control" id="exampleInputPassword1" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <textarea style="resize: none;" rows="1" name="email" class="form-control" id="exampleInputPassword1" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <textarea style="resize: none;" rows="1" name="sdt" class="form-control" id="exampleInputPassword1" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Quyền</label>
                                    <select name= "quyen" class="form-control input-lg m-bot15">                           
                                         @foreach($quyennv as $key =>$quyen)
                                            <option value="{{ $quyen->maquyen}}">{{ $quyen->tenquyen}}</option>
                                        @endforeach                                      
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mật khẩu</label>
                                    <textarea style="resize: none;" rows="1" name="matkhau" class="form-control" id="exampleInputPassword1" required=""></textarea>
                                </div>
                                <button type="submit" name="save_product" class="btn btn-info">Thêm</button>
                                <a class="btn btn-default" href="{{URL::to('/all-staff')}}"> Trở lại </a>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection