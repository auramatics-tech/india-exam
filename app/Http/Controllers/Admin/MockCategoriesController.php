<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MockTestCategory;
use App\Models\MockTest;

class MockCategoriesController extends Controller
{
    
    public function categories(Request $request)
    {

        $categories = MockTestCategory::when($request->q, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
            })
            ->orderby("id", 'desc')
            ->get();


        return view('backend.mock_categories.index', compact('categories'));
    }

    public function index(Request $request)
    {
        if (isset($request->q)) {
            $categories = MockTestCategory::where('name', 'like', '%' . $request->q . '%')->orderby('id','desc')->get();
        } else {
            $categories = MockTestCategory::orderby('id','desc')->get();
        }

        return view('backend.mock_categories.index', compact('categories'));
    }

    public function create(Request$request)
    {
        
        $categories = MockTestCategory::orderby('name','asc')->get();

        return view('backend.mock_categories.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        if (isset($request->id)) {
            $form = MockTestCategory::find($request->id);
        } else {
            $form = new MockTestCategory;
        }
        $form->name = $request->name;
        $form->slug = $request->slug;
        $form->save();

        return redirect()->route('mock.category_data');
    }

    
    public function edit(Request $request)
    {
        $form = MockTestCategory::find($request->id);
        return view('backend.mock_categories.create', compact('form'));
    }

    public function mock_active_update(Request $request)
    {
        $cat = MockTestCategory::find($request->cat_id);
        if ($request->status == 1) {
            $cat->active = 1;
        } else {
            $cat->active = 0;
        }

        $cat->save();
        return response('success');
    }

    public function mock_test($id = '',Request $request)
    {
        $category_id = $id;
        $mock_test = "";
        $mock_test_array = MockTest::where('cat_id',$category_id)->orderby('id','asc')->pluck('id')->toArray();

        // get topic parent
        $category = MockTestCategory::find($category_id);
        if (isset($category->id) && !isset($request->mock_test_id)) {
            $mock_test = new MockTest;
        }
        else 
        {
            $mock_test = MockTest::find($request->mock_test_id);
        }
        return view('backend.mock_categories.mock_test', compact('mock_test','mock_test_array','category','category_id'));
    }

    public function mock_test_save(Request $request)
    {
        if($request->id)
        {
            $mock_test = MockTest::find($request->id);
        }
        else
        {
            $mock_test = new MockTest;
        }
        $mock_test->text = $request->text;
        $mock_test->time = $request->time;
        $mock_test->cat_id = $request->category_id;
        $mock_test->save();
        return back()->with('success','Mock add or edit successfully');
    }

    public function mock_test_delete(Request $request)
    {
        $id = ($request->id);
        $mock_test = MockTest::find($id);
        $cat_id = $mock_test->cat_id;
        $mock_test->delete();
        return redirect()->route('admin.mock_test',['id'=>$cat_id])->with('success','Mock deleted successfully');
    }
}