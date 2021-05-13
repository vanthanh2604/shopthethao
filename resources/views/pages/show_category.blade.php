@extends('welcome')
@section('content')
<div class="col-sm-9 padding-right">
<div class="features_items"><!--features_items-->
    @foreach($category_by_name as $key=>$name)
    <h2 class="title text-center">{{$name->tenloai}}</h2>
    @endforeach
    @foreach($category_by_id as $key=>$pro)
    <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->masp)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/uploads/product/'.$pro->hinhanh)}}" height="245" alt="" />
                    <h2>{{number_format($pro->dongia).' '.'VNĐ'}}</h2>
                    <p>{{$pro->tensp}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>
            </div>
    </a>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
     @endforeach
</div><!--features_items-->
@endsection