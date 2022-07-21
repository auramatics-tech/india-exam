@extends('frontend.layouts.master')
@section('css')
<style>
    .slide {
        float: left;
        transform: translateX(400%);
        transition: all 7s;
    }

    .slide.active {
        transform: translateX(-350%);
    }
</style>
@endsection
@section('content')
<section class="si_sec_text su_height">
    @if(count($announcements))
    <div class="content si_announce_style si_marq_style">
        <marquee behavior="scroll" scrollamount="8" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="height: 30px;">
        @foreach($announcements as $announcement)
            <span><a href="{{route('blog_detail_page', $announcement->get_title->slug)}}" class="slide">
                {{ $announcement->title}}
            </a>
            </span>
            @endforeach
        </marquee>
    </div>
    @endif
    <div class="container mx-auto container_padding">
        <div class="row py-0 py-lg-3 py-md-3">
            <div class="col-lg-8 col-md-12 col-sm-12 shadow rounded">
                <div class="row px-2 bg-white">
                    <div class="py-3 si_heading1">
                        <h1 style="display: none">&nbsp;</h1>
                        <h5 class="su_clr_heading">Welcome to IndiaExamJunction.com !</h5>
                        <p class="text-dark">Here, you can practice Multiple Choice Questions for Competitive Exams.
                        </p>
                    </div>
                    @if (count($categories))
                    @foreach ($categories as $category)
                    @if (count($category->get_subcategory))
                    <div class="col-lg-6 col-md-6 col-sm-12 py-1">
                        <div class="si_heading">
                            <h5 class="si_border shadow mb-4 rounded mx-auto"><a href="{{ route('topics', ['id' => $category->id]) }}"></a>{{ $category->name }}
                            </h5>
                        </div>
                        <div class="si_background si_list">
                            <div class="d-flex">
                                <img src="{{ asset('frontend/images/question.png') }}" class="su_img_question" alt="question">
                                <ul class="list-unstyled su_circle">
                                    @foreach ($category->get_subcategory as $key => $val)
                                    @if ($key < 3) <li><i class="fas fa-angle-right"></i><a id="link1" href="{{ next_url($val) }}">{{ $val->name }}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                        <li>
                                            @if ($key > 2)
                                            <i class="fas fa-angle-right"></i><a class="text-decoration-underline" id="link1" href="{{ next_url($category) }}">Read
                                                more</a>
                                        </li>
                                        @endif
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