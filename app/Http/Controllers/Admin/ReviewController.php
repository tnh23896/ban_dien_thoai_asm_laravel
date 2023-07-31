<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phone;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::join('phones', 'reviews.phone_id', '=', 'phones.id')->join('users', 'reviews.user_id', '=', 'users.id')->select('reviews.*', 'phones.name as phone_name', 'users.name as user_name')
        ->paginate(5);
        return view('admin.review.index', compact('reviews'));
    }
}
