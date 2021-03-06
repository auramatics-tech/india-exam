<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Questions;
use App\Models\Questioncategories;
use App\Models\ImportantDate;
use App\Models\Announcement;
use App\Models\States;
use App\Models\BlogCategory;


class HomeController extends Controller
{
    public function index(request $request)
    {
        $categories = Category::when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }, function ($query) {
            $query->where('type', 'Category');
        })
            ->where('active', 1)->orderby("sort", 'asc')->get();

        $blogs = Blog::where('active', 1)->orderby('id','desc')->paginate(20);
        $important_dates = ImportantDate::where('active', 1)->orderby('id','desc')->get();
        $announcements = Announcement::where('active', 1)->orderby('id','desc')->get();
        $states= States::all();
        $blog_cats= BlogCategory::all();
        return view('frontend.home', compact('categories', 'blogs', 'important_dates', 'announcements','states','blog_cats'));
    }

    public function categories(Request $request)
    {
        $main_category = Category::where("slug", $request->category1)->first();
        if ($request->category2)
            $main_category = Category::where("slug", $request->category2)->first();
        if ($request->category3) {
            $category3 = Category::where("slug", $request->category3)->first();
            if ($category3->type == 'Topics') {
                $paginate = 5;
                $current_topic = $category3;
                $main_category = Category::where("slug", $request->category1)->first();
                $category2 = Category::where("slug", $request->category2)->first();
                $topics = Category::where(['type' => 'Topics', 'parent_id' => $category3->parent_id])->orderby('sort', 'asc')->get();
                $questions_id = Questioncategories::where(['topic_id' => $category3->id])->pluck('question_id')->toArray();
                $questions = Questions::whereIn('id', $questions_id)->where('active', 1)->paginate(5);
                return view('frontend.question', compact('questions', 'paginate', 'topics', 'current_topic', 'main_category', 'category2'));
            } else {
                $main_category = $category3;
            }
        }
        if ($request->category4) {
            $category4 = Category::where("slug", $request->category4)->first();
            if ($category4->type == 'Topics') {
                $paginate = 5;
                $current_topic = $category4;
                $topics = Category::where(['type' => 'Topics', 'parent_id' => $category4->parent_id])->orderby('sort', 'asc')->get();
                $questions_id = Questioncategories::where(['topic_id' => $category4->id])->pluck('question_id')->toArray();
                $questions = Questions::whereIn('id', $questions_id)->where('active', 1)->paginate(5);
                return view('frontend.question', compact('questions', 'paginate', 'topics', 'current_topic'));
            } else {
                $main_category = $category4;
            }
        }
        if ($request->category5) {
            $category5 = Category::where("slug", $request->category5)->first();
            if ($category3->type == 'Topics') {
                $paginate = 5;
                $current_topic = $category5;
                $topics = Category::where(['type' => 'Topics', 'parent_id' => $category5->parent_id])->orderby('sort', 'asc')->get();
                $questions_id = Questioncategories::where(['topic_id' => $category5->id])->pluck('question_id')->toArray();
                $questions = Questions::whereIn('id', $questions_id)->where('active', 1)->paginate(5);
                return view('frontend.question', compact('questions', 'paginate', 'topics', 'current_topic'));
            } else {
                $main_category = $category5;
            }
        }
        $subcategories = Category::where(['parent_id' => $main_category->id])->where('active', 1)->orderby("sort", 'asc')->get();
        $category = $main_category;
        return view('frontend.subcategories', compact('category', 'subcategories'));
    }
    public function blog_detail_page(Request $request)
    {
        $categories = Category::where('active', 1)->get();
        $blogs = Blog::where('slug',$request->blog_slug)->first();
        $important_dates = ImportantDate::where('active', 1)->orderby('id','desc')->get();
        $announcements = Announcement::where('active', 1)->orderby('id','desc')->get();
        $states= States::all();
        $blog_cats= BlogCategory::all();
        return view('frontend.blog_detail', compact('categories', 'blogs', 'important_dates', 'announcements','states','blog_cats'));
    }
    public function online_quiz(Request $request)
    {
        $categories = Category::where('active', 1)->get();
        $announcements = Announcement::where('active', 1)->get();
        return view('frontend.layouts.online_quiz', compact('categories', 'announcements'));
    }
    public function government_jobs(Request $request)
    {
        if(isset($request->state)){
            $state_id = States::where('state',$request->state)->first()->id;
        }else{
            $state_id = '';
        }
        if(isset($request->blog_cat)){
            $blog_cat = BlogCategory::where('name',$request->blog_cat)->first()->id;
        }else{
            $blog_cat = '';
        }
        $blogs = Blog::where('active', 1)
                ->when($request->state,function($query) use ($state_id){
                    $query->where('state', $state_id);
                })
                ->when($request->blog_cat,function($query) use ($blog_cat){
                    $query->where('blog_cat_id', $blog_cat);
                })->when($request->q,function($query) use ($request){
                    return $query->where('title', 'like', '%'.$request->q.'%');
                })->orderby('id','desc')->paginate(20);
        $important_dates = ImportantDate::where('active', 1)->get();
        $announcements = Announcement::where('active', 1)->get();
        $states= States::all();
        $blog_cats= BlogCategory::all();
        return view('frontend.layouts.government_jobs', compact('blogs', 'important_dates', 'announcements','states','blog_cats'));
    }
}
