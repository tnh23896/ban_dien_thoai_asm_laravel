@extends('client.layout.layout')
@section('content')

<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">

  <div class="carousel-indicators">
    @foreach($banners as $key => $banner)
    <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{ $key }}"
      class="{{ $key == 0 ? 'active' : '' }}"></li>
    @endforeach
  </div>

  <div class="carousel-inner">
    @foreach($banners as $key => $banner)
    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
      <div class="container">
        <div class="row p-5">
          <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
            <img class="img-fluid" src="{{ Storage::url($banner->image) }}"
              alt="{{ $banner->name }}">
          </div>

          <div class="col-lg-6 mb-0 d-flex align-items-center">
            <div class="text-align-left align-self-center">
              <h1 class="h1 text-success"><b>{{ $banner->name }}</b></h1>

              <p>{{ $banner->description }}</p>
            </div>
          </div>

        </div>
      </div>
    </div>
    @endforeach

  </div>

  <a class="carousel-control-prev text-decoration-none w-auto ps-3"
    href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
    <i class="fas fa-chevron-left"></i>
  </a>
  <a class="carousel-control-next text-decoration-none w-auto pe-3"
    href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
    <i class="fas fa-chevron-right"></i>
  </a>

</div>
<!-- End Banner Hero -->

<!-- Start Featured Product -->
<section class="bg-light">
  <div class="container py-5">
    <div class="row py-3">

    </div>
    <div class="row">
      <div class="col-3">
        @component('templates.form', ['method' => 'GET', 'action' => route('client.home'),'enctype'
        =>"multipart/form-data",'textButton' => 'Lưu'])
        <div class="">
          <h6 class="">Nhà sản xuất</h6>
          <div class="">
            @include('templates.checkbox', ['options' => $brands,'name'=> 'brand',
            'selectedCheckbox'
            =>
            $selectedCheckbox])
          </div>

        </div>
        <div class="">
          <h6 class="">Giá</h6>
          <div class="d-flex gap-2">
            @include('templates.input', ['label' => 'Giá đầu', 'type' => 'number', 'name' =>
            'min_price','value' => session('min_price')])
            @include('templates.input', ['label' => 'Giá cuối', 'type' => 'number', 'name' =>
            'max_price','value' =>  session('max_price')])

          </div>

        </div>
        @endcomponent
      </div>
      <div class="col-9 " style="background-color: white">
        <div class="row ">
          <h1 class="">Điện thoại ({{ count($phones)}} sản phẩm)</h1>
          @foreach ($phones as $phone)
          <div class="col-lg-4 col-md-6 mb-4">
            @include('templates.product_card', ['phone' => $phone])
          </div>
          @endforeach
        </div>
      </div>
    </div>
</section>
<!-- End Featured Product -->
@endsection