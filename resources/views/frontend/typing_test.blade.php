@extends('frontend.layouts.master')
@section('content')
<section class="si_sec_text su_height">
    <div class="container mx-auto container_padding">
        <div class="row py-0 py-lg-3 py-md-3">
            <div class="col-lg-8 col-md-12 col-sm-12 shadow rounded">
                <div class="row px-2 bg-white">
                    <div class="py-3 si_heading1">
                        <h1 style="display: none">&nbsp;</h1>
                        <h5 class="su_clr_heading">Welcome to IndiaExamJunction.com !</h5>
                        <p class="text-dark">Here, you can practice English Mock Test Exercises.
                        </p>
                    </div>
                    @if(count($mock_categories))
                    @foreach($mock_categories as $mock_category)
                    @if(isset($mock_category->all_question) && count($mock_category->all_question))
                    <div class="col-lg-6 col-md-6 col-sm-12 py-1">
                        <div class="si_heading">
                            <h5 class="si_border shadow mb-4 rounded mx-auto"><a href=""></a>{{ucfirst($mock_category->name)}}</h5>
                        </div>
                        <div class="si_background si_list">
                            <div class="d-flex">
                                <img src="{{ asset('frontend/images/question.png') }}" class="su_img_question" alt="question">
                                <ul class="list-unstyled su_circle">
                                    @foreach($mock_category->all_question as $key => $mock_test)
                                    <li><i class="fas fa-angle-right"></i><a href="{{route('mock_test', $mock_test->id)}}">Practice Exercise {{++$key}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
        </div>
</section>
@endsection