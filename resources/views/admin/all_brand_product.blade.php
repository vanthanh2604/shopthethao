@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương hiệu sản phẩm
    </div>
    <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên thương hiệu</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_brand_product as $key=>$brand_pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $brand_pro->tenth }}</td>
            <td><span class="text-ellipsis">{{ $brand_pro->mota }}</span></td>
            <td><span class="text-ellipsis">
              <?php
                if($brand_pro->trangthaith==0){ ?>
                  <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->math)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php }else{ ?>
                  <a href="{{URL::to('/active-brand-product/'.$brand_pro->math)}}"><span class="fa-thumb-styling fa fa fa-thumbs-down"></span></a>
                <?php } ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$brand_pro->math)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->math)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            @if($all_brand_product->currentPage() != 1)
            <li><a href="{!! str_replace('/?', '?', $all_brand_product->url($all_brand_product->currentPage() - 1)) !!}"><i class="fa fa-chevron-left"></i></a></li>
            @endif
            @for ( $i = 1; $i <= $all_brand_product->lastPage(); $i = $i + 1)
            <li><a href="{!! str_replace('/?', '?', $all_brand_product->url($i)) !!}">{!!$i!!}</a></li>
            @endfor
            @if($all_brand_product->currentPage() != $all_brand_product->lastPage())
            <li><a href="{!! str_replace('/?', '?', $all_brand_product->url($all_brand_product->currentPage() + 1)) !!}"><i class="fa fa-chevron-right"></i></a></li>
            @endif
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection