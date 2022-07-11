@extends('frontend.layouts.master')
@section('content')
<section class="si_sec_text su_height pt-4">
    <div class="container mx-auto container_padding">
        <div class="row py-0 py-lg-3 py-md-3 shadow rounded bg-white px-3">
            <div class="col-lg-8 col-md-12 col-sm-12 border">
                <div class="px-2 bg-white d-flex si_typing_test">
                    <img src="{{ asset('frontend/images/question.png') }}" alt="">
                    <p class="text-white">Guest</p>
                </div> 
                <div class="si_typing_test1">
                    <h5 class="text-grey">English Mock Type Test</h5>
                </div>
                <div class="si_typing_test2">
                    <p>Time Left 10:00</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
        </div>
</section>
@endsection