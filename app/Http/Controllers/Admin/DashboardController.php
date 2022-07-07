<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use App\Models\Category;
use App\Models\Questions;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::where('type', 'Category')->count();
        $subcategories = Category::where('type', 'Subcategory')->count();
        $topics = Category::where('type', 'Topics')->count();
        $questions = Questions::all()->count();
        return view('backend.dashboard', compact('categories','subcategories','topics','questions'));                                                               
    }
}
