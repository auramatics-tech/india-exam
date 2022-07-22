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
</section>
<section class="si_sec_text su_height">
    <div class="container px-4 container_padding">
        <div class="py-0 py-lg-3 py-md-3">
            <div class="row py-0 py-lg-3 py-md-3">
                <div class="col-lg-9 col-md-12 col-sm-12">
                    <div class="row px-2 bg-white shadow rounded">
                        <div class="py-3 si_heading1">
                            <h1 style="display: none">&nbsp;</h1>
                            <h5 class="su_clr_heading">Welcome to IndiaExamJunction.com !</h5>
                            <p class="text-dark">Here, you can practice Multiple Choice Questions for Competitive Exams.
                            </p>
                        </div>
                        <div class="col-lg-7 col-md-12 col-sm-12 py-1">
                            <div class="si_heading pb-4">
                                <h5 class="si_border shadow mb-2 mx-auto text-center">GOVERNMENT JOBS</h5>
                                <h5 class="py-2 mx-auto text-center border-bottom text-dark">LATEST</h5>
                                @if(count($blogs))
                                @foreach($blogs as $blog)
                                <div class="row pt-3">
                                    @if(isset($blog->image))
                                    <div class="col-lg-4 col-md-4 col-sm-12 si_center_style">
                                        <a href="{{route('blog_detail_page', $blog->slug)}}"> <img src="{{asset('blog/images/'.$blog->image )}}" alt="" class="si_blog_image"> </a>
                                    </div>
                                    @endif
                                    <div class="@if(isset($blog->image)) col-lg-8 col-md-8 @else col-lg-12 col-md-12  @endif col-sm-12 si_center_style">
                                        <a href="">
                                            <h4>{{ $blog->title }}</h4>
                                        </a>
                                        {{--<span class="text-muted"><a href="" class="text-primary">{{date('d M Y',strtotime( $blog->created_at)) }}</span>--}}
                                        <p class="mt-2 si-text-dark">{{ substr($blog->thumbnail_description ,0,200) }}...</p>
                                    </div>
                                    <div> <a href="{{route('blog_detail_page', $blog->slug)}}">
                                            <p class="text-primary si_floating">Read More</p>
                                        </a></div>
                                </div>
                                <hr class="si_hr_div">
                                @endforeach
                                @endif
                                {{ $blogs->links("pagination::bootstrap-4") }}
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 py-1">
                            <div class="si_heading pb-4">
                                <h5 class="si_border shadow mb-2 mx-auto text-center">STATE JOBS</h5>
                                <h5 class="py-2 mx-auto text-center border-bottom text-dark">STATES</h5>
                            </div>
                            <div class="si_left_styling">
                                <ul class="list-unstyled ul_hover">
                                    @if(count($states))
                                    @foreach($states as $state)
                                        @if(count(jobsinstate($state->id)))
                                            <a href="{{route('government_jobs', ['state' =>$state->id])}}">
                                                <li class="py-2"><i class="fa fa-angle-right" aria-hidden="true"></i> {{ isset($state->state)?$state->state:'' }}</li>
                                            </a>
                                        @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="si_heading pb-4">
                                <h5 class="si_border shadow mb-2 mx-auto text-center">STATE JOBS</h5>
                                <h5 class="py-2 mx-auto text-center border-bottom text-dark">STATES</h5>
                            </div>
                            <div class="si_left_styling">
                                <ul class="list-unstyled ul_hover">
                                    @if(count($states))
                                    @foreach($states as $state)
                                        @if(count(jobsinstate($state->id)))
                                            <a href="{{route('government_jobs', ['state' =>$state->id])}}">
                                                <li class="py-2"><i class="fa fa-angle-right" aria-hidden="true"></i> {{ isset($state->state)?$state->state:'' }}</li>
                                            </a>
                                        @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12"></div>
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