@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật nhân viên
                        </header>
                        <div class="panel-body">
                            @foreach($edit_staff as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-staff/'.$edit_value->manv)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhân viên</label>
                                    <input type="text" name="tennhanvien" class="form-control" value="{{($edit_value->tennv)}}" required="">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh sản phẩm</label></br>
                                    <img src="{{URL::to('public/uploads/staff/'.$edit_value->hinhanh)}}" height="100" width="100">
                                    <input type="file" name="hinhanh" class="form-control" id="exampleInputFile">
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="text" name="ngaysinh" class="form-control"  value="{{($edit_value->ngsinh)}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giới tính</label>
                                    <select name= "gioitinh" class="form-control input-lg m-bot15">              
                                            @if($edit_value->gioitinh==0)
                                                <option selected value="1">Nữ</option>
                                                <option selected value="0">Nam</option>
                                            @else

                                                <option value="1">Nữ</option>
                                                <option value="0">Nam</option>
                                            @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" name="diachi" class="form-control" value="{{($edit_value->diachi)}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{($edit_value->email)}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SĐT</label>
                                    <input type="text" name="sdt" class="form-control" value="{{($edit_value->sdt)}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="text" name="matkhau" class="form-control" value="{{($edit_value->matkhau)}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Quyền</label>
                                    <select name= "quyen" class="form-control input-lg m-bot15">              
                                        @foreach($quyen_staff as $key =>$quyen)
                                            @if($quyen->maquyen==$edit_value->maquyen)
                                                <option selected value="{{ $quyen->maquyen}}">{{ $quyen->tenquyen}}</option>
                                            @else
                                                <option value="{{ $quyen->maquyen}}">{{ $quyen->tenquyen}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                
                                <button type="submit" name="update_staff" class="btn btn-info">Cập nhật</button>
                                <a class="btn btn-default" href="{{URL::to('/all-staff')}}"> Trở lại </a>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection