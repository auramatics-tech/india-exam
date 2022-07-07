@extends('frontend.layouts.master')

@section('content')

<style>
    .su_shift_ques .si_check {

        display: flex;

    }

    .si_heading1 {

        text-align: left;

    }
    .su_paragraph_set{
        width: 100%;
    }
   

</style>

<section class="su_height">

    <div class="container container_padding">

        <div class="row">

            <div class="col-lg-8 col-md-12 col-sm-12 su_col_padding shadow mt-4 rounded bg-white px-4">

                <div class="text-center">

                    <h5 class="si_heading1"> <a href="{{ next_url($main_category) }}">{{ $main_category->name }}</a>

                    </h5>

                    <hr>

                    <div>

                        <h5 class="si_heading1"><a href="{{ route('home') }}">Home</a> » 
                        <a href="{{ next_url(get_family($category2->id)['subcategory']) }}">{{get_family($category2->id)['subcategory']->name}}</a> » 
                        @if(isset(get_family($category2->id)['subcategory1']->name))
                        <a href="{{ next_url(get_family($category2->id)['subcategory1']) }}">{{get_family($category2->id)['subcategory1']->name }}</a> » 
                        @endif
                        @if(isset(get_family($category2->id)['subcategory2']->name))
                        <a href="{{ next_url(get_family($category2->id)['subcategory2']) }}">{{get_family($category2->id)['subcategory2']->name}}</a>
                        @endif
                    </h5>
                    </div>
                    @if (count($topics))

                    @foreach ($topics as $key => $topic)
                    @if (count($topic->get_topic_subcategory))

                    @if ($topic->slug == $current_topic->slug)
                    
                    <a class="text-center" href="{{ next_url($topic) }}"><button class="btn su_discuss shadow my-2 mx-1">{{ $topic->name }}</button></a>

                    @else

                    <a class="text-center" href="{{ next_url($topic) }}"><button class="btn bg-white su_discuss_2 shadow my-2 mx-1">{{ $topic->name }}</button></a>

                    @endif

                    @endif

                    @endforeach

                    @endif

                </div>

            </div>

            <div class="col-lg-4 col-md-12 col-sm-12"></div>

        </div>

        @if (count($questions))

        @php

        $srno = 1;

        if (isset(request()->page)) {

        $srno = (request()->page - 1) * $paginate + 1;

        }

        @endphp

        @foreach ($questions as $q_key => $question)

        <div class="row pb-1">

            <div class="col-lg-8 col-md-12 col-sm-12 su_col_padding shadow mt-4 rounded bg-white px-4">

                <div>

                    <form action="" class="su_form_padding">

                        <div class="d-flex">

                            <!-- <span class="mt-1">{{ $srno }}</span> -->

                            <span class="su_shift_ques su_paragraph_set">

                                <b>{!! $question->question !!}</b>

                            </span>

                        </div>

                        <div class="su_shift_ques">

                            @if ($question->type == 2)

                            @if (count($question->get_answers))

                            @foreach ($question->get_answers as $key => $val)

                            <span id="answer_chb_{{ $val->id }}" class="si_display d-flex">

                                <input type="radio" id="html_{{ $key }}_{{ $q_key }}" class="answers si_margin_style" name="fav_language" value="{{ $val->id }}" data-qst="{{ $question->id }}">

                                <label for="html_{{ $key }}_{{ $q_key }}" class="si_check answers_value px-2"> {!! $val->answers !!} <span id="response_{{ $val->id }}" class="wrong_right"></span></label><br>

                            </span>

                            @endforeach

                            @endif

                            @else

                            @if (count($question->get_answers))

                            @foreach ($question->get_answers as $key => $val)

                            <span id="answer_chb_{{ $val->id }}" class="d-flex">

                                <input type="checkbox" id="{{ $q_key }}_html_{{ $key }}" class="answers si_margin_style" name="fav_language" value="{{ $val->id }}" data-qst="{{ $question->id }}">

                                <label for="{{ $q_key }}_html_{{ $key }}" class="si_check px-2"> {!! $val->answers !!} <span id="response_{{ $val->id }}" class="wrong_right"></span></label><br>

                            </span>

                            @endforeach

                            @endif

                            @endif

                        </div>

                    </form>

                    <div>

                        <div class="accordion si_button_content" id="accordionExample">

                            <div class="accordion-item su_cut_border text-center">

                                <div class="accordion-header d-flex justify-content-center si_float_style" id="headingOne">

                                    <button class="accordion-button answer_solution su_btn_drop shadow my-2 text-center collapsed" style="border-radius: unset;" data-id="{{ $question->id }}" type="button">Answer &

                                        Solution</button>

                                    <a href="{{ route('discussions', $question->id) }}"><button class="btn su_discuss shadow my-2">Discuss in

                                            Board</button></a>

                                    <!-- <a href="{{ route('discussions', $question->id) }}"><button>

                                        <button class="btn su_save  shadow rounded my-2">Save for Later</button> -->

                                </div>

                            </div>

                        </div>

                        <div id="collapseOne_{{ $question->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="border-radius: unset;">

                            <div class="accordion-body">

                                <div class="su_make_border">

                                    <div class="si_border_content1 ">

                                        <div class="su_drop_ans_set"><b>Answer & Solution</b></div>

                                        <hr class="su_set_hr">

                                        <div class="su_drop_ans ques_solution">Answer:

                                            {!! isset($question->get_correct_answer->answers) ? $question->get_correct_answer->answers : '' !!}

                                        </div>
                                        @if($question->solution)
                                        <div class="su_drop_sol ques_solution">Solution:<p>{!! $question->solution !!}</p>

                                        </div>
                                        @endif
                                    </div>



                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        @php

        $srno += 1;

        @endphp

        @endforeach

        @endif

        <div class="row">

            <div class="col-lg-8 col-12 su_paginate">

                {{ $questions->links('frontend.layouts.pagination') }}



            </div>

        </div>

    </div>

</section>

@endsection

@section('script')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>

<script>
    $(document).on('click', '.answers', function() {

        console.log('here');

        var ans = $(this).val();

        var qst = $(this).attr('data-qst');



        $.ajax({

            url: "{{ route('check_ans') }}",

            method: 'POST',

            data: {

                ans: ans,

                qst: qst,

                "_token": "{{ csrf_token() }}"

            },

            success: function(data) {

                var html_check =

                    '<i id="true" class="fas fa-check" style="color:green; margin-left:15px;"></i>';

                var html_cross =

                    '<i id="false" class="fas fa-times" style="color:red; margin-left:15px;"></i>';

                if (data.is_corrected == 1) {

                    $('#response_' + ans).html(html_check)

                } else {

                    $('#response_' + ans).html(html_cross)

                    $('#answer_chb_' + ans).css("opacity", "0.2");

                }

            }

        })

    });

    $(document).on('click', '.answer_solution', function() {

        var qid = $(this).attr('data-id');

        $('#collapseOne_' + qid).toggle();

    })
</script>

@endsection