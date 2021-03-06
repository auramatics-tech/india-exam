@extends('frontend.layouts.master')
@section('content')
<section class="si_sec_text su_height py-4">
    <div class="container mx-auto container_padding">
        <div class="row py-0 py-lg-3 py-md-3 shadow rounded bg-white px-3 py-3">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="si_heading text-white">
                    <h5 class="bg_blue p-2 text-center">Typing Test Result</h5>
                </div>
                <div class="border p-3">
                    <a href="">
                        <h5 class="py-2 su_clr_heading">Click Here To Another Typing Excercise</h5>
                    </a>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <p class="pt-2">Words per minute</p>
                            <p class="pt-2">Characters per minute</p>
                            <p class="pt-2">Errors</p>
                            <p class="pt-2">Accuracy</p>
                            <p class="pt-2">Typed words</p>
                            <p class="pt-2">Total words</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <p class="pt-2">=</p>
                            <p class="pt-2">=</p>
                            <p class="pt-2">=</p>
                            <p class="pt-2">=</p>
                            <p class="pt-2">=</p>
                            <p class="pt-2">=</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <p class="pt-2">{{$result['wpm']}}</p>
                            <p class="pt-2">{{$result['cpm']}}</p>
                            <p class="pt-2">{{$result['errors']}}</p>
                            <p class="pt-2">{{$result['accuracy']}}%</p>
                            <p class="pt-2">{{$typed_words}}</p>
                            <p class="pt-2">{{$total_words}}</p>
                        </div>
                    </div>
                    <div class="py-3">
                        <p class="pt-2">The time you took for this test - {{$time_taken}}.</p>
                        <p class="pt-2">Your actual gross speed is {{$result['wpm']}} WPM</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
        </div>
</section>
@endsection