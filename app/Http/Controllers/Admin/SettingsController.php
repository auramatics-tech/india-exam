<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use App\Models\Setting;
use Validator;

class SettingsController extends Controller
{
   
    public function index()
    {
        $setting = Setting::all();
        return view('backend.settings.index',compact('setting'));
    }

    public function store_settings(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $val) {
            Setting::where('key', $key)->update(['value' => $val]);
        }
        return redirect()->route('admin.settings');
    }
}
