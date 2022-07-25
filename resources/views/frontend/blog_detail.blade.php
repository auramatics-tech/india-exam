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
<section class="pt-2">
@if(count($announcements))
    <div class="content si_announce_style si_marq_style">
        <marquee behavior="scroll" scrollamount="15" width="100%"   direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="height: 30px;line-height:30px;">
        @foreach($announcements as $announcement)
            <span><a href="{{route('blog_detail_page', $announcement->get_title->slug)}}" class="slide">
                {{ $announcement->title}}
            </a>
            </span>
            @endforeach
        </marquee>
    </div>
    @endif
</section>
<section class="si_sec_text su_height">
    <div class="container-fluid px-4">
        <div class="py-0 py-lg-3 py-md-3">
            <div class="shadow rounded">
                <div class="row px-2 bg-white">
                    <div class="py-3 si_heading1">
                        <h1 style="display: none">&nbsp;</h1>
                        <h5 class="su_clr_heading">Welcome to IndiaExamJunction.com !</h5>
                        <p class="text-dark">Here, you can read blogs information in brief.
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 py-1 pb-4">
                        @if (count($categories))

                        <div id="accordion" class="">
                            @foreach ($categories as $k => $category)
                            @if (count($category->get_subcategory))
                            <div class="si_heading" id="heading{{$k}}">
                                <h5 class="si_border1 shadow mb-4 mx-auto"> <button class="d-flex align-items-left justify-content-between w-100 btn text-white collapsed" data-toggle="collapse" data-target="#collapse{{$k}}" aria-expanded="false" aria-controls="collapse{{$k}}"><a href="{{ route('topics', ['id' => $category->id]) }}"></a>{{ $category->name }} <span>
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span></button>
                                </h5>
                            </div>
                            <div class="si_background si_list collapse" id="collapse{{$k}}" aria-labelledby="heading{{$k}}" data-parent="#accordion">
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
                            @endif
                            @endforeach

                        </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 py-1">
                        <div class="si_heading pb-4">
                            <h5 class="si_border shadow mb-2 mx-auto text-center">{{$blogs->title}}</h5>
                            {{--<h5 class="py-2 mx-auto text-center border-bottom text-dark">{{$blogs->title}}</h5>--}}
                            <div class="pt-3 text-dark">
                                {{--<p class="text-muted"><a href="">{{date('d M Y',strtotime( $blogs->created_at)) }}</p>--}}
                                <h4 class="pt-3 text-dark">{{$blogs->title}}</h4>
                                <p class="pt-2 text-dark">{{$blogs->thumbnail_description}}</p>
                            </div>
                            <div class="pt-3 text-dark">
                                {!! $blogs->description !!}
                            </div>
                            <div class="pt-3 text-dark">
                                @if(isset($blogs->blog_pdf))
                                <p class="text-center si_bg_light text-dark"><b>Official Notification</b></p>
                                <div class="py-3 text-center">
                                    <a target="_blank" href="{{asset('blog/pdf/'.$blogs->blog_pdf)}}"><button class="si_mock_btn bg-danger border none rounded p-1" type="submit">Download <i class="fa fa-download" aria-hidden="true"></i></button></a>
                                </div>
                                @endif
                                @if(count($blogs->get_links))
                                <div class="py-3 text-dark">
                                    <p class="text-center si_bg_light"><b>Important Links</b></p>
                                </div>
                                <div class="py-2 border p-3 text-dark">
                                    <p class="pt-2">IMPORTANT LINKS :</p>
                                    @foreach($blogs->get_links as $key => $val)
                                    <a class="pt-2" href="{{$val->link}}">
                                        <h5><u>{{$val->title}}</u></h5>
                                    </a>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 py-1">
                        <div class="si_heading pb-4">
                            <h5 class="si_border shadow mb-2 mx-auto text-center">STATE JOBS</h5>
                            <h5 class="py-2 mx-auto text-center border-bottom text-dark">STATES</h5>
                        </div>
                        <div class="si_left_styling">
                            {{--<h5 class="pt-3">IMPORTANT DATES</h5>
                            <div class="d-flex">
                                <div class="input-icon">
                                    <input type="text" class="form-control search_radius" value="" name="" placeholder="Search..." id="" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                                <div>
                                    <button type="submit" class="btn si_btn_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>--}}
                            <ul class="list-unstyled">
                                @if(count($states))
                                @foreach($states as $state)
                                @if(count(jobsinstate($state->id)))
                                <a href="{{route('blog_detail_page', $state->state)}}">
                                    <li class="py-2"><i class="fa fa-angle-right" aria-hidden="true"></i> {{ isset($state->state)?$state->state:'' }}</li>
                                </a>
                                @endif
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="si_heading pb-4">
                            <h5 class="si_border shadow mb-2 mx-auto text-center">Other JOBS</h5>
                        </div>
                        <div class="si_left_styling">
                            <ul class="list-unstyled ul_hover">
                                @if(count($states))
                                @foreach($blog_cats as $blog_cat)
                                @if(count(jobsinblogcat($blog_cat->id)))
                                <a href="{{route('government_jobs', ['blog_cat' =>$blog_cat->name])}}">
                                    <li class="py-2"><i class="fa fa-angle-right" aria-hidden="true"></i> {{ isset($blog_cat->name)?$blog_cat->name:'' }}</li>
                                </a>
                                @endif
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
@section('script')
<script>
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
        $(e.target)
            .prev()
            .find("i:last-child")
            .toggleClass("fa-minus fa-plus");
    });
</script>
@endsection