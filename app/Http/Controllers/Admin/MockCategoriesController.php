<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MockTestCategory;
use App\Models\MockTest;

class MockCategoriesController extends Controller
{
    
    public function categories($type, $id = '', $q = '', Request $request)
    {

        $categories = MockTestCategory::where('type', $type)
            ->when($id, function ($query) use ($id) {
                $query->where("parent_id", $id);
            })
            ->when($request->q, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
            })
            ->orderby("id", 'desc')
            ->get();

        $top_cat = '';
        if ($id)
            $top_cat = MockTestCategory::find($id);


        return view('backend.mock_categories.index', compact('categories', 'top_cat'));
    }

    public function index(Request $request)
    {
        if (isset($request->q)) {
            $categories = MockTestCategory::where(['type' => 'Category'])->where('name', 'like', '%' . $request->q . '%')->orderby('id','desc')->get();
        } else {
            $categories = MockTestCategory::where('type', 'Category')->orderby('id','desc')->get();
        }

        return view('backend.mock_categories.index', compact('categories'));
    }

    public function create(Request$request)
    {
        
        $categories = MockTestCategory::where('type', 'Category')->orderby('name','asc')->get();

        return view('backend.mock_categories.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'slug' => 'required',
        ]);
        if (isset($request->id)) {
            $form = MockTestCategory::find($request->id);
        } else {
            $form = new MockTestCategory;
        }
        if ($request->type != 'Category') {
            if (isset($request->type) && $request->type == 'Subcategory') {
                $request->validate([
                    'parent_id' => 'required',
                    'slug' => 'required',
                ]);
                $form->parent_id = $request->parent_id;
            }
        } else {
            $form->parent_id = null;
        }
        $form->name = $request->name;
        $form->type = $request->type;
        $form->slug = $request->slug;
        $form->save();

        return redirect()->route('mock.category_data',['type'=>$form->type]);
    }

    
    public function edit(Request $request)
    {
        $form = MockTestCategory::find($request->id);
        $categories = MockTestCategory::where('type', 'Category')->get();

        $data = array();
        if ($form->type != 'Category') {
            $topic_parent = MockTestCategory::where('id', $form->parent_id)->first();
             if ($topic_parent->type == 'Subcategory') {
                $data['subcategory'] = $topic_parent;
                $data['category'] = MockTestCategory::where('id', $data['subcategory']->parent_id)->where('type', 'Category')->first();
            }
        }
        return view('backend.mock_categories.create', compact('categories', 'form', 'data'));
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
        $sub_category_id = $id;
        $mock_test = "";
        $mock_test_array = MockTest::where('sub_cat_id',$sub_category_id)->orderby('id','asc')->pluck('id')->toArray();

        // get topic parent
        $subcategory = MockTestCategory::find($sub_category_id);
        $category = MockTestCategory::find($subcategory->parent_id);
        if (isset($category->id) && !isset($request->mock_test_id)) {
            $mock_test = new MockTest;
        }
        else 
        {
            $mock_test = MockTest::find($request->mock_test_id);
        }
        return view('backend.mock_categories.mock_test', compact('mock_test','mock_test_array','subcategory','sub_category_id'));
    }

    public function mock_test_save(Request $request)
    {
        $subcategory = MockTestCategory::find($request->subcategory_id);
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
        $mock_test->sub_cat_id = $request->subcategory_id;
        $mock_test->cat_id = $subcategory->parent_id;
        $mock_test->save();
        return back()->with('success','Mock add or edit successfully');
    }

    public function mock_test_delete(Request $request)
    {
        $id = ($request->id);
        $mock_test = MockTest::find($id);
        $sub_cat_id = $mock_test->sub_cat_id;
        $mock_test->delete();
        return redirect()->route('admin.mock_test',['id'=>$sub_cat_id])->with('success','Mock deleted successfully');
    }
}