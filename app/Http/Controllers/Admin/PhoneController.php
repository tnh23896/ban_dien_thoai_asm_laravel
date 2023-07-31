<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneRequest;
use App\Models\Phone;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PhoneController extends Controller
{
  public function index() 
{
  $phones = DB::table('phones as p')
    ->whereNull('p.deleted_at')
    ->join('categories', 'categories.id', '=', 'p.category_id')->join('brands', 'brands.id', '=', 'p.brand_id')
    ->select('p.*', 'categories.name as category_name','brands.name as brand_name')
    ->paginate(5);
 
  return view('admin.phone.index', compact('phones'));
}
public function create(PhoneRequest $request)
{
  if($request->isMethod('get')) {

    $categories = DB::table('categories')->get();
    $promotions = DB::table('promotions')->get();
    $brands = DB::table('brands')->get();

    return view('admin.phone.create', compact('categories', 'promotions', 'brands'));

  }

  if($request->isMethod('post')) {

    $params = $request->except('_token');
    $params['image'] = uploadFile("images", $request->file('image'));

    Phone::create($params);

    Session::flash('success', 'Thêm mới thành công');
    return redirect()->route('admin.phone.index');
  
  }

}
public function edit(PhoneRequest $request, Phone $phone)
{
    if ($request->isMethod('get')) {
        // Nếu method là GET, thực hiện logic của function edit
        $categories = DB::table('categories')->get();
        $promotions = DB::table('promotions')->get();
    $brands = DB::table('brands')->get();
    return view('admin.phone.edit', compact('phone', 'categories', 'promotions', 'brands'));
    } elseif ($request->isMethod('post')) {
        // Nếu method là POST, thực hiện logic của function update
        $params = $request->except('_token');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $storageDL = Storage::delete("/public/" . $phone->image);
            if ($storageDL) {
                $params['image'] = uploadFile("images", $request->file('image'));
            }
        } else {
            $params['image'] = $phone->image;
        }
        $phone->update($params);
        Session::flash('success', 'Cập nhật thành công');
        return redirect()->route('admin.phone.index');
    }
}
  public function destroy(Phone $phone)
  {
    $phone->delete();
    Session::flash('success', 'Xóa thành công');
    return redirect()->back();
  }
}
