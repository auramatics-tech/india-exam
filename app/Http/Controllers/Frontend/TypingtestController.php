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
        $mock_test = MockTest::find($request->id);
        $typing_text = isset($request->typing_text)?$request->typing_text:'';
        
    }
}
