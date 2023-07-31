<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Phone;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhoneController extends Controller
{
  public function detail(Request $request, $phone)
  {
    $phone = Phone::where('phones.deleted_at', null)->where('phones.id', $phone)->join('categories', 'categories.id', '=', 'phones.category_id')->join('brands', 'brands.id', '=', 'phones.brand_id')->select('phones.*', 'categories.name as category_name', 'brands.name as brand_name')->first();
    $reviews_by_phone = DB::table('reviews')
    ->where('phone_id', $phone->id)
    ->get();
    // promotion_id in phones
    $promotion = DB::table('phones')->join('promotions', 'promotions.id', '=', 'phones.promotion_id')->select('promotions.*')->where('phones.id', $phone->id)->first();
    // Lấy danh mục ID của sản phẩm
    $categoryId = $phone->category_id;

    // Lấy ra các sản phẩm cùng danh mục
    $relatedProducts = Phone::join('categories', 'categories.id', '=', 'phones.category_id')->select('phones.*', 'categories.name as category_name')->where('category_id', $categoryId)
      ->where('phones.id', '!=', $phone->id)
      ->take(4)
      ->get();
    $reviews = Review::join('users', 'reviews.user_id', '=', 'users.id')->join('phones', 'reviews.phone_id', '=', 'phones.id')->select('users.avatar as user_avatar', 'users.name as user_name', 'reviews.created_at', 'reviews.rating', 'reviews.comment')->where('phone_id', $phone->id)->get();
    // Trả về view kèm các sản phẩm liên quan
    return view('client.detail', compact('phone', 'relatedProducts', 'reviews', 'reviews_by_phone', 'promotion'));
  }
}
