<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Questions;
use App\Models\Questioncategories;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index( Request $request){
        $categories = Category::when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }, function ($query) {
            $query->where('type', 'Category');
        })
            ->where('active', 1)->orderby("sort", 'asc')->get();
        return view('frontend.search' ,compact('categories'));
    }
}
