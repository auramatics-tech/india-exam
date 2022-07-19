@extends('frontend.layouts.master')
@section('content')
<section class="pt-2">
@if(count($announcements))
    @foreach($announcements as $announcement)
    <div class="marq1">
        <div class="content col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex si_announce_style">
            <div class="si_width_announce">
                <div class="textmarq">Announcements</div>
                <div class="textmarqmob">Announcements</div>
            </div>
            <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()">
                <div class="si_marq_style">
                    <h5>{{$announcement->text}}</h5>
                </div>
            </marquee>
        </div>
    </div>
    @endforeach
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
                                <p class="text-muted"><a href="">{{date('d M Y',strtotime( $blogs->created_at)) }}</p>
                                <h4 class="pt-3 text-dark">{{$blogs->title}}</h4>
                                <p class="pt-2 text-dark">{{$blogs->thumbnail_description}}</p>
                                <p class="pt-2 text-dark">{!! $blogs->description !!}</p>
                            </div>
                            <div class="pt-3 text-dark">
                                @if(isset($blogs->blog_pdf))
                                <p class="text-center si_bg_light text-dark"><b>Official Notification</b></p>
                                <div class="py-3 text-center">
                                    <a target="_blank" href="{{asset('blog/pdf/'.$blogs->blog_pdf)}}"><button class="si_mock_btn bg-danger border none rounded p-1" type="submit">Download <i class="fa fa-download" aria-hidden="true"></i></button></a>
                                </div>
                                @endif
                                <div class="py-3 text-dark">
                                    <p class="text-center si_bg_light"><b>Important Links</b></p>
                                </div>
                                <div class="py-2 border p-3 text-dark">
                                    <p class="pt-2">IMPORTANT LINKS :</p>
                                    @if(count($blogs->get_links))
                                    @foreach($blogs->get_links as $key => $val)
                                    <a class="pt-2" href="{{$val->link}}">
                                        <h5><u>{{$val->title}}</u></h5>
                                    </a>
                                    @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 py-1">
                        <div class="si_heading pb-4">
                            <h5 class="si_border shadow mb-2 mx-auto text-center">IMPORTANT DATES</h5>
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
                                @if(count($important_dates))
                                @foreach($important_dates as $important_date)
                                <a href="">
                                    <li class="py-2">{!! $important_date->text !!}</li>
                                </a>
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