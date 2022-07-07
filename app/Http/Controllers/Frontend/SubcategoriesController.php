<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Privacy;
Use File;

class SubcategoriesController extends Controller
{
    public function index($id)
    {
        $category = Category::Find($id);
        $subcategories = Category::where(['type' => 'Topics', 'parent_id' => $id])->orderby("sort", 'asc')->where('active', 1)->get();

        return view('frontend.topics', compact('subcategories', 'category'));
    }
    public function topics_with_cat($id)
    {
        $category = Category::Find($id);
        $topics = Category::where(['type' => 'subcategory', 'parent_id' => $id])->pluck('id');
        $subcategories = Category::wherein('parent_id', $topics)->orderby("sort", 'asc')->get();
        return view('frontend.topics', compact('subcategories', 'category'));
    }

    public function sub_categories($id)
    {
        $subcategories = Category::where(['parent_id' => $id])->where('active', 1)->orderby("sort", 'asc')->get();
        return view('frontend.subcategories', compact('subcategories'));
    }
    public function Terms_and_condition()
    {
        $privacy = Privacy::Find(1);
        return view('frontend.Terms_and_condition', compact('privacy'));
    }
    public function Privacy_Policy()
    {
        $privacy = Privacy::Find(1);
        return view('frontend.Privacy_Policy', compact('privacy'));
    }

    public function sitemap(){
        return File::get(public_path('sitemap.xml'));
    }
}
