<?php

namespace App\Http\Controllers\Client;

use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
  public function index()
  {
    return view('client.cart');
  }  
  public function create(Request $request) 
    {
      
      $phone_id = $request->phone_id;
      
      $phone = Phone::find($phone_id);
      if($phone->quantity < $request->quantity) {
        return redirect()->back()->with('error', 'Số lượng sản phẩm trong kho không đủ');
      }
      $cart = session()->get('cart');
      $promotion = DB::table('promotions')->where('id', $phone->promotion_id)->first();
      // Nếu giỏ hàng chưa tồn tại, khởi tạo mới
      if(!$cart) {
        $cart = [
            $phone_id => [
                "name" => $phone->name,
                "price" => $phone->price, 
                "image" => $phone->image,
                "quantity" => $request->quantity??1,
                "discount" => 0,
            ]
        ];
        
        if($phone->promotion_id != null && $promotion){
          
          $currentDate = now();
          $checkDate = $currentDate->between($promotion->start_date, $promotion->end_date);
          if($checkDate){
            $cart[$phone_id]['discount'] = $promotion->discount;
          }
        }
        session()->put('cart', $cart);
      } else {
        // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
        if(isset($cart[$phone_id])) {
          $cart[$phone_id]['quantity']+= $request->quantity??1;
        } else {
          // Nếu sản phẩm chưa có, thêm mới
          $cart[$phone_id] = [
            "name" => $phone->name,
            "price" => $phone->price, 
            "image" => $phone->image,
            "quantity" =>$request->quantity??1,
            "discount" => 0,
          ];
          if($phone->promotion_id != null && $promotion){
            $currentDate = now();
            $checkDate = $currentDate->between($promotion->start_date, $promotion->end_date);
            if($checkDate){
              $cart[$phone_id]['discount'] = $promotion->discount;
            }
          }
        }
    
        session()->put('cart', $cart);
      }
      return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }
    public function update(Request $request)
    {
      $quantities = $request->quantities;
      $phone_ids = $request->phone_ids;
      $cart = session()->get('cart');

      foreach($phone_ids as $key => $id) {
        // get only id
        $phone = Phone::select('id', 'quantity')->where('id', $id)->first();
        // check quantity
        if($phone->quantity < $quantities[$key]){
            return redirect()->back()->with('error', 'Số lượng sản phẩm trong kho không đủ, có vẻ như có người khác đã nhanh hơn, hãy kiểm tra xem còn bao nhiêu sản phẩm trong kho ở trang chi tiết');
        }
        $cart[$id]['quantity'] = $quantities[$key];    
      }
      session()->put('cart', $cart);
    
      return redirect()->back()->with('success', 'Cart updated successfully!');
    
    
    }
public function destroy($id)
{
      $cart = session()->get('cart');
      if(isset($cart[$id])){
        unset($cart[$id]);
      }
      session()->put('cart', $cart);
    
    return redirect()->back()->with('success', 'Đã xóa sản phẩm');
}
public function destroyAll()
{
    session()->forget('cart');
    return redirect()->back()->with('success', 'Đã xóa tất cả sản phẩm');
}
    
}
