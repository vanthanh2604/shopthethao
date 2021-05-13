@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>
                        <div class="panel-body">
                            @foreach($edit_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-product/'.$edit_value->masp)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="tensanpham" class="form-control" id="exampleInputEmail1"  value="{{($edit_value->tensp)}}" placeholder="Tên sản phẩm" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh sản phẩm</label></br>
                                    <img src="{{URL::to('public/uploads/product/'.$edit_value->hinhanh)}}" height="100" width="100">
                                    <input type="file" name="hinhanh" class="form-control" id="exampleInputFile">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chất liệu</label>
                                    <input type="text" name="chatlieu" class="form-control" id="exampleInputEmail1"  value="{{($edit_value->chatlieu)}}" placeholder="Chất liệu" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Màu sắc</label>
                                    <input type="text" name="mausac" class="form-control" id="exampleInputEmail1"  value="{{($edit_value->mausac)}}" placeholder="Màu sắc" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" name="soluong" class="form-control" id="exampleInputEmail1"  value="{{($edit_value->soluong)}}" placeholder="Số lượng" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn giá</label>
                                    <input type="text" name="dongia" class="form-control" id="exampleInputEmail1"  value="{{($edit_value->dongia)}}" placeholder="Đơn giá" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kích cỡ</label>
                                    <select name= "kichco" class="form-control input-lg m-bot15">              
                                        @foreach($size_product as $key =>$size)
                                            @if($size->makc==$edit_value->makc)
                                                <option selected value="{{ $size->makc}}">{{ $size->tenkc}}</option>
                                            @else
                                                <option value="{{ $size->makc}}">{{ $size->tenkc}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name= "danhmuc" class="form-control input-lg m-bot15">
                                        @foreach($cate_product as $key =>$cate)
                                            @if($cate->maloai==$edit_value->maloai)
                                                <option selected value="{{ $cate->maloai}}">{{ $cate->tenloai }}</option>
                                            @else
                                                <option value="{{ $cate->maloai}}">{{ $cate->tenloai}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                    <select name= "thuonghieu" class="form-control input-lg m-bot15">
                                         @foreach($brand_product as $key =>$brand)
                                            @if($brand->math==$edit_value->math)
                                                <option selected value="{{ $brand->math}}">{{ $brand->tenth}}</option>
                                            @else
                                                <option value="{{ $brand->math}}">{{ $brand->tenth}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật</button>
                                <a class="btn btn-default" href="{{URL::to('/all-product')}}"> Trở lại </a>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection