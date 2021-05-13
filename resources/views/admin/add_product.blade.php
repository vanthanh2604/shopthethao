@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="tensanpham" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh sản phẩm</label>
                                    <input type="file" name= "hinhanh" class="form-control" id="exampleInputFile">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chất liệu</label>
                                    <textarea style="resize: none;" rows="1" name="chatlieu" class="form-control" id="exampleInputPassword1" placeholder="Chất liệu" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Màu sắc</label>
                                    <textarea style="resize: none;" rows="1" name="mausac" class="form-control" id="exampleInputPassword1" placeholder="Màu sắc" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng</label>
                                    <textarea style="resize: none;" rows="1" name="soluong" class="form-control" id="exampleInputPassword1" placeholder="Số lượng" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Đơn giá</label>
                                    <textarea style="resize: none;" rows="1" name="dongia" class="form-control" id="exampleInputPassword1" placeholder="Đơn giá" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kích cỡ</label>
                                    <select name= "kichco" class="form-control input-lg m-bot15">                           
                                         @foreach($size_product as $key =>$size)
                                            <option value="{{ $size->makc}}">{{ $size->tenkc}}</option>
                                        @endforeach                                      
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name= "danhmuc" class="form-control input-lg m-bot15">
                                        @foreach($cate_product as $key =>$cate)
                                            <option value="{{ $cate->maloai}}">{{ $cate->tenloai}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                    <select name= "thuonghieu" class="form-control input-lg m-bot15">
                                         @foreach($brand_product as $key =>$brand)
                                            <option value="{{ $brand->math}}">{{ $brand->tenth}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name="save_product" class="btn btn-info">Thêm</button>
                                <a class="btn btn-default" href="{{URL::to('/all-product')}}"> Trở lại </a>
                            </form>
                            </div>

                        </div>
                    </section>
 
            </div>
@endsection