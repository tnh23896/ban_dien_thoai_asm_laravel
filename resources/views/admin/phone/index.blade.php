@extends('admin.layout')
@section('title', 'Điện thoại')
@section('content')

<h2>Danh sách điện thoại</h2>
<a href="{{route('admin.phone.create')}}" class="btn btn-primary">Thêm</a>
<div class="table-responsive small">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Danh mục</th>
        <th scope="col">Hãng</th>
        <th scope="col">Mã Phiếu giảm</th>
        <th scope="col">Tên</th>
        <th scope="col">Ảnh</th>
        <th scope="col">Giá</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Hành động</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($phones as $key => $phone)
      <tr>
        <td>{{$phone->id}}</td>
        <td>{{$phone->category_name}}</td>
        <td>{{$phone->brand_name}}</td>
        <td>{{$phone->promotion_id ?? "Không có"}}</td>
        <td>{{$phone->name}}</td>
        <td><img src="{{$phone->image ?''.Storage::url($phone->image):''}}" alt="" width="100" height="100"></td>
        <td>{{$phone->price}}</td>
        <td>{{$phone->quantity}}</td>
        <td>
          <a href="{{route('admin.phone.edit',['phone'=>$phone->id])}}" class="btn btn-primary">Sửa</a>
          <a href="{{route('admin.phone.delete',['phone'=>$phone->id])}}" class="btn btn-danger">Xóa</a>
        </td>
      </tr>
      @endforeach
      <tr>
        <td colspan="7">
          {{$phones->links('custom.pagination')}}
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection