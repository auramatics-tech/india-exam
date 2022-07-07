<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Questions;
use App\Models\Questioncategories;


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
        return view('frontend.home', compact('categories'));
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
                $topics = Category::where(['type' => 'Topics', 'parent_id' => $category3->parent_id])->orderby('sort','asc')->get();
                $questions_id = Questioncategories::where(['topic_id' => $category3->id])->pluck('question_id')->toArray();
                $questions = Questions::whereIn('id', $questions_id)->where('active', 1)->paginate(5);
                return view('frontend.question', compact('questions', 'paginate', 'topics','current_topic','main_category','category2'));
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
}
