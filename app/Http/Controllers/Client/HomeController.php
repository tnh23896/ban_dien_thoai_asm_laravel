<?php

namespace App\Http\Controllers\Client;

use App\Models\Brand;
use App\Models\Phone;
use Illuminate\Http\Request;
use App\Models\MarketingBanner;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $banners = MarketingBanner::select('id', 'name', 'description', 'image')
        ->whereNull('deleted_at')
        ->get();
        $brands = Brand::select('id', 'name')->get();
        $phones = Phone::whereNull('phones.deleted_at')->join('categories', 'categories.id', '=', 'phones.category_id')->select('phones.*', 'categories.name as category_name');
        $categories = DB::table('categories')->select('id', 'name')->get();
        if($request->q){
            $phones->where('phones.name', 'like', '%'.$request->q.'%');
        }

        if ($request->brand) {
            session(['selectedCheckbox' => $request->brand]);
    
            // Sử dụng điều kiện trực tiếp trong truy vấn Eloquent
            $phones->whereIn('brand_id', $request->brand);
        }else{
            session(['selectedCheckbox' => []]);
        }

        if($request->min_price){
            session(['min_price' => $request->min_price]);
            $phones->where('phones.price', '>=', $request->min_price);
        }
        if($request->max_price){
            session(['max_price' => $request->max_price]);
            $phones->where('phones.price', '<=', $request->max_price);
        }
        if(!$request->min_price){
            session(['min_price' => null]);
        }
        if(!$request->max_price){
            session(['max_price' => null]);
        }
   
        if($request->category){
            $phones->where('category_id', $request->category);
        }
        $phones = $phones->get();
        $selectedCheckbox = session('selectedCheckbox', []);

        return view('client.home', compact('banners', 'brands', 'phones', 'selectedCheckbox', 'categories'));
    }

}
