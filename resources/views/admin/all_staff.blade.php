@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nhân viên
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
            <th>Tên nhân viên</th>
            {{-- <th>Hình ảnh</th> --}}
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Địa chỉ</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Quyền</th>
            <th></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_staff as $key=>$staff)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $staff->tennv }}</td>
            {{-- <td><img src="public/uploads/staff/{{ $staff->hinhanh }}" height="80" width="70"></td> --}}
            <td>{{ $staff->ngsinh }}</td>
            <td><span class="text-ellipsis">
              <?php
                if($staff->gioitinh==0){
                  echo "Nam";
                }
                else{
                  echo "Nữ";
                }
              ?>
            </span></td>
            <td>{{ $staff->diachi }}</td>
            <td>{{ $staff->email }}</td>
            <td>{{ $staff->sdt }}</td>
            <td>{{ $staff->tenquyen }}</td>
            <td><span class="text-ellipsis"></span></td>
            <td>
              <a href="{{URL::to('/edit-staff/'.$staff->manv)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="{{URL::to('/delete-staff/'.$staff->manv)}}" class="active styling-edit" ui-toggle-class="">
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
            @if($all_staff->currentPage() != 1)
            <li><a href="{!! str_replace('/?', '?', $all_staff->url($all_staff->currentPage() - 1)) !!}"><i class="fa fa-chevron-left"></i></a></li>
            @endif
            @for ( $i = 1; $i <= $all_staff->lastPage(); $i = $i + 1)
            <li><a href="{!! str_replace('/?', '?', $all_staff->url($i)) !!}">{!!$i!!}</a></li>
            @endfor
            @if($all_staff->currentPage() != $all_staff->lastPage())
            <li><a href="{!! str_replace('/?', '?', $all_staff->url($all_staff->currentPage() + 1)) !!}"><i class="fa fa-chevron-right"></i></a></li>
            @endif
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection