@extends('frontend.layouts.master')
@section('content')
<section class="su_height">
    <div class="container py-4 container_padding">
        <div class="col-lg-8 col-12">
            <div class="si_bg_style bg-white shadow rounded p-3 px-4">
                <div class="py-2">
                    <span><img class="img-fluid" src="{{asset('frontend/images/logophotoshop.jpg')}}" height="30"
                            width="30"></span>
                    <span class="ml-4 india_exam">India Exam Junction</span>
                </div>
                <div class="py-2 si_ck_img">
                    <p>{!! $question->question !!}</p>
                    <ol class="list-unstyled">

                        @if(count($question->get_answers))
                        @foreach($question->get_answers as $key => $val)
                        <li>{!! $val->answers !!}</li>
                        @endforeach
                        @endif
                    </ol>
                    <p><u>Correct Answer :</u>{!! isset($question->get_correct_answer->answers) ? $question->get_correct_answer->answers : '' !!}</p>

                </div>
                <div class="si_bg_style1 p-3 shadow rounded border">
                    <h5 class="text-center"><u>Solution</u></h5>
                    <p>{!! $question->solution !!} </p>
                   
                </div>
            </div>
            <div class="py-4">
                <div class="border-none shadow rounded py-4 si_diss_head px-4 bg-white">
                    <h5 class="border-bottom india_exam pb-3">Join The Discussion</h5>
                    <div>
                        <!-- <form action="{{route('discussions_form_save')}}" method="post">
                            @csrf
                            <input type="hidden" name="question_id" value="{{$question->id}}">
                            <label class="py-2" for="fname"><b>Name :</b></label><br>
                            <input class="si_text_content" type="text" id="fname" name="name"><br>
                            <label class="py-2" for="lname"><b>E-mail :</b></label><br>
                            <input class="si_text_content" type="text" id="lname" name="email"><br>
                            <label for="comment" class="Required py-2"><b>Comment*</b></label>
                            <textarea rows="5" cols="5" aria-required="true" name="comments" id="comment"
                                class="si_text_content"></textarea>
                            <div class="text-right py-5">
                                <button type="submit" value="Submit" class="si_button shadow rounded"><b>Post Your
                                        Comment</b></button>
                        </form> -->
                        <form action="{{route('discussions_form_save')}}" method="post">
                        @csrf
                        <input type="hidden" name="question_id" value="{{$question->id}}">
  <div class="form-group row pt-3">
    <label for="fname" class="col-sm-2 col-form-label">Name :</label>
    <div class="col-sm-10">
      <input class="form-control" type="text" id="fname" name="name" placeholder="Name">
    </div>
  </div>
  <div class="form-group row pt-3">
    <label for="lname" class="col-sm-2 col-form-label">E-mail :</label>
    <div class="col-sm-10">
      <input class="form-control" type="text" id="email" name="email" placeholder="E-mail">
    </div>
  </div>
  <div class="form-group row pt-3">
  <label for="comment" class=" col-sm-2 col-form-label">Comment:</label>
    <div class="col-sm-10">
    <textarea rows="5" cols="5" type="text" aria-required="true" name="comments" id="comment"
                                class="si_text_content form-control"></textarea>
    </div>
  </div>
  <div class="form-group row pt-3">
    <div class="col-sm-12 su_form">
      <button type="submit" type="submit" value="Submit" class="si_button shadow rounded">Post Your Comment</button>
    </div>
  </div>
</form>
                    </div>
                </div>
            </div>
        <div class="py-4 shadow rounded border-none px-4 si_diss_head bg-white">
            <h5 class="border-bottom india_exam py-3">Comments ({{count($comments)}})</h5>
            @if(count($comments))
            @foreach($comments as $key => $val)
            <div class="border-bottom py-3 d-flex">
                <div><img src="{{asset('frontend/images/logo_punjab (3) (1).png')}}" class="si_img"></div>
                <div class="si_comment">
                    <p><b>{{$val->name}} :</b>{{$val->created_at->diffForHumans() }}</p>
                    <p>{{$val->comments}}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    </div>
</section>
@endsection