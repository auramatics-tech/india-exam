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

class QuestionsController extends Controller
{

    public function index()
    {
        ini_set('max_execution_time', '300');
        $questions = Questions::all();
        return view('backend.questions.index', compact('questions'));
    }
    public function create()
    {
        $categories = Category::where('type', 'Category')->get();
        return view('backend.questions.create', compact('categories'));
    }

    public function store(request $request)
    {
        $this->validate($request,[
            'type'=>'required'
         ]);
        // echo"<pre>";print_r($request->all());die;
        if (isset($request->id)) {
            $delete= Answers::where('question_id',$request->id)->delete();
            $Questioncategories= Questioncategories::where('question_id',$request->id)->delete();
            $form = Questions::find($request->id);
        } else {
            $form = new Questions;
        }
        // $form->category = $request->category;
        // $form->subcategory = $request->subcategory;
        // $form->topics = $request->topics;
        $form->type = $request->type;
        $form->question = $request->question;
        $form->solution = $request->solution;
        $form->save();

        if(count($request->category)){
            foreach($request->category as $k => $v){
                if(isset($v))
                {
                    $data = new Questioncategories;
                    $data->question_id = $form->id;
                    $data->topic_id = $v;
                    $data->type = 'category';
                    $data->save();
                }
            }
        }

        if(isset($request->subcategory) && count($request->subcategory)){
            foreach($request->subcategory as $k => $v){
                if(isset($v))
                {
                    $data = new Questioncategories;
                    $data->question_id = $form->id;
                    $data->topic_id = $v;
                    $data->type = 'subcategory';
                    $data->save();
                }
            }
        }

        if(isset($request->subcategory1) && count($request->subcategory1)){
            foreach($request->subcategory1 as $k => $v){
                if(isset($v))
                {
                    $data = new Questioncategories;
                    $data->question_id = $form->id;
                    $data->topic_id = $v;
                    $data->type = 'subcategory1';
                    $data->save();
                }
            }
        }
        if(isset($request->subcategory2) && count($request->subcategory2)){
            foreach($request->subcategory2 as $k => $v){
                if(isset($v))
                {
                    $data = new Questioncategories;
                    $data->question_id = $form->id;
                    $data->topic_id = $v;
                    $data->type = 'subcategory2';
                    $data->save();
                }
            }
        }

        if(isset($request->topics) && count($request->topics)){
            foreach($request->topics as $k => $v){
                if(isset($v))
                {
                    $data = new Questioncategories;
                    $data->question_id = $form->id;
                    $data->topic_id = $v;
                    $data->type = 'topics';
                    $data->save();
                }
            }
        }
        $loop = $request->answers;
        if(isset($loop) && count($loop)){
        foreach ($loop as $key => $value) {
            $save_answers = new Answers;
            $save_answers->is_corrected = isset($request->is_correct[$key][0]) ? $request->is_correct[$key][0] : 0;
            $save_answers->answers = $value;
            $save_answers->question_id = $form->id;
            $save_answers->save();
        }
    }
        return redirect("/admin/question/$request->previous_id?question_id=$form->id");
    }

    public function edit(request $request)
    {
        
        $questions = Questions::find($request->id);
        $topics_arr = Questioncategories::where('question_id',$request->id)->pluck('topic_id')->toarray();
        $subcat_arr  = Category::whereIn('id',$topics_arr)->pluck('parent_id')->toarray();
        $cat_arr = Category::whereIn('id',$subcat_arr)->pluck('parent_id')->toarray();

        $categories = Category::where('type', 'Category')->get();
        $subcategories = Category::where('type', 'Subcategory')->whereIn('parent_id',$cat_arr)->get();
        $topics = Category::where('type', 'Topics')->whereIn('parent_id',$subcat_arr)->get();
       
        return view('backend.questions.create', compact('categories', 'questions','cat_arr','subcategories','topics','topics_arr','subcat_arr'));
    }

    public function delete(Request $request)
    {
        $id = ($request->id);
        // $category_id = Questioncategories::where(['question_id'=>$id,'type'=>'category'])->pluck('topic_id');
        $topics = Questioncategories::where(['question_id'=>$id,'type'=>'topics'])->first();
        $ques_cat = Questioncategories::where('question_id',$id)->delete();
        $form = Questions::find($id)->delete();
        // if(isset($topics->topic_id) && isset($next_question->question_id)){
        //     $next_question = Questioncategories::where('topic_id',$category_id)->orderBy('question_id','ASC')->first();
        //     return redirect()->route('admin.questioncat',['id'=>$topics->topic_id,'question_id'=>$next_question->question_id]);
        // }else{
        //     return redirect()->route('admin.questioncat',['id'=>$topics->topic_id]);
        // }
        return redirect()->route('admin.questioncat',['id'=>$topics->topic_id]);
        
    }
    public function active_update(Request $request){
        $ques = Questions::find($request->que_id);
        if($request->status == 1){
            $ques->active = 1;
        }else{
            $ques->active = 0;
        }
        $ques->save();
        return response('success','Data Updated successfully!');
    }
    public function add_mutliple_questions(Request $request)
    {
        $questions = Questions::where('active',1)->orderby('id','desc')->get();
        $categories = Category::where(['type'=> 'Category','active'=>1])->orderby('sort','asc')->get();
        return view('backend.questions.add_mutliple_questions', compact('questions', 'categories'));
    }
    public function save_mutliple_questions(Request $request)
    {
        if(!isset($request->question))
        {
            return back()->with('errors','Please select atleast 1 question');
        }
        $category = Category::find($request->category);
        $sub_categories = Category::where(['type'=>'Subcategory','parent_id'=>$category->id,'active'=>1])->get();
        if(count($sub_categories))
        {
            foreach($sub_categories as $subcategory)
            {
                $sub_categories1 = Category::where(['type'=>'Subcategory1','parent_id'=>$subcategory->id,'active'=>1])->get();
                if(count($sub_categories1))
                {
                    foreach($sub_categories1 as $sub_category1)
                    {
                        $sub_categories2 = Category::where(['type'=>'Subcategory2','parent_id'=>$sub_category1->id,'active'=>1])->get();
                        if(count($sub_categories2))
                        {
                            foreach($sub_categories2 as $sub_category2)
                            {
                                $topic = Category::where(['type'=>'Topics','parent_id'=>$sub_category2->id,'active'=>1])->first();
                                if(isset($topic->id))
                                {
                                    break;
                                }
                            }
                        }
                        else
                        {
                            $topic = Category::where(['type'=>'Topics','parent_id'=>$subcategory->id,'active'=>1])->first();
                            if(isset($topic->id))
                            {
                                break;
                            }
                        }
                    }
                }
                else
                {
                    $topic = Category::where(['type'=>'Topics','parent_id'=>$subcategory->id,'active'=>1])->first();
                    if(isset($topic->id))
                    {
                        break;
                    }
                }
            }
        }

        $questions = $request->question;
        if(count($questions))
        {
            foreach($questions as $question)
            {
                $questioncategories = new Questioncategories;
                $questioncategories->topic_id = $request->category;
                $questioncategories->question_id = $question;
                $questioncategories->type = 'category';
                $questioncategories->save();
                if(isset( $topic->id))
                {
                    $questioncategories = new Questioncategories;
                    $questioncategories->topic_id = $topic->id;
                    $questioncategories->question_id = $question;
                    $questioncategories->type = 'topics';
                    $questioncategories->save();
                }
            }
        }
        return back()->with('success','Questions successfully added.');
    }
}
