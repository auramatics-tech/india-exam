<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Answers;
use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Questioncategories;
use App\Models\Category;

class QuestionsAnswerController extends Controller
{
    public function index($id){
        $paginate = 5;
        $topic = Category::Find($id);
        $topics=Category::where(['type'=>'topics','parent_id'=>$topic->parent_id])->get();
        $questions_id = Questioncategories::where(['topic_id'=>$id])->pluck('question_id')->toArray();
        $questions = Questions::whereIn('id',$questions_id)->where('active',1)->paginate(5);
        return view('frontend.question',compact('questions','paginate','topics'));
    }

    public function check_ans(Request $request){
      $answers=Answers::where(['question_id'=>$request->qst, 'id'=>$request->ans])->first();
      return response($answers);
      }
}