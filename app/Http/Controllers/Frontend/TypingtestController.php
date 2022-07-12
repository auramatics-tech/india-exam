<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MockTestCategory;
use App\Models\MockTest;
Use File;

class TypingtestController extends Controller
{
    public function typing_test(){
        $mock_categories = MockTestCategory::where('active',1)->get();
        return view('frontend.typing_test',compact('mock_categories'));
    }   
    public function mock_test($id){
        $mock_test = MockTest::find($id);
        $time_limit = $mock_test->time;
        $test_end_time = date('M j, Y H:i:s', strtotime('+'.$time_limit.' minutes'));
        return view('frontend.mock_test',compact('mock_test','test_end_time','time_limit'));
    }

    public function mock_test_save(Request $request)
    {
        $result = $request->all();
        $mock_test = MockTest::find($request->id);
        $typed_words = isset($result['typing_text'])?count(explode(' ',$result['typing_text'])):'0';
        $total_words = isset($mock_test->text)?count(explode(' ',$mock_test->text)):'0';
        $time_taken =  $request->time_taken_min .' minutes and' . $request->time_taken_sec . ' seconds';
        return view('frontend.typing_test_result',compact('result','typed_words','total_words','time_taken'));
    }
}
