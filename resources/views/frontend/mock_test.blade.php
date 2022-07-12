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
                    <div class="si_typing_test1 col-lg-5 col-md-5 col-sm-12">
                        <h5 class="text-grey text-lg-center text-md-center mt-3">English Mock Type Test</h5>
                    </div>
                    <div class="si_typing_test text-white col-lg-4 col-md-4 col-sm-12">
                        <p>Time Left : <span id="timer">00:{{($time_limit< 10)?'0'.$time_limit:$time_limit}}:00</span></p>
                    </div>
                        
                </div>

                <div class="header d-none">
                <div class="wpm">
                    <div class="header_text">WPM</div>
                    <div class="curr_wpm">0</div>
                </div>
                <div class="cpm">
                    <div class="header_text">CPM</div>
                    <div class="curr_cpm">0</div>
                </div>
                <div class="errors">
                    <div class="header_text">Errors</div>
                    <div class="curr_errors">0</div>
                </div>
                <div class="timer">
                    <div class="header_text">Time</div>
                    <div class="curr_time">0</div>
                </div>
                <div class="accuracy">
                    <div class="header_text">% Accuracy</div>
                    <div class="curr_accuracy">0</div>
                </div>
                <div class="quote">Click on the area below to start the game.</div>
                        <button class="restart_btn" onclick="resetValues()">Restart</button>
                </div>
                <div class="pt-4">
                    <div class="si_main_border px-3 pb-3 pt-1">
                        <h5>Reference Text</h5>
                        <div class="si_test_border bg-white">
                            <p>{{$mock_test->text}}</p>
                        </div>
                    </div>
                </div>
                <form action="{{route('mock_test_save')}}" method="post" id="here">
                    @csrf
                    <input type="hidden" name="id" value="{{$mock_test->id}}">
                    <input type="hidden" name="wpm" id="wpm" value="{{$mock_test->id}}">
                    <input type="hidden" name="cpm" id="cpm" value="{{$mock_test->id}}">
                    <input type="hidden" name="errors" id="errors" value="{{$mock_test->id}}">
                    <input type="hidden" name="accuracy" id="accuracy" value="{{$mock_test->id}}">
                    <div class="pt-4">
                        <div class="si_main_border px-3 pb-3 pt-1">
                            <h5>Typing Box</h5>
                            <textarea name="typing_text" placeholder="start typing here..." oninput="processCurrentText()"
                                onfocus="startGame()" class="input_area w-100" rows="6" class="w-100"></textarea>
                        </div>
                    </div>
                    <div class="pt-3 si_floats_btn">
                        <button class="d-none" id="form_submit">Submit</button>
                        <button class="si_mock_btn bg-danger border none rounded p-1" id="submit" type="button">Submit your mock test</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
        </div>
</section>
@endsection
@section('script')
<script>
    // define the time limit
let TIME_LIMIT = {{$time_limit*60}};

// define quotes to be used
let quotes_array = [
    "{{$mock_test->text}}"
];

$(document).on('click','#submit',function(){
var wpm = $('.curr_wpm').html();
$('#wpm').val(wpm);
var cpm = $('.curr_cpm').html();
$('#cpm').val(cpm);
var errors = $('.curr_errors').html();
$('#errors').val(errors);
var accuracy = $('.curr_accuracy').html();
$('#accuracy').val(accuracy);
$('#form_submit').trigger('click');
})
</script>
<script src="{{asset('frontend/js/mock_test.js')}}"></script>
@endsection