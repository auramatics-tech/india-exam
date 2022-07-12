@extends('frontend.layouts.master')
@section('content')
<section class="si_sec_text su_height py-4">
    <div class="container mx-auto container_padding">
        <div class="row py-0 py-lg-3 py-md-3 shadow rounded bg-white px-3 py-3">
            <div class="col-lg-8 col-md-12 col-sm-12 border p-3">
                <div class="px-2 row">
                    <div class="bg-white si_typing_test d-flex col-lg-3 col-md-3 col-sm-12">
                        <img src="{{ asset('frontend/images/question.png') }}" alt="">
                        <p class="text-white">Guest</p>
                    </div>
                    <div class="si_typing_test1 col-lg-6 col-md-6 col-sm-12">
                        <h5 class="text-grey text-lg-center text-md-center mt-3">English Mock Type Test</h5>
                    </div>
                    <div class="si_typing_test text-white col-lg-3 col-md-3 col-sm-12">
                        <p>Time Left 10:00</p>
                    </div>
                </div>
                <div class="pt-4">
                    <div class="si_main_border px-3 pb-3 pt-1">
                        <h5>Reference Text</h5>
                        <div class="si_test_border bg-white">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo est aut numquam nostrum vero ex natus non voluptates, nisi commodi porro autem omnis ratione laborum labore! Ut distinctio dolores corrupti?
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores nihil temporibus labore magnam impedit harum quaerat, saepe rerum error aliquid cum repellat doloremque non, quo commodi minus placeat voluptates? Quae!
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus laborum libero, mollitia tempora quisquam asperiores quia nulla. Nobis deleniti voluptatibus quas. Sint, accusamus? Excepturi, sed. Ratione deleniti pariatur assumenda reiciendis!
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam sapiente sint dolorum ullam quos aliquam consequuntur animi id porro quo. Magni quis cupiditate cumque maiores nostrum, quae numquam amet nihil?</p>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <div class="si_main_border px-3 pb-3 pt-1 si_textarea">
                        <h5>Typing Box</h5>
                        <textarea name="" id="" cols="" rows="6" class="w-100"></textarea>
                    </div>
                </div>
                <div class="pt-3 si_floats_btn">
                    <a href="{{route('typing_result')}}"><button class="si_mock_btn bg-danger border none rounded p-1" type="submit">Submit your mock test</button></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
        </div>
</section>
@endsection