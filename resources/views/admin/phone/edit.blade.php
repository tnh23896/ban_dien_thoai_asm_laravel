@extends('admin.layout')
@section('content')

<h2>Sửa</h2>
@component('templates.form', ['method' => 'POST', 'action' => route('admin.phone.edit',['phone'=>$phone->id]),'textButton' => 'Sửa','enctype' => 'multipart/form-data'])
@include('templates.select', ['label' => 'Danh mục', 'name' => 'category_id', 'options' => $categories,'optionField' => 'name','optionValue' => 'id','defaultText'=>"Chọn danh muc",'optionSelected' => $phone->category_id])
@include('templates.select', ['label' => 'Hãng', 'name' => 'brand_id', 'options' => $brands,'optionField' => 'name','optionValue' => 'id','defaultText'=>"Chọn hãng",'optionSelected' => $phone->brand_id])
@include('templates.select', ['label' => 'Phiếu giảm giá', 'name' => 'promotion_id', 'options' => $promotions,'optionField' => 'id','optionValue' => 'id','defaultText'=>"Chọn phiếu giảm giá",'optionSelected' => $phone->promotion_id])
@include('templates.input', ['label' => 'Tên sản phẩm', 'type' => 'text', 'name' => 'name','value' => $phone->name])
<img src="{{$phone->image ?''.Storage::url($phone->image):''}}" width="100" alt="">
@include('templates.input', ['label' => 'Hình ảnh', 'type' => 'file', 'name' => 'image','value' => ''])
@include('templates.input', ['label' => 'Giá tiền', 'type' => 'number', 'name' => 'price','value' => $phone->price])
@include('templates.input', ['label' => 'Số lượng', 'type' => 'number', 'name' => 'quantity','value' => $phone->quantity])
@include('templates.textarea', ['label' => 'Mô tả', 'name' => 'description','value' => $phone->description])



@endcomponent
@endsection