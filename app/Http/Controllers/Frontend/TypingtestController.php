<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Privacy;
Use File;

class TypingtestController extends Controller
{
    public function typing_test(){
        // echo "here";die;
        return view('frontend.typing_test');
    }   
    public function test_box(){
        return view('frontend.test_box');
    }
    public function typing_result(){
        return view('frontend.typing_test_result');
    }
}
