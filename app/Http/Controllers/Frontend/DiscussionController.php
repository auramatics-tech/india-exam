<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Discussions;

class DiscussionController extends Controller
{
public function index($id){
    $question = Questions::where('id',$id)->first();
    $comments= Discussions::where('question_id', $id)->where('approved',1)->get();
    //  echo "<pre>";print_r($question);die;
    return view('frontend.discussions',compact('question','comments'));
}

public function form_save(Request $request){
    $form= new Discussions;
    $form->name=$request->name;
    $form->question_id=$request->question_id;
    $form->email=$request->email;
    $form->comments=$request->comments;
    $form->save();

    return back()->with('success', 'Product created successfully.');
}
}
