<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use App\Models\Category;
use App\Models\Questions;
use App\Models\Answers;
use App\Models\Questioncategories;
use Validator;
use Str;

class CategoriesController extends Controller
{


    public function categories($type, $id = '', $q = '', Request $request)
    {

        $categories = Category::where('type', $type)
            ->when($id, function ($query) use ($id) {
                $query->where("parent_id", $id);
            })
            ->when($request->q, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
            })
            ->orderby("sort", 'asc')
            ->get();

        $top_cat = '';
        if ($id)
            $top_cat = Category::find($id);


        return view('backend.categories.index', compact('categories', 'top_cat'));
    }

    public function index(Request $request)
    {
        if (isset($request->q)) {
            $categories = Category::where(['type' => 'Category'])->where('name', 'like', '%' . $request->q . '%')->get();
        } else {
            $categories = Category::where('type', 'Category')->get();
        }

        return view('backend.categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::where('type', 'Category')->get();
        $subcategories = Category::where('type', 'Subcategory')->get();
        $subcategories1 = Category::where('type', 'Subcategory1')->get();
        $subcategories2 = Category::where('type', 'Subcategory2')->get();

        return view('backend.categories.create', compact('categories', 'subcategories', 'subcategories1', 'subcategories2'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'slug' => 'required',
        ]);
        if (isset($request->id)) {
            $form = Category::find($request->id);
        } else {
            $form = new Category;
        }
        if ($request->type != 'Category') {
            if (isset($request->type) && $request->type == 'Subcategory') {
                $request->validate([
                    'parent_id' => 'required',
                    'slug' => 'required',
                ]);
                $form->parent_id = $request->parent_id;
            }

            if (isset($request->type) && ($request->type == 'Subcategory1')) {
                $request->validate([
                    'subcategory' => 'required',
                    'slug' => 'required',
                ]);
                $form->parent_id = $request->subcategory;
            }

            if (isset($request->type) && ($request->type == 'Subcategory2')) {
                $request->validate([
                    'subcategory1' => 'required',
                ]);
                $form->parent_id = $request->subcategory1;
            }

            if (isset($request->type) && $request->type == 'Topics') {
                $request->validate([
                    'subcategory' => 'required',
                    'slug' => 'required',
                ]);
                if (isset($request->subcategory1) && $request->subcategory2) {
                    $form->parent_id = $request->subcategory2;
                } elseif (isset($request->subcategory1) && $request->subcategory1) {
                    $form->parent_id = $request->subcategory1;
                } else {
                    $form->parent_id = $request->subcategory;
                }
            }
        } else {
            $form->parent_id = null;
        }
        $form->name = $request->name;
        $form->type = $request->type;
        $form->slug = $request->slug;
        $form->save();

        return redirect()->route('category_data',['type'=>$form->type]);
    }

    protected function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (count($allSlugs) == 0) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Category::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function edit(request $request)
    {

        $form = Category::find($request->id);
        $categories = Category::where('type', 'Category')->get();
        $subcategories = Category::where('type', 'Subcategory')->get();
        $subcategories1 = Category::where('type', 'Subcategory1')->get();
        $subcategories2 = Category::where('type', 'Subcategory2')->get();

        $data = array();
        if ($form->type != 'Category') {
            $topic_parent = Category::where('id', $form->parent_id)->first();
            if ($topic_parent->type == 'Subcategory2') {
                $data['subcategory2'] = $topic_parent;
                $data['subcategory1'] = Category::where('id', $topic_parent->parent_id)->where('type', 'Subcategory1')->first();
                $data['subcategory'] = Category::where('id', $data['subcategory1']->parent_id)->where('type', 'Subcategory')->first();
                $data['category'] = Category::where('id', $data['subcategory']->parent_id)->where('type', 'Category')->first();
            } else if ($topic_parent->type == 'Subcategory1') {
                $data['subcategory1'] = $topic_parent;
                $data['subcategory'] = Category::where('id', $topic_parent->parent_id)->where('type', 'Subcategory')->first();
                $data['category'] = Category::where('id', $data['subcategory']->parent_id)->where('type', 'Category')->first();
            } else if ($topic_parent->type == 'Subcategory') {
                $data['subcategory'] = $topic_parent;
                $data['category'] = Category::where('id', $data['subcategory']->parent_id)->where('type', 'Category')->first();
            }
        }

        return view('backend.categories.create', compact('categories', 'subcategories', 'subcategories1', 'subcategories2', 'form', 'data'));
    }

    public function delete(request $request)

    {
        $id = ($request->id);
        $form = Category::find($id)->delete();
        return back();
    }
    public function get_sub_cat(request $request)
    {
        $subcategories = Category::where(['type' => 'Subcategory'])->whereIn('parent_id', $request->cat)->get();
        return response($subcategories);
    }

    public function get_topics(request $request)
    {
        $type = isset($request->type) ? $request->type : 'topics';
        $topics = Category::where(['type' => ucfirst($type)])->whereIn('parent_id', $request->subcat)->get();
        return response($topics);
    }
    public function get_subcategories(Request $request)
    {
        $type = isset($request->type) ? $request->type : 'topics';
        $topics = Category::where(['type' =>'Subcategory'])->where('parent_id', $request->cat)->get();
        return response($topics);
    }

    public function get_subcategories1(Request $request)
    {
        $type = isset($request->type) ? $request->type : 'topics';
        $Subcategory1 = Category::where(['type' =>'Subcategory1'])->where('parent_id', $request->subcat)->get();
        return response($Subcategory1);
    }

    public function get_subcategories2(Request $request)
    {
        $type = isset($request->type) ? $request->type : 'topics';
        $Subcategory2 = Category::where(['type' =>'Subcategory2'])->where('parent_id', $request->subcat)->get();
        return response($Subcategory2);
    }


    public function show_subcategories(request $request, $id)
    {
        if (isset($request->q)) {
            $categories = Category::where(['type' => 'Subcategory'])->where('name', 'like', '%' . $request->q . '%')->get();
        } else {
            $categories = Category::where('type', '=', 'Subcategory')->where('parent_id', '=', $id)->get();
        }
        return view('backend.subcategories.index', compact('categories'));
    }

    public function show_topics(request $request, $id)
    {
        if (isset($request->q)) {
            $categories = Category::where(['type' => 'Topics'])->where('name', 'like', '%' . $request->q . '%')->get();
        } else {
            $categories = Category::where('type', '=', 'Topics')->where('parent_id', '=', $id)->get();
        }
        return view('backend.topics.index', compact('categories'));
    }
    public function topic_question_get(request $request)
    {
        $topic_id = $request->id;

        $questions = new Questions();
        $data['categories'] = Category::where('type', 'Category')->get();

        // get topic parent
        $data['topic'] = Category::find($topic_id);
        $topic_parent = Category::find($data['topic']->parent_id);
        if (isset($topic_parent->id) && !isset($request->question_id)) {
            if ($topic_parent->type == 'Subcategory2') {
                $data['subcategories2'] = $topic_parent;
                $data['all_topics'] = Category::where('parent_id', $data['subcategories2']->id)->where('type', 'Topics')->orderby('sort', 'asc')->get()->toArray();
            } else if ($topic_parent->type == 'Subcategory1') {
                $data['subcategories1'] = $topic_parent;
                $data['all_subcategories2'] = Category::where('parent_id', $data['subcategories1']->id)->where('type', 'Subcategory2')->get()->toArray();
                $data['all_topics'] = Category::where('parent_id', $data['subcategories1']->id)->where('type', 'Topics')->orderby('sort', 'asc')->get()->toArray();
            } else if ($topic_parent->type == 'Subcategory') {
                $data['subcategory'] = $topic_parent;
                $data['all_subcategories1'] = Category::where('parent_id', $data['subcategory']->id)->where('type', 'Subcategory1')->get()->toArray();
                $data['all_topics'] = Category::where('parent_id', $data['subcategory']->id)->where('type', 'Topics')->orderby('sort', 'asc')->get()->toArray();
            }

            if (!isset($data['subcategories1']) && isset($data['subcategories2'])) {
                $data['subcategories1'] = Category::find($data['subcategories2']->parent_id);
                $data['all_subcategories2'] = Category::where('parent_id', $data['subcategories1']->id)->where('type', 'Subcategory2')->orderby('sort', 'asc')->get()->toArray();
            }

            if (!isset($data['subcategory'])) {
                $data['subcategory'] = Category::find($data['subcategories1']->parent_id);
                $data['all_subcategories1'] = Category::where('parent_id', $data['subcategory']->id)->where('type', 'Subcategory1')->orderby('sort', 'asc')->get()->toArray();
            }
            $data['category'] = Category::find($data['subcategory']->parent_id);

            $data['subcategories'] = Category::where('parent_id', $data['category']->id)->get()->toArray();
            $topic = $data['topic'];

            $all_questions = array();
        } else {
            $topic = $data['topic'];
            unset($data['topic']);
            $questioncategories = Questioncategories::where('question_id', $request->question_id)->orderBy('id')->get();
            $questions = Questions::find($request->question_id);
            $data['subcategories'] = array();
            $data['all_subcategories1'] = array();
            $data['all_subcategories2'] = array();
            $data['all_topics'] = array();
            if (count($questioncategories)) {
                foreach ($questioncategories as $qst_cat) {
                    $data['selected_' . $qst_cat->type][] = $qst_cat->topic_id;
                    if ($qst_cat->type == 'category') {
                        $subcategories = Category::where('parent_id', $qst_cat->topic_id)->get();
                        $data['subcategories'] = array_merge($data['subcategories'], $subcategories->toArray());
                        $all_topics = Category::where('parent_id', $qst_cat->topic_id)->orderby('sort', 'asc')->where('type', 'Topics')->get();
                        $data['all_topics'] = array_merge($data['all_topics'], $all_topics->toArray());
                    }
                    if ($qst_cat->type == 'subcategory') {
                        $all_subcategories1 = Category::where('parent_id', $qst_cat->topic_id)->orderby('sort', 'asc')->where('type', 'Subcategory1')->get();
                        $data['all_subcategories1'] = array_merge($data['all_subcategories1'], $all_subcategories1->toArray());
                        $all_topics = Category::where('parent_id', $qst_cat->topic_id)->orderby('sort', 'asc')->where('type', 'Topics')->get();
                        $data['all_topics'] = array_merge($data['all_topics'], $all_topics->toArray());
                    }
                    if ($qst_cat->type == 'subcategory1') {
                        $all_subcategories1 = Category::where('parent_id', $qst_cat->topic_id)->where('type', 'Subcategory2')->orderby('sort', 'asc')->get();
                        $data['all_subcategories2'] = array_merge($data['all_subcategories2'], $all_subcategories1->toArray());
                        $all_topics = Category::where('parent_id', $qst_cat->topic_id)->where('type', 'Topics')->orderby('sort', 'asc')->get();
                        $data['all_topics'] = array_merge($data['all_topics'], $all_topics->toArray());
                    }
                    if ($qst_cat->type == 'subcategory2') {
                        $all_topics = Category::where('parent_id', $qst_cat->topic_id)->where('type', 'Topics')->orderby('sort', 'asc')->get();
                        $data['all_topics'] = array_merge($data['all_topics'], $all_topics->toArray());
                    }
                }
            }
            $all_questions = Questioncategories::where('topic_id', $topic->id)->orderBy('question_id','ASC')->pluck('question_id');
        }
         return view('backend.questions.questioncreate', compact('topic_id', 'data', 'questions', 'topic', 'all_questions'));
    }

    public function create_question($id)
    {
        $topicsId = Category::Find($id)->id;
        $topics_arr[] = $topicsId;

        $subcat_arr  = Category::whereIn('id', $topics_arr)->pluck('parent_id')->toarray();

        $cat_arr = Category::whereIn('id', $subcat_arr)->pluck('parent_id')->toarray();

        $categories = Category::where('type', 'Category')->get();
        $subcategories = Category::where('type', 'Subcategory')->whereIn('parent_id', $cat_arr)->get();
        $topics = Category::where('type', 'Topics')->whereIn('parent_id', $subcat_arr)->get();
        return view('backend.categories.questioncreate', compact('topics_arr', 'subcat_arr', 'cat_arr', 'categories', 'subcategories', 'topics'));
    }

    public function save_for_nav(Request $request)
    {
        $data = Category::find($request->ids);
        if ($request->cat_show == 1) {
            $data->is_navbar = 1;
        } else {
            $data->is_navbar = 0;
        }
        $data->save();
        return response('success');
    }
    public function cat_active_update(Request $request)
    {
        $cat = Category::find($request->cat_id);
        if ($request->status == 1) {
            $cat->active = 1;
        } else {
            $cat->active = 0;
        }

        $cat->save();
        return response('success');
    }

    public function cat_drag_drop(Request $request)
    {
        $data = $request->page_id_array;
        if (count($data)) {
            foreach ($data as $key => $category) {
                $cat =  Category::find($category);
                $cat->sort = $key + 1;
                $cat->save();
            }
        }
        return response()->json(['status' => 1]);
    }

    public function ckeditor_image(Request $request)
    {
        $target_dir = public_path('ckeditor_images');
        $file = $request->file('upload');
        if (isset($file) && $file != '') {
            $file_name = 'ckeditor' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($target_dir, $file_name);
        }
        $imgurl = asset('ckeditor_images/' . $file_name);
        $data = '<script>window.parent.CKEDITOR.tools.callFunction(1, "' . $imgurl . '", "Image uploaded successfully")</script>';
        echo json_encode(['uploaded'=>1,'fileName'=>$file_name,'url'=>$imgurl]);
    }
}
