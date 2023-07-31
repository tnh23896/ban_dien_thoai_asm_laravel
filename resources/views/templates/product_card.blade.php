<div class="card border-0 shadow">
  <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Hot
  </div>
  <a href="{{ route('client.detail', ['phone' => $phone->id]) }}">
    <img src="{{ Storage::url($phone->image) }}" class="card-img-top">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">
        <a href="#" class="text-dark text-decoration-none">{{ $phone->name }}</a>
      </h5>
      <p class="card-text flex-grow-1">
        <a href="#" class="text-muted text-decoration-none">{{ $phone->category_name
          }}</a>
      </p>
      @php
           $reviews_by_phone = DB::table('reviews')
    ->where('phone_id', $phone->id)
    ->get();
    $promotion = DB::table('phones')->join('promotions', 'promotions.id', '=', 'phones.promotion_id')->select('promotions.*')->where('phones.id', $phone->id)->first();
      @endphp

      <div class="">
        @if ($reviews_by_phone->count() > 0)
        @php
        $sumRatings = $reviews_by_phone->sum('rating');
        $averageRating = $sumRatings / $reviews_by_phone->count();
        @endphp
        <span>
          @for ($i = 1; $i <= 5; $i++) @if ($averageRating>= $i)
            <i class="fas fa-star text-warning"></i>
            @elseif ($averageRating > $i - 1 && $averageRating < $i) <i
              class="fas fa-star-half-alt text-warning"></i>
              @else
              <i class="far fa-star text-warning"></i>
              @endif
              @endfor
        </span>
      @endif
      @if ($promotion != null)
            @php
            $currentDate = now();
            $checkDate = $currentDate->between($promotion->start_date,
            $promotion->end_date);
            @endphp
            @if ($checkDate)

            <div class="d-flex">
              <p class="fs-5 text-decoration-line-through py-2">{{formatNumberPrice($phone->price)}}
              </p>
              <p class="fs-5 text-danger fw-bold ms-2 py-2">{{formatNumberPrice($phone->price -
                $promotion->discount)}}
              </p>
            </div>
            @else
            <p class="h3 py-2">{{formatNumberPrice($phone->price)}}
            </p>
            @endif

            @endif
        
      </div>

      <div class="text-center">
        @component('templates.form', ['method' => 'POST', 'action' =>
        route('client.cart.create'),'textButton' => 'Lưu vào giỏ hàng'])
        @include('templates.input', ['label' => '', 'type' => 'hidden', 'name' =>
        'phone_id','value' => $phone->id])
        @endcomponent
      </div>
    </div>
  </a>
</div>